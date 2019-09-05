<?php

namespace App\Http\Controllers;

use App\Country;
use App\Phone;
use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentActionRequired($payload)
    {
        // Handle The Event
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerUpdated($payload)
    {
        if ($payload['data']['object']['phone']) {
            $user = User::firstOrCreate(['stripe_id' => $payload['data']['object']['id']], [
                "email" => $payload['data']['object']['email'],
                "password" => Hash::make($payload['data']['object']['id']),
            ]);
            $input = array();
            $input['phonenumber'] = $payload['data']['object']['phone'];
            $input['country'] = null;
            $input['language'] = 'en';
            $input['region'] = null;

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
                    'user_id' => $user->id,
                    'is_public' => 0,
                ]
            );
        } else {
            $phone->id = null;
        }
        $user = User::updateOrCreate(['stripe_id' => $payload['data']['object']['id']], [
            "email" => $payload['data']['object']['email'],
            "phone" => $phone->id,
        ]);

        return response('Webhook Handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerDeleted($payload)
    {
        // Handle The Event
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerCreated($payload)
    {
        $user = User::firstOrCreate(['stripe_id' => $payload['data']['object']['id']], [
            "email" => $payload['data']['object']['email'],
            "password" => Hash::make($payload['data']['object']['id']),
        ]);

        if ($payload['data']['object']['phone']) {
            $input = array();
            $input['phonenumber'] = $payload['data']['object']['phone'];
            $input['country'] = null;
            $input['language'] = 'en';
            $input['region'] = null;

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
                    'user_id' => $user->id,
                    'is_public' => 0,
                ]
            );
        } else {
            $phone->id = null;
        }
        $user = User::updateOrCreate(['stripe_id' => $payload['data']['object']['id']], [
            "email" => $payload['data']['object']['email'],
            "phone" => $phone->id,
        ]);

        return response('Webhook Handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerSubscriptionUpdated($payload)
    {
        // Handle The Event
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerSubscriptionDeleted($payload)
    {
        // Handle The Event
    }
}
