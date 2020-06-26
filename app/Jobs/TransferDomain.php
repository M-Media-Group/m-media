<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TransferDomain implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    protected $domainName;
    protected $awsClient;
    protected $user;
    protected $siteAdmin;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($domainName, User $user)
    {
        $this->domainName = $domainName;
        $this->awsClient = \AWS::createClient('Route53Domains', ['region' => 'us-east-1']);
        $this->user = $user;
        $this->siteAdmin = \App\User::where('id', config('blog.super_admin_id'))->firstOrFail();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $site_contact = [ // REQUIRED
            'AddressLine1' => config('blog.address'),
            // 'AddressLine2' => '<string>',
            'City' => config('blog.city'),
            'ContactType' => 'COMPANY',
            'CountryCode' => config('blog.country_iso'),
            'Email' => config('mail.reply_to.address'),
            // 'ExtraParams' => [
            //     [
            //         'Name' => 'DUNS_NUMBER|BRAND_NUMBER|BIRTH_DEPARTMENT|BIRTH_DATE_IN_YYYY_MM_DD|BIRTH_COUNTRY|BIRTH_CITY|DOCUMENT_NUMBER|AU_ID_NUMBER|AU_ID_TYPE|CA_LEGAL_TYPE|CA_BUSINESS_ENTITY_TYPE|CA_LEGAL_REPRESENTATIVE|CA_LEGAL_REPRESENTATIVE_CAPACITY|ES_IDENTIFICATION|ES_IDENTIFICATION_TYPE|ES_LEGAL_FORM|FI_BUSINESS_NUMBER|FI_ID_NUMBER|FI_NATIONALITY|FI_ORGANIZATION_TYPE|IT_NATIONALITY|IT_PIN|IT_REGISTRANT_ENTITY_TYPE|RU_PASSPORT_DATA|SE_ID_NUMBER|SG_ID_NUMBER|VAT_NUMBER|UK_CONTACT_TYPE|UK_COMPANY_NUMBER', // REQUIRED
            //         'Value' => '<string>', // REQUIRED
            //     ],
            //     // ...
            // ],
            // 'Fax' => '<string>',
            'FirstName' => $this->siteAdmin->name,
            'LastName' => $this->siteAdmin->surname,
            'OrganizationName' => config('app.name'),
            'PhoneNumber' => $this->formatPhoneNumber(config('blog.e164')),
            // 'State' => '<string>',
            'ZipCode' => config('blog.postal_code'),
        ];

        return $this->awsClient->transferDomain([
            'AdminContact' => $site_contact,
            'AuthCode' => '<string>',
            'AutoRenew' => true,
            'DomainName' => $this->domainName, // REQUIRED
            'DurationInYears' => 1, // REQUIRED
            // 'Nameservers' => [
            //     [
            //         'GlueIps' => ['<string>'],
            //         'Name' => '<string>', // REQUIRED
            //     ],
            //     // ...
            // ],
            'PrivacyProtectAdminContact' => true,
            'PrivacyProtectRegistrantContact' => true,
            'PrivacyProtectTechContact' => true,
            'RegistrantContact' => [ // REQUIRED
                'AddressLine1' => optional($this->user->billingAddress)->address,
                // 'AddressLine2' => '<string>',
                'City' => $this->user->billingAddress->city->name ?? null,
                'ContactType' => 'PERSON',
                'CountryCode' => $this->user->billingAddress->city->country->iso ?? 'FR',
                'Email' => $this->user->email,
                'FirstName' => $this->user->name,
                'LastName' => $this->user->surname,
                // 'OrganizationName' => '<string>',
                'PhoneNumber' => $this->formatPhoneNumber(optional($this->user->primaryPhone)->e164),
                // 'State' => '<string>',
                'ZipCode' => optional($this->user->billingAddress)->postal_code,
            ],
            'TechContact' => $site_contact,
        ]);
    }

    private function formatPhoneNumber($number)
    {
        $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $phoneNumber = $phoneNumberUtil->parse($number);
        $country_code = $phoneNumber->getCountryCode();
        $just_number = str_replace('+' . $country_code, '', $number);
        return '+' . $country_code . '.' . $just_number;
    }
}
