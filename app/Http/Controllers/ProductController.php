<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bot(Request $request)
    {
        $data = array(
            'title' => "Marketing Automation Bot",
            'price' => array(
                array(
                    'plan' => "basic",
                    'currency' => array(
                        'name' => "Euro",
                        'symbol' => "€",
                        'ISO' => "EUR",
                    ),
                    'value' => 73,
                    'type' => 'subscription',
                    'text' => '€73',
                ),
            ),
            'subtext' => "2 week delivery time",
            'text' => "Our number 1 seller - a Raspberry Pi pre-installed with M Media software and services ready to automate your digital and physical tasks for your business! Required for some subscription services.


M Media uses the automation bot for a range of services including to [engage with your customers on Instagram](/instagram-engagement) so you can focus on running your business.


You'll get an extra employee that works 365 days a year, 24 hours a day, doing all the things you hate. It doesn't make mistakes, and it doesn't get sick. Thanks to the advanced analytics interconnected with all our services, your automations get better by the day.


![Open Pi](/images/pi.png)


## One bot to rule them all.
Whenever we release free updates, introduce new marketing automations, and create new systems for handling your marketing, they'll all connect and install on to your marketing bot.

As we find creative ways to solve your business marketing needs, your bot will be with you, and us, every step of the way. New solutions will be tailored to work directly on your existing bot, wherever on the French Riviera it may be.

![Open Pi](/images/pi-nude.png)

## WiFi. Bluetooth. Unlimited expansions.
With 4 USB ports, an Ethernet port, an HDMI port, an audio jack, and 40 input/output pins (for sensors and other devices), your bot is limited only by what services we manage to build.

Your bot is incredibly powerful thanks to all the inputs it has available. We use the inputs for a lot; for example the USB port is used to attach an antenna when we [analyze foot-traffic ](/automation-bot) at your place of business.

![Pi in packaging box](/images/box.png)

## Want to return it? We'll buy it back.
Whether you're upgrading to a newer version of the bot or have switched systems completely and no longer need your current one, we'll buy it back from you for 50% of the price you paid, assuming it's in good condition and nothing is missing.",
            'image' => array(
                'url' => '/images/pi-hand2.png',
            ),
        );

        return view('product', $data);
    }

    public function instagramAnalysis(Request $request)
    {
        $data = array(
            'title' => "Instagram progress monitoring",
            'price' => array(
                array(
                    'plan' => "basic",
                    'currency' => array(
                        'name' => "Euro",
                        'symbol' => "€",
                        'ISO' => "EUR",
                    ),
                    'value' => 0,
                    'type' => 'subscription',
                    'text' => '€3 a month',
                ),
            ),
            'subtext' => "Daily Instagram stats",
            'text' => "This M Media service provides daily tracking of the amount of followers you have, and the amount of profiles you're following.


This service also comes free with our [Instagram content management](/instagram-content-management) and [Instagram engagement](/instagram-engagement) services, and helps you understand how our other subscription services benefit your brand.


## Want us to stop recording your profile history?
If your account is already being tracked and you do not want us to store any more historical data for your account, please [contact us](mailto:contact@mmediagroup.fr).",
            'image' => array(
                'url' => '/images/instagram-person-plus.svg',
            ),
            // 'actions' => [
            //     array('text' => 'Start the analysis tool', 'url' => '/tools/instagram-account-analyzer'),
            // ],
        );

        return view('product', $data);
    }

    public function engagement(Request $request)
    {
        $data = array(
            'title' => "Instagram Engagement",
            'price' => array(
                array(
                    'plan' => "basic",
                    'currency' => array(
                        'name' => "Euro",
                        'symbol' => "€",
                        'ISO' => "EUR",
                    ),
                    'value' => 17,
                    'type' => 'subscription',
                    'text' => 'From €17 a month',
                ),
            ),
            'subtext' => "+ Free monthly Excel reports",
            'text' => "M Media uses the [automation bot](/automation-bot) to handle your likes, follows, comments, and unfollows on Instagram, so you can focus on running your business.

You'll get an extra employee that works 365 days a year, 24 hours a day, doing all the repetitive but very important engagement on Instagram. It doesn't make mistakes, and it doesn't get sick.

Thanks to the advanced analytics interconnected with all our services, your automations get better by the day. Pair this service with one of our [Instagram content management](/instagram-content-management) plans for the full Instagram marketing potential.

## Plans tailored to your business.

Choose a plan that best suites your business needs. Want something different? Contact us!

### Basic
€17 per month. Comes with the following automations:
- Liking
- Commenting
- Following
- Unfollowing (with active followers 'don't unfollow' protection)
- Interactions based on the number of followers and/or following a user has
- Interactions based on the number of posts a user has
- Skipping private accounts, accounts with no profile picture, and/or business accounts
- Liking based on the number of existing likes a post has
- Commenting based on the number of existing comments a post has
- Commenting based on mandatory words in the description or first comment
- Comment by Locations
- Like by Locations
- Like by Tags
- Mandatory Words
- Restricting Likes
- Ignoring Users
- Ignoring Restrictions
- Excluding friends
- Smart Hashtags
- Quota Supervision
- Generate a list of a given users (e.g. your competition) Followers
- Generate a list of accounts that a given user is Following

### Pro
€76 per month. All of the basic features, +:
- Following by a list
- Follow someone else's followers
- Follow users that someone else is following
- Follow someone else's followers/following
- Follow the likers of photos of users
- Follow the commenters of photos of users
- Interact with specific users
- Interact with users that someone else is following
- Interact with someone else's followers
- Interact on posts at given URLs
- Like by Feeds

### Enterprise
€99 per month. All of the basic and pro features, +:
- Pick Unfollowers of a user
- Pick Nonfollowers of a user
- Pick Fans of a user
- Pick Mutual Following of a user
- Commenting based on what is on the picture using artificial intelligence
- Caption sentiment analysis

## No strings attached.

As with all of our monthly subscriptions, you can cancel this service at any time you wish, even if you've only used it for a month!
",
            'image' => array(
                'url' => '/images/instagram-like.png',
            ),
            'actions' => [
                array('text' => 'Read the online guide', 'url' => 'https://1drv.ms/w/s!AgzXTr18UdJfgSJgvUxlRIIh7-P7'),
                array('text' => 'Download sample Excel report', 'url' => '/samples/InstagramStats.xlsx'),
            ],
        );
        return view('product', $data);
    }

    public function contentCreation(Request $request)
    {
        $data = array(
            'title' => "Instagram Content Management",
            'price' => array(
                array(
                    'plan' => "basic",
                    'currency' => array(
                        'name' => "Euro",
                        'symbol' => "€",
                        'ISO' => "EUR",
                    ),
                    'value' => 147,
                    'type' => 'subscription',
                    'text' => 'From €147 a month',
                ),
            ),
            //'subtext' => "+ Free monthly Excel reports",
            'text' => "M Media uses analytics data to understand the best times to post your content to Instagram, and then does exactly that.

You'll get an extra employee that works 365 days a year, 24 hours a day, doing all the things you hate. It doesn't make mistakes, and it doesn't get sick.

Thanks to the advanced analytics interconnected with all our services, your automations get better by the day. Pair this service with one of our [Instagram engagement](/instagram-engagement) plans for the full Instagram marketing power.

## Plans tailored to your business.

Choose a plan that best suites your business needs. Want something different? Contact us!

### Basic
€147 per month. Includes:
- Instagram profile key-metrics analysis
- 2 posts per week
- Hashtags
- Images provided by you

### Pro
€559 per month. Includes:
- Up to €100 in Instagram paid marketing
- Instagram profile key-metrics analysis
- 3 posts per week
- Hashtags
- Images or videos provided by you and stock
- Custom written captions for each post

### Enterprise
€893 per month. Includes:
- Free monthly photography and vidography sessions
- Up to €100 in Instagram paid marketing
- Instagram profile key-metrics analysis
- 3-5 posts per week
- Hashtags
- Images or videos provided by us and you
- Custom written captions for each post

## No obligations.

As with all of our monthly subscriptions, you can cancel this service at any time you wish, even if you've used it for only a month!
",
            'image' => array(
                'url' => '/images/polaroid.svg',
            ),
            'actions' => [
                array('text' => 'See a sample profile', 'url' => '/samples/InstagramProfile.png'),
            ],
        );
        return view('product', $data);
    }

    public function packaging(Request $request)
    {
        $data = array(
            'title' => "Product Packaging",
            'price' => array(
                array(
                    'plan' => "basic",
                    'currency' => array(
                        'name' => "Euro",
                        'symbol' => "€",
                        'ISO' => "EUR",
                    ),
                    'value' => 15,
                    'type' => 'subscription',
                    'text' => '€1,13 - €10 per box',
                ),
            ),
            'subtext' => "1 month delivery time",
            'text' => "A Raspberry Pi pre-installed with M Media software and services - ready to automate digital and physical tasks at your place of business! Required for some subscription services.


Forget chasing clients for payments, sending invoices, manually ordering stock and shipping out orders, emails, and interacting with your followers on Instagram. With us, that's all handled by robots.


You'll get an extra employee that works 365 days a year, 24 hours a day, doing all the things you hate. It doesn't make mistakes, and it doesn't get sick. Thanks to the advanced analytics interconnected with all our services, your automations get better by the day.",
            'image' => array(
                'url' => '/images/box.png',
            ),
        );
        return view('product', $data);
    }

    public function webdev(Request $request)
    {
        $data = array(
            'title' => "Web Development",
            'price' => array(
                array(
                    'plan' => "basic",
                    'currency' => array(
                        'name' => "Euro",
                        'symbol' => "€",
                        'ISO' => "EUR",
                    ),
                    'value' => 15,
                    'type' => 'subscription',
                    'text' => 'From €1,500',
                ),
            ),
            'subtext' => "+ Free monthly Excel reports",
            'text' => "",
            'image' => array(
                'url' => '/images/devices2.svg',
            ),
        );
        return view('product', $data);
    }
}
