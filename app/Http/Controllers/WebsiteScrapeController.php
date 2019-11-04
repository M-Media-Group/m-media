<?php

namespace App\Http\Controllers;

use App\Jobs\ScrapeWebsite;
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
        $this->middleware(['verified', 'optimizeImages']);
    }

    public function index(Request $request, $url)
    {
        return dns_get_record('mmediagroup.fr' . '.', DNS_A + DNS_CNAME + DNS_MX + DNS_NS + DNS_SOA + DNS_TXT + DNS_AAAA);
        //$data = ScrapePage::dispatchNow($url, $request->input('page') ?? null);
        $data = ScrapeWebsite::dispatchNow($url);

        return $data;

        try {
            return view('websiteDebug', $data);
        } catch (\Exception $e) {
            //return dump($e);
            return response()->json($data->original, 422);
            //return abort(500, $data->original['Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
