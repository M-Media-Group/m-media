<?php

namespace App\Http\Controllers;

use App\Rules\EmailCanReceiveMail;
use Illuminate\Http\Request;
use Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('home');
    }

    public function entrepreneur(Request $request)
    {
        return view('entrepreneur');
    }

    public function instagram(Request $request)
    {
        return view('instagram');
    }

    public function sitemap(Request $request)
    {
        return view('sitemap');
    }

    public function faq(Request $request)
    {
        return view('faq');
    }

    public function caseStudies(Request $request)
    {
        return view('caseStudies');
    }

    public function contact(Request $request)
    {
        return view('contact');
    }

    public function privacy(Request $request)
    {
        return view('privacy');
    }

    public function toc(Request $request)
    {
        return view('toc');
    }

    public function about(Request $request)
    {
        return view('about');
    }

    public function welcome(Request $request)
    {
        return view('welcome');
    }

    public function components(Request $request)
    {
        return view('requestWebsite');
    }

    public function thanksDevelopers(Request $request)
    {
        return view('thanks');
    }

    public function billing(Request $request)
    {
        return Redirect::to('/users/' . Auth::id() . '/billing', 301);
    }

    public function domainAvailability(Request $request)
    {
        return view('domains.checkAvailability');
    }

    public function pricing(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $plans = \Stripe\Plan::all(['expand' => ['data.product']]);
        $products = \Stripe\Sku::all(['expand' => ['data.product']]);
        $coupons = \Stripe\Coupon::all();
        // return \Stripe\Price::all(['expand' => ['data.product']]);
        return view('pricing', compact('plans', 'products', 'coupons'));
    }

    public function covid(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://covid-api.mmediagroup.fr/v1/cases');
        $response = json_decode($request->getBody(), true);
        $request = $client->get('https://covid-api.mmediagroup.fr/v1/history?status=confirmed');
        $response_2 = json_decode($request->getBody(), true);
        $request = $client->get('https://covid-api.mmediagroup.fr/v1/history?status=deaths');
        $response_3 = json_decode($request->getBody(), true);
        //return $response;
        return view('covid', ['cases' => $response, 'history' => $response_2, 'deaths' => $response_3]);
    }

    public function sendContactRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|max:55',
            'surname' => 'required|max:55',
            'email' => ['required', 'email', new EmailCanReceiveMail],
            'phone' => 'nullable|min:5|max:31',
            'message' => 'required',
        ]);
        $user = \App\User::where('id', config('blog.super_admin_id'))->firstOrFail();
        \App\Jobs\SaveEmail::dispatch(['email' => $request->input('email')], true);
        $phone = null;
        if ($request->input('phone')) {
            $input['phonenumber'] = $request->input('phone');
            try {
                $phone = \App\Jobs\SavePhone::dispatchNow($input);
                if (!isset($phone->e164)) {
                    abort(422);
                    // $phone = $request->input('phone');
                } else {
                    $phone = $phone->e164;
                }
            } catch (Exception $e) {
                throw \Illuminate\Validation\ValidationException::withMessages(['phone' => "The phone number doesn't look right. Please check your number and include the country code, starting with a plus sign (+)."]);
                // $phone = $request->input('phone');
            }
        }

        Notification::route('mail', $request->input('email'))->notify(new \App\Notifications\CustomNotification(
            [
                'send_email' => 1,
                'title' => 'Hi ' . $request->input('name') . '!',
                'message' => "Thanks for messaging us! We've received your message and we'll be getting back to you as soon as possible on this email address.",
            ]
        ));

        return $user->notify(new \App\Notifications\CustomNotification(
            [
                'send_email' => 1,
                'send_database' => 1,
                'title' => 'New contact request from ' . $request->input('name') . ' ' . $request->input('surname'),
                'message' => 'Email: ' . $request->input('email') . "\n\n Phone: " . $phone . "\n\n Message: " . $request->input('message'),
            ]
        ));
    }
}
