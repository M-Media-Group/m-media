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
        $data = [
            'title' => 'Marketing Automation Bot',
            'price' => [
                [
                    'plan' => 'basic',
                    'currency' => [
                        'name' => 'Euro',
                        'symbol' => '€',
                        'ISO' => 'EUR',
                    ],
                    'value' => 73,
                    'type' => 'subscription',
                    'text' => '€73',
                ],
            ],
            'subtext' => '2 week delivery time',
            'text' => "Our number 1 seller - a micro computer pre-installed with M Media software and services ready to automate your digital and physical tasks for your business! Required for some subscription services.


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
            'image' => [
                'url' => '/images/pi-hand2.png',
            ],
        ];

        return view('product', $data);
    }

    public function instagramAnalysis(Request $request)
    {
        $data = [
            'title' => 'Instagram progress monitoring',
            'price' => [
                [
                    'plan' => 'basic',
                    'currency' => [
                        'name' => 'Euro',
                        'symbol' => '€',
                        'ISO' => 'EUR',
                    ],
                    'value' => 5,
                    'type' => 'subscription',
                    'text' => '€5 a month',
                ],
            ],
            'subtext' => 'Daily Instagram stats',
            'text' => "This M Media service provides daily tracking of the amount of followers you have, and the amount of profiles you're following.


We'll also track your follower to following ratio, and your engagement health. You'll get daily M Media suggestions to improve your performance on Instagram.


This service comes free with our [Instagram content management](/instagram-content-management) and [Instagram engagement](/instagram-engagement) services, and helps you understand how our other subscription services benefit your brand.


## Want us to stop recording your profile history?
If your account is already being tracked and you do not want us to store any more historical data for your account, please [contact us](/contact).",
            'image' => [
                'url' => '/images/instagram-person-plus.svg',
            ],
            // 'actions' => [
            //     array('text' => 'Start the analysis tool', 'url' => '/tools/instagram-account-analyzer'),
            // ],
        ];

        return view('product', $data);
    }

    public function engagement(Request $request)
    {
        $data = [
            'title' => 'Instagram Engagement',
            'price' => [
                [
                    'plan' => 'basic',
                    'currency' => [
                        'name' => 'Euro',
                        'symbol' => '€',
                        'ISO' => 'EUR',
                    ],
                    'value' => 17,
                    'type' => 'subscription',
                    'text' => 'From €17 a month',
                ],
            ],
            'subtext' => 'This service is temporarily unavailable',
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
            'image' => [
                'url' => '/images/instagram-like.png',
            ],
            'actions' => [
                ['text' => 'Read the online guide', 'url' => 'https://1drv.ms/w/s!AgzXTr18UdJfgSJgvUxlRIIh7-P7'],
                ['text' => 'Download sample Excel report', 'url' => '/samples/InstagramStats.xlsx'],
            ],
        ];

        return view('product', $data);
    }

    public function contentCreation(Request $request)
    {
        $data = [
            'title' => 'Instagram Content Management',
            'price' => [
                [
                    'plan' => 'basic',
                    'currency' => [
                        'name' => 'Euro',
                        'symbol' => '€',
                        'ISO' => 'EUR',
                    ],
                    'value' => 147,
                    'type' => 'subscription',
                    'text' => 'From €147 a month',
                ],
            ],
            'subtext' => '+ Free progress reports',
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
- Free monthly photography and videography sessions
- Up to €100 in Instagram paid marketing
- Instagram profile key-metrics analysis
- 3-5 posts per week
- Hashtags
- Images or videos provided by us and you
- Custom written captions for each post

## No obligations.

As with all of our monthly subscriptions, you can cancel this service at any time you wish, even if you've used it for only a month!
",
            'image' => [
                'url' => '/images/polaroid.svg',
            ],
            'actions' => [
                ['text' => 'See a sample profile', 'url' => '/samples/InstagramProfile.png'],
            ],
        ];

        return view('product', $data);
    }

    public function packaging(Request $request)
    {
        $data = [
            'title' => 'Product Packaging',
            'price' => [
                [
                    'plan' => 'basic',
                    'currency' => [
                        'name' => 'Euro',
                        'symbol' => '€',
                        'ISO' => 'EUR',
                    ],
                    'value' => 15,
                    'type' => 'subscription',
                    'text' => '€1,13 - €10 per box',
                ],
            ],
            'subtext' => '1 month delivery time',
            'text' => "A micro computer pre-installed with M Media software and services - ready to automate digital and physical tasks at your place of business! Required for some subscription services.


Forget chasing clients for payments, sending invoices, manually ordering stock and shipping out orders, emails, and interacting with your followers on Instagram. With us, that's all handled by robots.


You'll get an extra employee that works 365 days a year, 24 hours a day, doing all the things you hate. It doesn't make mistakes, and it doesn't get sick. Thanks to the advanced analytics interconnected with all our services, your automations get better by the day.",
            'image' => [
                'url' => '/images/box.png',
            ],
        ];

        return view('product', $data);
    }

    public function webdev(Request $request)
    {
        $data = [
            'title' => 'Web Development',
            'price' => [
                [
                    'plan' => 'basic',
                    'currency' => [
                        'name' => 'Euro',
                        'symbol' => '€',
                        'ISO' => 'EUR',
                    ],
                    'value' => 999,
                    'type' => 'subscription',
                    'text' => 'Tailored pricing',
                ],
            ],
            'subtext' => '+ Free website analytics',
            'text' => "
You visit hundreds of sites a day. Yet, you remember just a handful of them. You remember them because they are useful, they work, and they are the answer to what you are looking for in a given moment. They are simple in their usage, and complex in their potential. Most importantly, you don't have to think about how to use them or how they work. They just do.

That's what we make - unobtrusive, elegant, and functional websites that complement your brand and satisfy your customers needs.

![Pi in packaging box](/images/devices2.svg)
## Responsive design
TV's, projectors, tablets, smartphones, laptops, and computers. Whatever device, your website looks great. Heck, you could even browse the site in a Tesla and it'll look great. Just make sure you're parked!

All our websites are responsive from the get-go, so you don't have to worry about how your site will look on your clients devices. It'll look great. Always.

![Pi in packaging box](/images/seo.svg)
## SEO friendly
Our websites make friends with search engines. We optimize sites to be clearly understood by major search engines, and we make sure that as they update their code (we're looking at you, Google), your site will be updated as well.

You'll rank well when your customers search for your brand, your products, and your services. We do this not by milking keywords and using shady techniques, but by satisfying your customer. When your customer is satisfied, then Google is satisfied too.

Just think about all the questions you've Googled and how the first couple of links answered your question. That's because Google is very good at understanding what you and your customers are looking for, and where to find it. The trick to ranking well is therefore to satisfy the needs of your customers. We do this by finding and suggesting improvements to your content depth and density.

![Pi in packaging box](/images/webspeed.svg)
## Blazingly fast
Nobody likes a slow website. For every additional second that it takes your website to load, you lose around 7% of your customers ([source and more info on page speed importance](https://neilpatel.com/blog/loading-time/)). Page speed is also crucial to SEO and ranking well on search engines like Google.

Because our sites are built from scratch, we include just the right amount of code that is needed to get a given task done; no more, no less. If you've ever used WordPress before, you've surely experienced situations where plugins do way more than you need, and cause the website to slow down. Or they don't do enough, so you need multiple plugins to achieve whatever you need to do.

We build websites tailored to your business needs using custom code on the Laravel framework. You don't have to know what that means, but it's enough to understand that your website is tailor made to meet your business needs while being blazingly fast.

![Pi in packaging box](/images/loveweb.svg)
## Flexible communication with other services
Whether it's using Facebook for logging in, or having new customers added automatically to your Mailchimp list, our websites can easily communicate with other websites and services to effortlessly share data and tasks.

There's little need to change your existing business workflow. We believe websites should work for you instead of you having to work on them. Websites we build reflect that by integrating with your existing way of doing business.

![Pi in packaging box](/images/webscale.svg)
## Highly scalable
From one user a day to millions, your website can scale across servers so seamlessly that you won't even notice it happen. If there's a temporary surge in people visiting your website, we'll automatically increase server size to allow each of them to have an incredibly fast experience. When the surge is over, we'll scale back the server size to help you save costs.

![Pi in packaging box](/images/analytics.svg)
## Advanced analytics systems built in
As a data driven company, we wouldn't be M Media if we wouldn't include analytics systems into your website. You'll be able to see how many people saw your website, your best performing pages, bounce rate, session views, and many more metrics. You'll have access to this data from day one, and we'll be happy to help you understand all the metrics you have access to.

![Pi in packaging box](/images/abtesting.svg)
## A/B testing capable
Not sure if you prefer blue or red on your website? There's a correct answer - and it's called data. We can run multiple versions of your website, each slightly different from the other, to understand how the slight variations affect your customers behaviour on the website.

We'll see how each version performs thanks to the advanced analytics systems we build into every website, so you'll be able to understand what turns potential customers into customers, and how to capitalize on that.

![Pi in packaging box](/images/emails.svg)
## Emailing with advanced filtering
You can have your own company email address ending with @your-domain.com (where your-domain is the name of your company). Oh, and since we're M Media - we automate this too. Your website will be able to send clients automatic email reminders, requests, or notifications.

Thanks to our flexible communication with other services, your email address can easily be integrated with external mailing services like Mailchimp too.

## Made for you
Contact us and have a chat about what we can do for you and your business. We don't bite!
",
            'image' => [
                'url' => '/images/heartweb.svg',
            ],
        ];

        return view('products.webDev', $data);
    }
}
