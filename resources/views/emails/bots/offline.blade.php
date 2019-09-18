@component('mail::message')
# Your bot is offline

Your bot has lost connection to our servers. Please follow the steps below to start getting your bot back online.

## To get your bot online

1. Unplug the bot from power and make sure all the lights go off
2. After all the lights go off, wait at least 10 seconds
3. Plug the bot back into power, and make sure the lights come on

Please note it may take up to two hours for the status to show 'Online' on our website.

@component('mail::button', ['url' => '/my-bots'])
See Bot Status
@endcomponent

## If you have changed something at home

If you've changed your WiFi name or password, changed where the bot is located, or have otherwise updated something in your local network, please send us an email.

## If the status online doesn't update even after you've followed the steps above

It may take up to two hours for the status to update on our website, but if the status doesn't change to 'Online', try the steps above once more. If after a day the status still doesn't change, please [email](mailto:{{config('mail.reply_to.address')}}) or [call](tel:+33486060859) us.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
