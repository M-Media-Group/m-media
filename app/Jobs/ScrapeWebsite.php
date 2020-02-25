<?php

namespace App\Jobs;

use App\User;
use App\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Iodev\Whois\Whois;

class ScrapeWebsite implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    protected $url;
    protected $user;
    protected $save;
    protected $website_url;
    protected $load_times;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $save = true, User $user = null)
    {
        $this->url = $url;
        $this->user = $user;
        $this->save = $save;
        $this->load_times = collect();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $time_start = microtime(true);

            $this->website_url = $this->formatUrl($this->url);

            if ($this->save) {
                $website = Website::updateOrCreate(
                    ['host' => $this->website_url['host']],
                    ['scheme' => $this->website_url['scheme']]
                    //['is_scrapeable' => $data->private ? 0 : 1]
                );
                if ($website->wasRecentlyCreated ?? true) {
                    // do somehing great
                    $website->is_scrapeable = 1;
                }
            } else {
                $website = (object) [
                    'id'            => null,
                    'scheme'        => $this->website_url['scheme'],
                    'host'          => $this->website_url['host'],
                    'user_id'       => null,
                    'is_scrapeable' => 1,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            }

            $domain = (object) $this->getDomainInfo($this->website_url['host']);
            $dns_records = (object) $this->getDnsInfo($this->website_url['host']);

            $data = [
                'id'            => $website->id,
                'scheme'        => $website->scheme,
                'host'          => $website->host,
                'url'           => $website->scheme.'://'.$website->host,
                'user_id'       => $website->user_id,
                'is_scrapeable' => $website->is_scrapeable,
                'created_at'    => $website->created_at,
                'updated_at'    => $website->updated_at,
                'latest_scrape' => (object) [
                    'domain_registrar'     => $domain->domain_registrar,
                    'domain_owner'         => $domain->domain_owner,
                    'domain_created_at'    => $domain->domain_created_at,
                    'domain_expires_at'    => $domain->domain_expires_at,
                    'whois_server'         => $domain->whois_server,
                    'client_delete_lock'   => $domain->states->contains('clientdeleteprohibited'),
                    'client_renew_lock'    => $domain->states->contains('clientrenewprohibited'),
                    'client_update_lock'   => $domain->states->contains('clientupdateprohibited'),
                    'client_transfer_lock' => $domain->states->contains('clienttransferprohibited'),
                    'dns_records'          => $dns_records,
                    'created_at'           => now(),
                    'updated_at'           => now(),
                ],
                'execution_time'       => microtime(true) - $time_start,
                'was_recently_created' => $website->wasRecentlyCreated ?? true,
            ];

            return $data;
        } catch (\Exception $e) {
            //return dump($e);
            return response()->json(['Error' => $e->getMessage()], 422);
        }
    }

    private function formatUrl($url, $check_for_https = true, $default_https = false)
    {
        //$url = ltrim($url, 'www.');
        if (isset($url['host']) && isset($url['scheme'])) {
            return $url;
        }
        $local_parsed_url = parse_url($url);

        if (!isset($local_parsed_url['host'])) {
            if (!isset($local_parsed_url['path'])) {
                $local_parsed_url['path'] = null;
            }
            if ($local_parsed_url['path'] == $this->website_url['host'] || !$this->website_url['host']) {
                $local_parsed_url['host'] = $local_parsed_url['path'];
                $local_parsed_url['path'] = null;
            } else {
                $local_parsed_url['host'] = $this->website_url['host'];
            }
        }
        if (!isset($local_parsed_url['scheme']) && $check_for_https) {
            $local_parsed_url['scheme'] = 'http';

            if ($default_https || $this->supportsHttps($url)) {
                $local_parsed_url['scheme'] = 'https';
            }
        } elseif (!isset($local_parsed_url['scheme'])) {
            if ($default_https) {
                $local_parsed_url['scheme'] = 'https';
            }
        }

        return $local_parsed_url;
    }

    private function supportsHttps($url)
    {
        $local_parsed_url = parse_url($url);
        if (!isset($local_parsed_url['scheme'])) {
            $file = 'https://'.$url;

            //$time_start_1 = microtime(true);
            $file_headers = @get_headers($file);
            //$this->load_times->push(microtime(true) - $time_start_1);

            if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                return false;
            } else {
                return true;
            }
        }

        return false;
    }

    private function getDomainInfo($host)
    {
        // Creating default configured client
        $whois = Whois::create();
        $host = ltrim($host, 'www.');

        // Checking existance
        if ($whois->isDomainAvailable($host)) {
            return abort(404, 'Domain is not registered');
            //return response()->json(['Error' => "Domain is not registered"], 422);
        }

        $info = $whois->loadDomainInfo($host);

        //Sometimes need to restart it
        if (!$info) {
            sleep(2);
            $info = $whois->loadDomainInfo($host);
        }

        return (object) [
            'name'              => $info->getDomainName(),
            'whois_server'      => $info->getWhoisServer(),
            'domain_created_at' => \Carbon\Carbon::parse($info->getCreationDate()),
            'domain_expires_at' => \Carbon\Carbon::parse($info->getExpirationDate()),
            'domain_registrar'  => $info->getRegistrar(),
            'domain_owner'      => $info->getOwner(),
            'states'            => collect($info->getStates()),
            //'response' => $info->getResponse(),
            //'parser_type' => $info->getParserType(),
            //#'nameservers' => $info->getNameServers(), <-- Now fetched from getDnsInfo function
            //'name_unicode' => $info->getDomainNameUnicode(),
        ];
    }

    private function getDnsInfo($host)
    {
        return dns_get_record(rtrim($host, '.').'.', DNS_A + DNS_CNAME + DNS_HINFO + DNS_CAA + DNS_MX + DNS_NS + DNS_PTR + DNS_SOA + DNS_TXT + DNS_AAAA + DNS_SRV + DNS_NAPTR);
    }
}
