<?php

namespace App\Http\Controllers;

use App\Website;
use AWS;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sms = AWS::createClient('Route53Domains', ['region' => 'us-east-1']);

        return $sms->listDomains()->get('Domains');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    public function transfer($domain)
    {
        return App\Jobs\TransferDomain::dispatchNow($domain, \App\User::first());
    }

    public function checkAvailability($domain)
    {
        $sms = AWS::createClient('Route53Domains', ['region' => 'us-east-1']);

        return response()->json(['availability' => $sms->checkDomainAvailability(['DomainName' => $domain])->get('Availability')]);
    }

    public function checkTransferability($domain)
    {
        $sms = AWS::createClient('Route53Domains', ['region' => 'us-east-1']);

        return response()->json(['transferability' => $sms->checkDomainTransferability(['DomainName' => $domain])->get('Transferability')['Transferable']]);
    }

    public function suggest($domain)
    {
        $sms = AWS::createClient('Route53Domains', ['region' => 'us-east-1']);
        $list = $sms->GetDomainSuggestions(['DomainName' => $domain, 'OnlyAvailable' => true, 'SuggestionCount' => 50])->get('SuggestionsList');
        $new_list = [];
        foreach ($list as $item) {
            //$new_list[strstr($item['DomainName'], '.')][]['domain'] = $item['DomainName'];
            $new_list[] = ['domain' => $item['DomainName'], 'tld' => strstr($item['DomainName'], '.')];
        }

        return response()->json(['suggestions' => $new_list]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Website $website
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Website $website
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Website             $website
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Website $website
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        //
    }
}
