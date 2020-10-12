<?php

namespace App\Http\Controllers;

use App\AdAccount;
use Edbizarro\LaravelFacebookAds\Facades\FacebookAds;
use Edujugon\GoogleAds\GoogleAds;
use Illuminate\Http\Request;

class AdAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->input('user');

        // $bot = Bot::findOrFail($id);
        $this->authorize('index', AdAccount::class);

        $accounts = AdAccount::with('platform')->when($user, function ($query, $user) {
            return $query->where('user_id', $user);
        })->get();

        $all_users = \App\User::all();
        $users = collect();

        foreach ($all_users as $user) {
            $data = [
                'full_name' => $user->full_name,
                'id' => $user->id,
            ];
            $users->push($data);
        }

        return view('adAccounts.index', compact('accounts', 'users'));

        return $accounts;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdAccount  $adAccount
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AdAccount $adAccount)
    {
        $this->authorize('show', $adAccount);
        $ads = null;
        if ($adAccount->platform->name == 'Google Ads') {
            $ads = $this->getGoogleData($adAccount);
            $data_to_return = ['account' => $adAccount, 'ads' => $ads];
        } elseif ($adAccount->platform->name == 'Facebook Ads') {
            $ads = $this->getFacebookData($adAccount);
            $data_to_return = ['account' => $adAccount, 'ads' => $ads];
        } else {
            $data_to_return = ['account' => $adAccount, 'ads' => 'Unsupported ads platform'];
        }

        if ($request->is('api*')) {
            return $data_to_return;
        } else {
            $ads = collect($ads);

            return view('adAccounts.show', compact('adAccount', 'ads'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdAccount  $adAccount
     * @return \Illuminate\Http\Response
     */
    private function getGoogleData(AdAccount $adAccount)
    {
        $googleAds = new GoogleAds();
        $googleAds->session([
            'clientCustomerId' => $adAccount->external_account_id,
        ]);
        // dd($googleAds->report()->from('AD_PERFORMANCE_REPORT')->getFields());
        $fetched_data = $googleAds->report()
            ->from('AD_PERFORMANCE_REPORT')
            ->select(
                'AllConversionRate',
                'AllConversions',
                'AllConversionValue',
                'AverageCpc',
                'CampaignId',
                'Clicks',
                'Cost',
                'Id',
                'ImageAdUrl',
                'Impressions',
                'AdGroupName',
                'Status',
                'AccountCurrencyCode',
                'CampaignStatus',
                'AdGroupStatus',
                'Labels'
            )
            ->getAsObj();
        //dd($fetched_data->result);
        $ads = collect();
        foreach ($fetched_data->result as $ad) {
            $ad_array = (object) [
                'id' => $ad->adID,
                'name' => $ad->adGroup,
                'clicks' => (int) $ad->clicks,
                'cost' => (float) $ad->cost != 0 ? $ad->cost / 1000000 : 0,
                'currency' => $ad->currency,
                'conversions' => (int) $ad->allConv,
                'conversion_rate' => $ad->allConvRate,
                'image_url' => $ad->imageAdURL == '--' ? null : $ad->imageAdURL,
                'impressions' => (int) $ad->impressions,
                'is_active' => $ad->adState == 'enabled' && $ad->campaignState == 'enabled' && $ad->adGroupState == 'enabled' ? 1 : 0,
                'created_at' => null,
            ];
            $ads->push($ad_array);
        }

        return $ads;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdAccount  $adAccount
     * @return \Illuminate\Http\Response
     */
    private function getFacebookData(AdAccount $adAccount)
    {
        FacebookAds::init(config('facebook-ads.refresh_token'));
        $ads = collect();
        // $adsApi = FacebookAds();
        // $per = Period::years(1);
        //return $per;
        // $campaigns = FacebookAds::insights($per, 'act_' . $adAccount->external_account_id, 'ad', ["date_preset" => "lifetime", "time_increment" => "all_days", "fields" => ["account_id", "account_name", "clicks", "conversions", "spend", "impressions", "ad_name", "purchase_roas", "account_currency", "frequency"]]);
        //return dd($campaigns);
        $fetched_data = FacebookAds::adAccounts()->get(['account_id', 'balance', 'name', 'owner', 'amount_spent'], 'act_' . $adAccount->external_account_id)->ads(['name',
            'account_id',
            'account_status',
            'balance',
            'campaign',
            'campaign_id',
            'effective_status',
            'created_time',
            'adlabels',
            // 'insights{impressions, clicks, conversions}',
            'insights.fields(impressions, outbound_clicks, actions, action_values, conversion_values, conversions, spend, account_currency, website_ctr).date_preset(lifetime).time_increment(all_days)',
        ]);

        // $newObj = (object) [];

        // foreach ($ads as $prop => $val) {
        //     var_dump($val);
        //     $newObj->{trim($prop)} = trim($val);
        // }

        // $ads = $newObj;

        // unset($newObj);

        // $campaigns->all(['name'], 'act_<AD_ACCOUNT_ID>');
        return ($fetched_data);
        foreach ($fetched_data as $ad) {
            //var_dump($ad->__get('insights')['data'][0]['clicks']);
            $conversions_count = 0;

            // if (isset($ad->__get('insights')['data'][0]['conversions'])) {
            //     foreach ($ad->__get('insights')['data'][0]['conversions'] as $conversion) {
            //         $conversions_count += $conversion['value'];
            //     }
            // }

            try {
                if (isset($ad->__get('insights')['data'][0]['actions'])) {
                    foreach ($ad->__get('insights')['data'][0]['actions'] as $conversion) {
                        $conversions_count += $conversion['value'];
                    }
                }
            } catch (\Exception $e) {
                continue;
            }

            $clicks = isset($ad->__get('insights')['data'][0]['outbound_clicks']) ? (int) $ad->__get('insights')['data'][0]['outbound_clicks'][0]['value'] : null;

            $ad_array = (object) [
                'id' => $ad->__get('id'),
                'name' => $ad->__get('name'),
                'clicks' => $clicks,
                'cost' => (float) $ad->__get('insights')['data'][0]['spend'],
                'currency' => $ad->__get('insights')['data'][0]['account_currency'],
                'conversions' => (int) $conversions_count,
                'conversion_rate' => null,
                'image_url' => null,
                'impressions' => (int) $ad->__get('insights')['data'][0]['impressions'],
                'is_active' => $ad->__get('effective_status') == 'ACTIVE' ? 1 : 0,
                'created_at' => \Carbon\Carbon::parse($ad->__get('created_time')),
            ];
            $ads->push($ad_array);
        }

        return $ads;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdAccount  $adAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(AdAccount $adAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdAccount  $adAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdAccount $adAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdAccount  $adAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdAccount $adAccount)
    {
        //
    }
}
