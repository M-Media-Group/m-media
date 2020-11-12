<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailCanReceiveMail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $stopwords = ['no-reply', 'noreply', 'automate', 'pas.repondre', 'pas-repondre', 'no.reply', 'notreply', 'not-reply'];
        $email_username = strtolower(substr($value, 0, strpos($value, '@')));
        if (str_replace($stopwords, '', $email_username) == $email_username) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This email address can not receive emails from us. Please use a different email address.';
    }
}
