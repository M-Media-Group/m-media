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
            'subtext' => "Full business web-app and marketing creation",
            'text' => "JustBookr is a global startup based in Monaco that lets students trade textbooks between each other on campus and allows libraries and bookstores to sell books directly to university students. Founded in 2016 by a young entrepreneur from the International University of Monaco, JustBookr required their entire business to be built from the ground up by M Media.

## Project scope
- Design and sketch of progressive web-app (website)
- Development and optimization of progressive web-app
- Creation and integration of seamless Stripe payment system
- Creation and integration of advanced database system
- Creation and management of automated emails and mailing-lists
- Creation of crawling robot and deployment to gather data about universities around the world
- Creation and initial management of Facebook ads, pages, and the Instagram account
- Creation and printing of 5 different types of posters, 2 types of stickers, and business cards

## Results
M Media built the web app for JustBookr, making sure it was blazingly fast, responsive, and SEO friendly; so much so that JustBookr now ranks higher for university keywords than some of the official university websites.

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function breatheAsOne(Request $request)
    {
        $data = array(
            'title' => "Breathe as One Festival",
            'subtext' => "Full online marketing strategy and execution",
            'text' => "Many cities in the world celebrate yearly the International Yoga Day, granted by the United Nations. The Breathe as One Yoga Festival held in Nice, France, is the French Riviera answer to that celebration.

## Project scope
- Design and sketch of website
- Development of website
- Creation and integration of online shop with easy PayPal payment system
- Creation and integration of no-database sign-up form with auto-emailing to festival core team

## Results
We created the website and added a no-database sign-up form to complement the existing preferred work-flow of the organizers team. The website also included a shop section connected with the festivals existing PayPal account to seamlessly and easily process the sales of festival merchandise via the website.

We now have the honor and continuous pleasure of being chosen by the festivals core team on other projects as their sole online and offline marketing agency. With their irresistible entrepreneurial spirit, we thoroughly enjoy exploring innovative ideas that bring meaningful solutions to the community on the French Riviera.",
            'image' => array(
                'url' => '/images/case-studies/breathe-as-one/event.jpg',
            ),
        );

        return view('caseStudy', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function nicolasPisani(Request $request)
    {
        $data = array(
            'title' => "Nicolas Pisani Real Estate Agents",
            'subtext' => "Multi-agent Instagram account engagement",
            'text' => "This real estate agency lies at the very heart of the French Riviera. Neighboring the Principality of Monaco, two agencies are situated in Villefranche sur Mer and Beaulieu sur Mer. Nicolas Pisani real estate agents assist increasingly cosmopolitan clients in their quest for high-end property.

## Project scope
- Instagram hashtag research
- Instagram location-targeting research
- Management of Instagram Engagement Service for multiple clients simultaneously

## Results
We have managed the accounts of 3 real estate agents at the agency and have been able to acquire a healthy 3-10 new organic Instagram leads per day. We're proud to say that two of the real estate agents are nearing close to a year of happily working with us, while one has already surpassed the mark.

Each agent has seen an average or above average engagement rate, something that would not be possible without the time dedication that M Media can optimize for and deliver to your Instagram account, all using in-house automation tools.
",
            'image' => array(
                'url' => '/images/realestate.svg',
            ),
        );

        return view('caseStudy', $data);
    }
}
