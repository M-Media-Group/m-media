<?php

namespace App\Jobs;

use App\User;
use DonatelloZa\RakePlus\RakePlus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapePage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;
    protected $user;
    protected $save;
    protected $page;
    protected $website;
    protected $load_times;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $page = null, User $user = null, $save = true)
    {
        $this->url = $url;
        $this->user = $user;
        $this->save = $save;
        $this->page = $page;
        $this->load_times = collect();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //return dd(Google::getSerps('Hack Google', 10));
        //$url = $request->input('url') ?? $url;
        $lang = null;
        $meta_tags = collect();
        $images = [];
        $elements = collect();
        $links = collect();
        $scripts = collect();
        $h1s = collect();
        $ps = [];
        $detected_keywords = collect();
        $title = null;
        $image = null;
        $description = null;
        $instagram_account = null;
        $facebook_account = null;
        $phones = [];
        $emails = [];
        $uses_google_analytics = false;
        $uses_google_tag_manager = false;
        $is_wordpress = false;

        try {
            $this->website = (object) ScrapeWebsite::dispatchNow($this->url);
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Scraping website: '.$e->getMessage()], 422);
        }

        if ($this->page) {
            $this->page = '/'.ltrim($this->page, '/');
            $this->url = $this->website->url.$this->page;
        } else {
            $this->url = $this->website->url;
        }

        try {
            $context = stream_context_create(
                [
                    'http' => [
                        'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36'.
                        'Accept-language: en',
                        'follow_location' => false,
                    ],
                ]
            );

            $time_start = microtime(true);
            $sites_html = file_get_contents($this->url, false, $context);
            $this->load_times->push(microtime(true) - $time_start);
        } catch (\Exception $e) {
            return response()->json(['Error' => 'Fetching page: '.$e->getMessage()], 422);
        }

        try {
            $headers = (object) $this->parseHeaders($http_response_header);

            if ($headers->reponse_code == 301 || $headers->reponse_code == 302 || $headers->reponse_code == 303) {
                //return var_dump($headers);
                return response()->json(['Error' => '('.$headers->reponse_code.') The page redirects to '.$headers->Location], 422);
            }
            if (!$headers->reponse_code || $headers->reponse_code !== 200) {
                return response()->json(['Error' => 'The page responded with a '.$headers->reponse_code.' response code'], 422);
            }

            $size = strlen($sites_html);
            $html = new \DOMDocument();
            @$html->loadHTML($sites_html);

            // seconds
            $execution_time = $this->load_times->avg();

            //loop all elements
            foreach ($html->getElementsByTagName('*') as $value => $meta) {
                $attributes = collect();
                foreach ($meta->attributes as $attr) {
                    $name = $attr->nodeName;
                    $node_value = $attr->nodeValue;
                    $attributes->push((object) ['attribute_title' => $name, 'attribute_value' => $node_value]);
                }

                $data = (object) [
                    'position'   => $value,
                    'node_name'  => $meta->nodeName,
                    'node_value' => $meta->nodeValue,
                    'attributes' => $attributes,
                ];
                $elements->push($data);

                //Get all meta tags and loop through them.
                if ($meta->nodeName == 'meta') {

                    //#CAUTION meta can have both name= and property= set at the same time

                    $attribute_title = null;
                    $attribute_value = null;
                    $content = null;
                    foreach ($meta->attributes as $attr) {
                        $name = $attr->nodeName;
                        $node_value = $attr->nodeValue;
                        if ($name !== 'content') {
                            $attribute_title = $name;
                            $attribute_value = $node_value;
                        } else {
                            $content = $node_value;
                        }
                    }
                    $data = (object) [
                        'position' => $value,
                        'content'  => $content,
                        'meta_tag' => [
                            'attribute_title' => $attribute_title,
                            'attribute_value' => $attribute_value,
                            'is_required'     => 0,
                            'is_depreciated'  => 0,
                            'is_recommended'  => 0,
                            'content_type'    => 'string',
                            'description'     => null,
                        ],
                    ];
                    $meta_tags->push($data);
                } elseif ($meta->nodeName == 'img') {

                    //skip images with no source
                    if (!$meta->getAttribute('src')) {
                        continue;
                    }

                    $img_parsed_url = $this->formatUrl($meta->getAttribute('src'), false, true);

                    //check if link is relative
                    $is_relative = false;
                    if (!isset($img_parsed_url['host'])) {
                        $is_relative = true;
                    }

                    //add to images array
                    array_push($images, ['position' => $value, 'src' => $meta->getAttribute('src'), 'alt' => $meta->getAttribute('alt') ?? null, 'is_relative' => $is_relative]);

                    //detect if images are wordpress - common signal that site is wordpress too
                    if (preg_match("/wp-content\b/i", $meta->getAttribute('src'))) {
                        $is_wordpress = true;
                    }
                } elseif ($meta->nodeName == 'a') {
                    $parsed_url_2 = parse_url($meta->getAttribute('href'));
                    $is_internal = $this->urlIsInternal($parsed_url_2);
                    if (stripos($meta->getAttribute('href'), 'tel:') !== false) {
                        $input['phonenumber'] = ltrim($meta->getAttribute('href'), 'tel:');
                        $phone = SavePhone::dispatchNow($input);
                        $data = [
                            'position'    => $value,
                            'phone'       => $phone,
                            'value'       => trim($meta->textContent),
                            'is_internal' => $is_internal,
                            'url'         => $parsed_url_2,
                        ];
                        array_push($phones, $data);
                    } elseif (stripos($meta->getAttribute('href'), 'mailto:') !== false) {
                        $data = [
                            'position'    => $value,
                            'src'         => $parsed_url_2['path'],
                            'value'       => trim($meta->textContent),
                            'is_internal' => $is_internal,
                            'url'         => $parsed_url_2,
                        ];
                        array_push($emails, $data);
                    } else {
                        $data = [
                            'position'    => $value,
                            'src'         => trim($meta->getAttribute('href')),
                            'value'       => trim($meta->textContent),
                            'title'       => $meta->getAttribute('title') ?? null,
                            'rel'         => $meta->getAttribute('rel') ?? null,
                            'target'      => $meta->getAttribute('target') ?? null,
                            'is_internal' => $is_internal,
                            'url'         => $this->formatUrl($meta->getAttribute('href')),
                            'website_id'  => $is_internal ? $this->website->id : null,
                        ];
                        $links->push($data);
                    }
                } elseif ($meta->nodeName == 'p') {
                    array_push($ps, $meta->textContent);
                } elseif ($meta->nodeName == 'script') {
                    $data = (object) ['position' => $value, 'src' => $meta->nodeValue];
                    $scripts->push($data);
                    //check if contains UA- or if GTM
                    if (preg_match("/\bUA-\b/i", $meta->nodeValue)) {
                        $uses_google_analytics = true;
                    } elseif (preg_match("/\bGTM-\b/i", $meta->nodeValue)) {
                        $uses_google_tag_manager = true;
                    }
                } elseif (preg_match('/h(?:[0-9])/', $meta->nodeName)) {
                    $h1s->push((object) ['position' => $value, 'type' => $meta->nodeName, 'value' => $meta->textContent]);
                }
            }

            $title = $elements->firstWhere('node_name', 'title')->node_value ?? null;

            $lang = $html->getElementsByTagName('html')[0]->getAttribute('lang') ?? ($meta_tags->firstWhere('meta_tag.attribute_value', 'language')->content ?? null);

            $description = $meta_tags->firstWhere('meta_tag.attribute_value', 'description')->content ?? $meta_tags->firstWhere('meta_tag.attribute_value', 'og:description')->content ?? null;

            $instagram_account = $links->first(function ($item) {
                return str_replace('www.', '', $item['url']['host']) == 'instagram.com';
            });
            $instagram_account = trim($instagram_account['url']['path'] ?? null, '/');

            $facebook_account = $links->first(function ($item) {
                return str_replace('www.', '', $item['url']['host']) == 'facebook.com' || str_replace('www.', '', $item['url']['host']) == 'fb.me';
            });
            $facebook_account = trim($facebook_account['url']['path'] ?? null, '/');

            $image = $meta_tags->firstWhere('meta_tag.attribute_value', 'og:image')->content ?? null;
            if ($image) {
                $img_parsed_url = parse_url($image);
                $is_relative = false;
                if (!isset($img_parsed_url['host'])) {
                    $is_relative = true;
                }
                array_push($images, ['position' => $value, 'src' => $image, 'alt' => 'og:image', 'is_relative' => $is_relative]);
            }

            // Sort the phrases by score and return the scores
            if (stripos($lang, 'en') !== false || stripos($lang, 'ALL') !== false || !$lang) {
                $lang = 'en_US';
                $text = $title.'. '.implode(', ', $ps);
                $rake = RakePlus::create($text ?? $description, $lang, 2);
                $keywords = $rake->sortByScore('desc')->scores();
                foreach ($keywords as $keyword => $value) {
                    $data = (object) [
                        'topic' => $keyword,
                        'score' => $value,
                    ];
                    $detected_keywords->push($data);
                }
                $detected_keywords = $detected_keywords->filter(function ($value, $key) {
                    return $value->score > 1 && $value->score <= 100;
                });
            }
            $elements_count = $elements->count();
            $body_position = $elements->firstWhere('node_name', 'body')->position ?? null;

            $website = $this->website;
            $page = (object) [
                'page_id'       => null,
                'path'          => $this->page,
                'url'           => $this->url,
                'is_scrapeable' => 1,
                'is_homepage'   => !$this->page,
            ];

            //return $elements;
            // return $elements->filter(function ($value, $key) {
            //     return $value->attributes->contains(function ($value, $key) {
            //         return stripos($value->attribute_value, 'facebook');
            //     });
            // });

            return compact('title', 'lang', 'description', 'page', 'instagram_account', 'facebook_account', 'uses_google_analytics', 'uses_google_tag_manager', 'is_wordpress', 'image', 'website', 'meta_tags', 'images', 'links', 'h1s', 'detected_keywords', 'phones', 'emails', 'execution_time', 'size', 'elements_count', 'body_position', 'headers');

            //#only tags where styles attribute exists and has colour example
            // return $elements->filter(function ($value, $key) {
            //     return $value->attributes->contains(function ($value, $key) {
            //         return $value->attribute_title == "style" && preg_match('/#(?:[0-9a-fA-F]{6}|[0-9a-fA-F]{3})[\s;]*/', $value->attribute_value);
            //     });
            // });
        } catch (\Exception $e) {
            //return dump($e);
            return response()->json(['Error' => $e->getMessage()], 422);
        }
    }

    private function formatUrl($url, $check_for_https = false, $default_https = false)
    {
        $local_parsed_url = parse_url($url);

        if (!isset($local_parsed_url['host'])) {
            if (!isset($local_parsed_url['path'])) {
                $local_parsed_url['path'] = null;
            }
            if ($local_parsed_url['path'] == $this->website->host || !$this->website->host) {
                $local_parsed_url['host'] = $local_parsed_url['path'];
                $local_parsed_url['path'] = null;
            } else {
                $local_parsed_url['host'] = $this->website->host;
            }
        }
        if (!isset($local_parsed_url['scheme']) && $check_for_https) {
            if ($this->supportsHttps($url) || $default_https == true) {
                $local_parsed_url['scheme'] = 'https';
            } else {
                $local_parsed_url['scheme'] = 'http';
            }
        } elseif (!isset($local_parsed_url['scheme'])) {
            if ($default_https == true) {
                $local_parsed_url['scheme'] = 'https';
            } else {
                $local_parsed_url['scheme'] = 'http';
            }
        }

        return $local_parsed_url;
    }

    private function urlIsInternal($parsed_url_2)
    {
        if (!isset($parsed_url_2['host'])) {
            return true;
        } elseif ($parsed_url_2['host'] == $this->website->host || ltrim($parsed_url_2['host'], 'www.') == $this->website->host) {
            return true;
        }

        return false;
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

    private function parseHeaders($headers)
    {
        $head = [];
        foreach ($headers as $k => $v) {
            $t = explode(':', $v, 2);
            if (isset($t[1])) {
                $head[trim($t[0])] = trim($t[1]);
            } else {
                $head[] = $v;
                if (preg_match("#HTTP/[0-9\.]+\s+([0-9]+)#", $v, $out)) {
                    $head['reponse_code'] = intval($out[1]);
                }
            }
        }

        return $head;
    }
}
