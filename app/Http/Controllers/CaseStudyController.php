<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaseStudyController extends Controller
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
    public function justbookr(Request $request)
    {
        $data = array(
            'title' => "JustBookr",
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
                    'text' => 'Case study',
                ),
            ),
            'subtext' => "Full business web-app and marketing creation",
            'text' => "JustBookr is a global startup based in Monaco that lets students trade textbooks between each other on campus and allows libraries and bookstores to sell books directly to university students.

## What we did
Founded in 2016 by a young entrepreneur from the International University of Monaco, JustBookr required their entire business to be built from the ground up by M Media. M Media built the web app for JustBookr, making sure it was blazingly fast, responsive, and SEO friendly; so much so that the website ranks higher for university keywords than some of the official university websites!

The web app M Media built for JustBookr is also highly progressive, meaning that students can now use the website even without an internet connection – which is useful at some university campuses with little to no access to the web. We’ve included automated online payments and developed a crawling robot to scrape multiple online data sources of universities, finally acquiring a database of over 16,000 universities to add to the platform.

M Media also built the social media profiles for JustBookr, including setting up the business on Facebook for Business, consulting on Facebook ad strategies, and creating and optimizing the Facebook page. In addition, M Media built and initially managed the Instagram profile, which has seen incredible growth and engagement rate within the target market, the student community.

Lastly, M Media also created initial branding guidelines and materials. First, we’ve developed the dark and light versions of the logo as a scalable vector graphic, we’ve defined the color scheme, and we’ve set some typeface rules, creatively putting it into a clear and concise company graphic charter. We then took this information to create physical branding material; 5 different types of posters, 2 types of stickers, and business cards.

JustBookr also entrusted M Media with the physical printing of the offline marketing material, so we’ve optimized the design for printing and sent it to our partner company for the actual print. Within two weeks, all print materials were delivered and the JustBookr team was incredibly satisfied, even ordering an additional batch of stickers.
",
            'image' => array(
                'url' => '/images/case-studies/justbookr/products.png',
            ),
        );

        return view('caseStudy', $data);
    }

}
