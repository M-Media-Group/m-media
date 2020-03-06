<?php

namespace App\Jobs;

use App\Country;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveCountry implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $iso;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($iso)
    {
        $this->iso = strtoupper($iso);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // If ISO is too long or too short abort
        if (!$this->iso || strlen($this->iso) > 3 || strlen($this->iso) < 2) {
            abort(422, "The ISO code is invalid");
        }

        $input['name'] = \Locale::getDisplayRegion('-' . $this->iso, 'en');

        // If ISO is invalid getDisplayRegion() will return the same ISO as it was provided with
        if ($this->iso == $input['name']) {
            abort(422, "The ISO code is invalid or we couldn't find the name of the country");
        }

        $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $calling_code = $phoneNumberUtil->getCountryCodeForRegion($this->iso);

        // If ISO is invalid getCountryCodeForRegion() will return 0
        if ($calling_code == 0) {
            abort(422, "The ISO code is invalid or we couldn't find the calling code of the country");
        }

        $country = Country::firstOrCreate(
            ['iso' => $this->iso],
            ['name' => $input['name'], 'calling_code' => $calling_code]
        );

        return $country;
    }
}
