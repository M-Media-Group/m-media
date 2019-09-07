@component('mail::message')
# Your bot is offline

Your bot has lost connection to our servers. **Please unplug the power from the bot, wait 10 seconds, and reconnect the power.**

Please note it may take up to two hours for the status to update on our website.

@component('mail::button', ['url' => ''])
See Bot Status
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
