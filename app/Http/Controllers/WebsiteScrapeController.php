<?php

namespace App\Http\Controllers;

use DonatelloZa\RakePlus\RakePlus;
use Illuminate\Http\Request;

class WebsiteScrapeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['verified', 'optimizeImages'])->except(['index']);
    }

    public function index(Request $request, $url)
    {
        try {
            $parsed_url = parse_url($url);
            if (!isset($parsed_url['scheme'])) {
                $url = "http://" . $url;
            }
            $context = stream_context_create(
                array(
                    "http" => array(
                        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36" .
                        "Accept-language: en",
                    ),
                )
            );
            //return $url;
            $sites_html = file_get_contents($url, false, $context);

            $html = new \DOMDocument();
            @$html->loadHTML($sites_html);
            $meta_og_img = null;
            $lang = null;
            $meta_tags = [];
            $images = [];
            $links = [];
            $scripts = [];
            $emails = [];
            $h1s = [];
            $ps = [];
            $detected_keywords = [];
            $title = null;
            $image = null;
            $description = null;
            $instagram_account = null;
            $facebook_account = null;
            $uses_google_analytics = false;
            $uses_google_tag_manager = false;
            $is_wordpress = false;

            $list = $html->getElementsByTagName("title");
            if ($list->length > 0) {
                $title = $list->item(0)->textContent;
            }

            $lang = $html->getElementsByTagName('html')[0]->getAttribute('lang');

//Get all meta tags and loop through them.
            foreach ($html->getElementsByTagName('meta') as $meta) {
                //If the property attribute of the meta tag is og:image

                //$meta_tags[] .= $meta->nodeName;
                if ($meta->getAttribute('name') == 'description') {
                    $description = $meta->getAttribute('content');
                }

                if ($meta->getAttribute('property') == 'og:image') {
                    $image = $meta->getAttribute('content');
                }

                foreach ($meta->attributes as $attr) {
                    $name = $attr->nodeName;
                    $value = $attr->nodeValue;
                    #echo "Attribute '$name' :: '$value'<br />";
                }
                #echo "<br />";
            }

            foreach ($html->getElementsByTagName('img') as $meta) {
                $img_parsed_url = parse_url($meta->getAttribute('src'));

                if (!$meta->getAttribute('src')) {
                    continue;
                }

                $is_relative = false;
                if (!isset($img_parsed_url['host'])) {
                    $is_relative = true;
                } elseif ($img_parsed_url['host'] == $parsed_url['path']) {
                    $is_relative = true;
                }
                array_push($images, ['src' => $meta->getAttribute('src'), 'alt' => trim($meta->getAttribute('alt')), 'is_relative' => $is_relative]);
                if (preg_match("/wp-content\b/i", $meta->getAttribute('src'))) {
                    $is_wordpress = true;
                }
            }

            foreach ($html->getElementsByTagName('a') as $meta) {
                $parsed_url_2 = parse_url($meta->getAttribute('href'));
                $is_internal = false;
                if (!isset($parsed_url_2['host'])) {
                    $is_internal = true;
                } elseif ($parsed_url_2['host'] == $parsed_url['path']) {
                    $is_internal = true;
                }
                array_push($links, ['src' => trim($meta->getAttribute('href')), 'value' => trim($meta->textContent), 'is_internal' => $is_internal, 'url' => $parsed_url_2]);
                #similar_text("Hello World","Hello Peter",$percent);
                if (isset($parsed_url_2['host']) && str_replace('www.', '', $parsed_url_2['host']) == "instagram.com") {
                    #return similar_text($parsed_url_2['path'], $parsed_url['path']);
                    #return levenshtein($parsed_url_2['path'], $title);
                    $instagram_account = str_replace('/', '', $parsed_url_2['path']);
                } else if (isset($parsed_url_2['host']) && (str_replace('www.', '', $parsed_url_2['host']) == "facebook.com" || str_replace('www.', '', $parsed_url_2['host']) == "fb.me")) {
                    $facebook_account = $parsed_url_2['path'];
                }

            }

            foreach ($html->getElementsByTagName('h1') as $meta) {
                array_push($h1s, ['value' => $meta->textContent]);
            }

            foreach ($html->getElementsByTagName('p') as $meta) {
                array_push($ps, $meta->textContent);
            }

            foreach ($html->getElementsByTagName('script') as $meta) {
                array_push($scripts, ['src' => $meta->nodeValue]);
                #check if contains UA- or if GTM
                if (preg_match("/\bUA-\b/i", $meta->nodeValue)) {
                    $uses_google_analytics = true;
                }
                if (preg_match("/\bGTM-\b/i", $meta->nodeValue)) {
                    $uses_google_tag_manager = true;
                }
            }
            // Sort the phrases by score and return the scores
            if (strpos($lang, 'en') !== false) {
                $lang = 'en_US';
                $text = implode(" ", $ps);
                $rake = RakePlus::create($text, $lang);
                $detected_keywords = $rake->sortByScore('desc')->scores();
                //print_r($phrase_scores);
            }

            return view('websiteDebug', compact('meta_tags', 'description', 'images', 'links', 'title', 'h1s', 'parsed_url', 'url', 'instagram_account', 'facebook_account', 'uses_google_analytics', 'uses_google_tag_manager', 'is_wordpress', 'image', 'lang', 'detected_keywords'));
            return json_encode($links);
        } catch (Exception $e) {
            return $e;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
