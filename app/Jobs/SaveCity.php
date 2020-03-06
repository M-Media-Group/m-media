<?php

namespace App\Jobs;

use App\City;
use App\Country;
use App\Jobs\SaveCountry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveCity implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $name;
    protected $iso;
    protected $country_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->name = $input['name'];
        $this->iso = $input['iso'] ?? null;
        $this->country_id = strtoupper($input['country_id'] ?? null);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->country_id) {
            $country = Country::findOrFail($this->country_id);
        } elseif ($this->iso) {
            $country = SaveCountry::dispatchNow($this->iso);
        } else {
            abort(422, "No country ID or ISO code provided");
        }

        $city = City::firstOrCreate(
            ['name' => $this->name, 'country_id' => $country->id ?? $this->country_id]
        );

        return $city->load('country');

    }
}
