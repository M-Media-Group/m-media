<?php

namespace App\Jobs;

use App\Address;
use App\Jobs\SaveCity;
use DB;
use Geocoder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveAddress implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $lng;
    protected $lat;
    protected $user_id;
    protected $city_id;
    protected $address;
    protected $city_name;
    protected $iso;
    protected $postal_code;
    protected $country_id;
    protected $country_name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->lng = $input['lng'] ?? null;
        $this->lat = $input['lat'] ?? null;
        $this->user_id = $input['user_id'] ?? null;
        $this->city_id = $input['city_id'] ?? null;
        $this->address = $input['address'] ?? null;
        $this->city_name = $input['city_name'] ?? null;
        $this->iso = $input['iso'] ?? null;
        $this->postal_code = $input['postal_code'] ?? null;
        $this->country_id = strtoupper($input['country_id'] ?? null);
        $this->country_name = null;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->lng && $this->lat) {
            $geocoded_data = Geocoder::getAddressForCoordinates($this->lat, $this->lng);

            $country = SaveCountry::dispatchNow($this->getComponent($geocoded_data['address_components'], 'country', false));
        } elseif ($this->address) {
            if ($this->country_id) {
                $country = Country::findOrFail($this->country_id);
            } elseif ($this->iso) {
                $country = SaveCountry::dispatchNow($this->iso);
            } else {
                abort(422, 'Some information is missing to determine the country');
            }

            if ($this->city_id) {
                $city = City::findOrFail($this->city_id);
                $this->city_name = $city->name;
            } elseif ($this->city_name) {
                // $city = SaveCity::dispatchNow([
                //     'name' => $city_name_from_google,
                //     'country_id' => $this->country_id,
                //     'iso' => $this->iso,
                // ]);
            } else {
                abort(422, 'Some information is missing to determine the city');
            }

            $geocoded_data = Geocoder::setLanguage('en-GB')->setCountry($this->iso)->getCoordinatesForAddress($this->address.', '.$this->city_name);
        } else {
            abort(422, 'Some information is missing');
        }

        if ($geocoded_data['accuracy'] == 'result_not_found') {
            abort(422, 'Address not found');
        }

        $this->postal_code = $this->getComponent($geocoded_data['address_components'], 'postal_code');
        $city_name_from_google = $this->getComponent($geocoded_data['address_components'], 'locality');

        if (! $this->postal_code) {
            abort(422, 'Postal code not found');
        }

        if (! $city_name_from_google) {
            abort(422, 'Address not found (not in city administrative area)');
        }

        $this->address = $geocoded_data['formatted_address'];
        $this->address = str_replace(', '.$this->getComponent($geocoded_data['address_components'], 'country'), '', $this->address);
        $this->address = str_replace(' '.$city_name_from_google, '', $this->address);
        $this->address = str_replace($this->postal_code, '', $this->address);
        $this->address = trim($this->address);
        $this->address = rtrim($this->address, ',');

        $this->iso = $country->iso;
        $this->country_id = $country->id;
        $this->country_name = $country->name;

        $this->lat = $geocoded_data['lat'];
        $this->lng = $geocoded_data['lng'];

        $city = SaveCity::dispatchNow([
            'name' => $city_name_from_google,
            'country_id' => $this->country_id,
            'iso' => $this->iso,
        ]);

        $this->city_id = $city->id;
        $this->city_name = $city->name;

        $location = DB::raw("(GeomFromText('POINT(".$this->lat.' '.$this->lng.")'))");

        // Removes country, city, and postal code from address string effectively making it into an address line

        $address = Address::firstOrCreate(
            [
                'address' => $this->address,
                'location' => $location,
                'city_id' => $this->city_id,
                'postal_code' => $this->postal_code,
                'user_id' => $this->user_id,
            ]
        );

        return $address->load('city.country');
    }

    private function getComponent($address_components, $value, $long = true)
    {
        foreach ($address_components as $component) {
            if (in_array($value, $component->types)) {
                return $long ? $component->long_name : $component->short_name;
            }
            continue;
        }
    }
}
