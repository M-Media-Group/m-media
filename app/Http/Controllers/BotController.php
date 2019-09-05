<?php

namespace App\Http\Controllers;

use App\Bot;
use App\Country;
use App\PhoneLog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PhoneLogController extends Controller
{

    public function index(Request $request)
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.remot3.it/apv/v27/device/list/all');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        return $body;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2(Request $request)
    {

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => "https://api.remot3.it/apv/v27/user/login",
            CURLOPT_HTTPHEADER => array(
                "developerkey: " . $_ENV["REMOTEIT_DEVELOPER_KEY"],
            ),
            CURLOPT_POSTFIELDS => json_encode(array(
                "username" => $_ENV["REMOTEIT_USERNAME"],
                "password" => $_ENV["REMOTEIT_PASSWORD"],
            )),
            CURLOPT_RETURNTRANSFER => true,
        ));
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        print("Status Code: " . $statusCode . "\n");
        $responseData = json_decode($response);
        print_r($responseData);

        curl_setopt_array($ch, array(
            CURLOPT_URL => "https://api.remot3.it/apv/v27/device/list/all",
            CURLOPT_HTTPHEADER => array(
                "developerkey: " . $_ENV["REMOTEIT_DEVELOPER_KEY"],
                "token: " . $_ENV["REMOTEIT_TOKEN"], // Created using the login API
            ),
            CURLOPT_RETURNTRANSFER => true,
        ));
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        print("Status Code: " . $statusCode . "\n");
        $responseData = json_decode($response);
        print_r($responseData);
        return Bot::get();
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
        $input = array();
        $input['phonenumber'] = $request->input('number');
        $input['country'] = ($request->input('country')) ? $request->input('country') : null;
        $input['callType'] = ($request->input('type')) ? $request->input('type') : 'INBOUND';
        $input['callNotes'] = ($request->input('notes')) ? $request->input('notes') : null;
        $input['language'] = (isset($request['language']) && $request['language'] != '') ? $request['language'] : 'en';
        $input['region'] = (isset($request['region']) && $request['region'] != '') ? $request['region'] : null;

        $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $phoneNumberGeocoder = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();

        $validNumber = false;
        $validNumberForRegion = false;
        $possibleNumber = false;
        $isPossibleNumberWithReason = null;
        $geolocation = null;
        $phoneNumberToCarrierInfo = null;
        $timezone = null;

        $phoneNumber = $phoneNumberUtil->parse($input['phonenumber'], $input['country'], null, true);
        $possibleNumber = $phoneNumberUtil->isPossibleNumber($phoneNumber);
        $isPossibleNumberWithReason = $phoneNumberUtil->isPossibleNumberWithReason($phoneNumber);
        $validNumber = $phoneNumberUtil->isValidNumber($phoneNumber);
        if (!$validNumber) {
            return response()->json(['Error' => "This is not a valid number"], 422);

        }
        $validNumberForRegion = $phoneNumberUtil->isValidNumberForRegion($phoneNumber, $input['country']);
        $phoneNumberRegion = $phoneNumberUtil->getRegionCodeForNumber($phoneNumber);
        $phoneNumberType = $phoneNumberUtil->getNumberType($phoneNumber);
        $geolocation = $phoneNumberGeocoder->getDescriptionForNumber(
            $phoneNumber,
            $input['language'],
            $input['region']
        );

        $e164 = $phoneNumberUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::E164);
        $nationalNumber = $phoneNumberUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::NATIONAL);

        $phoneNumberToCarrierInfo = \libphonenumber\PhoneNumberToCarrierMapper::getInstance()->getNameForNumber(
            $phoneNumber,
            $input['language']
        );
        $timezone = \libphonenumber\PhoneNumberToTimeZonesMapper::getInstance()->getTimeZonesForNumber($phoneNumber);

        $countryCode = $phoneNumberUtil->getCountryCodeForRegion($phoneNumberRegion);
        $country = Country::firstOrCreate(
            ['iso' => $phoneNumberRegion],
            ['name' => $geolocation, 'calling_code' => $countryCode]
        );
        $phone = Phone::firstOrCreate(
            ['e164' => $e164],
            [
                'number' => $nationalNumber,
                #   'possibleNumber' => $possibleNumber,
                #   'validNumber' => $validNumber,
                #    'validNumberForRegion' => $validNumberForRegion,
                'number_type' => $phoneNumberType,
                'country_id' => $country->id,
                'timezone' => $timezone[0],
                'description' => $phoneNumberToCarrierInfo,
                'user_id' => null,
                'is_public' => 0,
            ]
        )->load('defaultForUser', 'user');
        $phone->country = $country;
        PhoneLog::create(['phone_id' => $phone->id, 'type' => $input['callNotes'], 'type' => $input['callType']]);
        $phone->logs = PhoneLog::where('phone_id', $phone->id)->get();

        return $phone;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        # PhoneLog::create(['phone_id' => $phone->id, 'type' => 'INBOUND']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $PhoneLog = PhoneLog::findOrFail($id);

        $request->validate([
            'notes' => 'nullable',
            'ended_at' => 'nullable',
        ]);

        $PhoneLog->update($request->only('notes', 'ended_at'));
        return $PhoneLog;

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
