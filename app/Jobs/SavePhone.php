<?php

namespace App\Jobs;

use App\Country;
use App\Phone;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use libphonenumber\PhoneNumberType;

class SavePhone implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    protected $input;
    protected $user;
    protected $save;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($input, $save = true, User $user = null)
    {
        $this->input = $input;
        $this->user = $user;
        $this->save = $save;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $input = $this->input;
        $input['phonenumber'] = $input['phonenumber'];
        $input['country'] = $input['country'] ?? null;
        $input['language'] = (isset($input['language']) && $input['language'] != '') ? $input['language'] : 'en';
        $input['region'] = (isset($input['region']) && $input['region'] != '') ? $input['region'] : null;

        $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $phoneNumberGeocoder = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();

        $validNumber = false;
        $validNumberForRegion = false;
        $possibleNumber = false;
        $isPossibleNumberWithReason = null;
        $geolocation = null;
        $phoneNumberToCarrierInfo = null;
        $timezone = null;

        try {
            $phoneNumber = $phoneNumberUtil->parse($input['phonenumber'], strtoupper($input['country']), null, true);
        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 422);
            //abort(403, $e->getMessage());
        }
        $possibleNumber = $phoneNumberUtil->isPossibleNumber($phoneNumber);
        $isPossibleNumberWithReason = $phoneNumberUtil->isPossibleNumberWithReason($phoneNumber);
        $validNumber = $phoneNumberUtil->isValidNumber($phoneNumber);
        if (!$validNumber) {
            return response()->json(['Error' => 'This is not a valid number.'], 422);
        }
        $validNumberForRegion = $phoneNumberUtil->isValidNumberForRegion($phoneNumber, strtoupper($input['country']));
        $phoneNumberRegion = $phoneNumberUtil->getRegionCodeForNumber($phoneNumber);
        $phoneNumberType = $phoneNumberUtil->getNumberType($phoneNumber);

        $e164 = $phoneNumberUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::E164);
        $nationalNumber = $phoneNumberUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::NATIONAL);

        $phoneNumberToCarrierInfo = \libphonenumber\PhoneNumberToCarrierMapper::getInstance()->getNameForNumber(
            $phoneNumber,
            $input['language']
        );
        $timezone = \libphonenumber\PhoneNumberToTimeZonesMapper::getInstance()->getTimeZonesForNumber($phoneNumber);

        $country = SaveCountry::dispatchNow($phoneNumberRegion);

        if ($this->save == false) {
            $types = PhoneNumberType::values();
            $type = $types[$phoneNumberType];

            return [
                'e164' => $e164,
                'number' => $nationalNumber,
                'number_type' => $type,
                'country_id' => $country->id,
                'timezone' => $timezone[0],
                'description' => $phoneNumberToCarrierInfo,
                'user_id' => $this->user ? $this->user->id : null,
                'is_public' => 0,
                'country' => $country,
            ];
        }
        $phone = Phone::firstOrCreate(
            ['e164' => $e164],
            [
                'number' => $nationalNumber,
                'number_type' => $phoneNumberType,
                'country_id' => $country->id,
                'timezone' => $timezone[0],
                'description' => $phoneNumberToCarrierInfo,
                'user_id' => $this->user ? $this->user->id : null,
                'is_public' => 0,
            ]
        )->load('defaultForUser', 'user');
        $phone->country = $country;

        return $phone;
    }
}
