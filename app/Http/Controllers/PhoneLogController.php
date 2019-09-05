<?php

namespace App\Http\Controllers;

use App\Country;
use App\Phone;
use App\PhoneLog;
use Illuminate\Http\Request;

class PhoneLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return PhoneLog::get();
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
