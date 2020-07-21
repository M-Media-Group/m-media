<?php

namespace App\Services;

use Iodev\Whois\Exceptions\ConnectionException;
use Iodev\Whois\Exceptions\ServerMismatchException;
use Iodev\Whois\Exceptions\WhoisException;
use Iodev\Whois\Factory;

class DomainService
{
    protected $original_url;
    protected $url;
    protected $domain;

    public function __construct(string $original_url)
    {
        $this->original_url = $original_url;
        $this->setDomain($original_url);
        $this->setUrl($original_url);
    }

    private function isRegistered()
    {
        $whois = Factory::get()->createWhois();

        return ! $whois->isDomainAvailable($this->domain);
    }

    public function getDnsInfo()
    {
        if (! $this->isRegistered()) {
            return abort(404);
        }
        $host = $this->domain;

        return dns_get_record(rtrim($host, '.').'.', DNS_A + DNS_CNAME + DNS_HINFO + DNS_CAA + DNS_MX + DNS_NS + DNS_PTR + DNS_SOA + DNS_TXT + DNS_AAAA + DNS_SRV + DNS_NAPTR);
    }

    public function getWhois()
    {
        try {
            $whois = Factory::get()->createWhois();
            $host = $this->domain;

            // if ($whois->isDomainAvailable($host)) {
            // }

            $info = $whois->loadDomainInfo($host);
            if (! $info) {
                return abort(404, 'Domain is not registered');
            }
            $data = [
                'name' => $info->getDomainName(),
                'whois_server' => $info->getWhoisServer(),
                'domain_created_at' => \Carbon\Carbon::parse($info->getCreationDate()),
                'domain_expires_at' => \Carbon\Carbon::parse($info->getExpirationDate()),
                'domain_registrar' => $info->getRegistrar(),
                'domain_owner' => $info->getOwner(),
                'states' => collect($info->getStates()),
                'response' => $info->getResponse(),
                'parser_type' => $info->getParserType(),
                'nameservers' => $info->getNameServers(),
                'name_unicode' => $info->getDomainNameUnicode(),
            ];

            return $data;
        } catch (ConnectionException $e) {
            return abort(422, 'Disconnect or connection timeout');
        } catch (ServerMismatchException $e) {
            return abort(422, 'TLD server (.com for google.com) not found in current server hosts');
        } catch (WhoisException $e) {
            return abort(500, "Whois server responded with error '{$e->getMessage()}'");
        }
    }

    private function formatUrl($url, $check_for_https = true, $default_https = false)
    {
        //$url = ltrim($url, 'www.');
        // if (isset($url['host']) && isset($url['scheme'])) {
        //     return $url;
        // }
        // $local_parsed_url = parse_url($url);

        // if (!isset($local_parsed_url['host'])) {
        //     if (!isset($local_parsed_url['path'])) {
        //         $local_parsed_url['path'] = null;
        //     }
        //     if ($local_parsed_url['path'] == $this->website_url['host'] || !$this->website_url['host']) {
        //         $local_parsed_url['host'] = $local_parsed_url['path'];
        //         $local_parsed_url['path'] = null;
        //     } else {
        //         $local_parsed_url['host'] = $this->website_url['host'];
        //     }
        // }
        // if (!isset($local_parsed_url['scheme']) && $check_for_https) {
        //     $local_parsed_url['scheme'] = 'http';

        //     if ($default_https || $this->supportsHttps($url)) {
        //         $local_parsed_url['scheme'] = 'https';
        //     }
        // } elseif (!isset($local_parsed_url['scheme'])) {
        //     if ($default_https) {
        //         $local_parsed_url['scheme'] = 'https';
        //     }
        // }

        // return $local_parsed_url;
    }

    private function formatDomain()
    {
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $this->original_url, $regs)) {
            return $regs['domain'];
        }

        return $url;
    }

    /**
     * @return mixed
     */
    public function getOriginalUrl()
    {
        return $this->original_url;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     *
     * @return self
     */
    private function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     *
     * @return self
     */
    private function setDomain($domain)
    {
        $this->domain = $this->formatDomain($domain);

        return $this;
    }
}
