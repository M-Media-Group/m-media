<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteDebuggerController extends Controller
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
            //return $url;
            $sites_html = file_get_contents($url);

            $html = new \DOMDocument();
            @$html->loadHTML($sites_html);
            $meta_og_img = null;
            $meta_tags = [];
            $images = [];
            $links = [];
            $h1s = [];
            $title = null;
            $instagram_account = null;

            $list = $html->getElementsByTagName("title");
            if ($list->length > 0) {
                $title = $list->item(0)->textContent;
            }

//Get all meta tags and loop through them.
            foreach ($html->getElementsByTagName('meta') as $meta) {
                //If the property attribute of the meta tag is og:image

                //$meta_tags[] .= $meta->nodeName;

                foreach ($meta->attributes as $attr) {
                    $name = $attr->nodeName;
                    $value = $attr->nodeValue;
                    echo "Attribute '$name' :: '$value'<br />";
                }
                echo "<br />";
            }

            foreach ($html->getElementsByTagName('img') as $meta) {
                array_push($images, ['src' => $meta->getAttribute('src'), 'alt' => $meta->getAttribute('alt')]);
            }

            foreach ($html->getElementsByTagName('a') as $meta) {
                $parsed_url_2 = parse_url($meta->getAttribute('href'));
                $is_internal = false;
                if (!isset($parsed_url_2['host'])) {
                    $is_internal = true;
                } elseif ($parsed_url_2['host'] == $parsed_url['path']) {
                    $is_internal = true;
                }
                array_push($links, ['src' => $meta->getAttribute('href'), 'value' => $meta->textContent, 'is_internal' => $is_internal, 'url' => $parsed_url_2]);
                #similar_text("Hello World","Hello Peter",$percent);
                if (isset($parsed_url_2['host']) && $parsed_url_2['host'] == "instagram.com") {
                    #return similar_text($parsed_url_2['path'], $parsed_url['path']);
                    #return levenshtein($parsed_url_2['path'], $title);
                    $instagram_account = $parsed_url_2['path'];
                }
            }

            foreach ($html->getElementsByTagName('h1') as $meta) {
                array_push($h1s, ['value' => $meta->textContent]);
            }
            return view('websiteDebug', compact('meta_tags', 'images', 'links', 'title', 'h1s', 'parsed_url', 'url', 'instagram_account'));
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
