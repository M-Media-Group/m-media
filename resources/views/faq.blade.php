@extends('layouts.clean')

@section('title', "Frequently Asked Questions")
@section('meta_description', "Some common questions regarding web development and marketing services for entrepreneurs and small businesses." )

@section('above_container')

    <div class="header-section bg-secondary ">
        <h1 class="header-section-title mb-0">Frequently Asked Questions</h1>
        <p class="mb-0">+ all the answers.</p>
    </div>
@endsection
@section('content')
@php
$data = [

'Can you guarantee my website will be number 1 on Google?' => "No. There is no way to absolutely guarantee that you're number 1 on Google; it's all up to their algorithms. That being said, we not only optimize your website to rank well on Google, but also add your business to Google Business, Google Search Console, and Facebook Business platforms.",

"What programming languages do you use?" => " We use PHP on Nginx servers for the back-end using the Laravel framework or WordPress CMS, depending on what makes more sense for your business. For the front end, we'll use either Blade, VueJS, or a combination of both, along with HTML, CSS, and JavaScript.",

"Can I cancel my contract at any time?" => "Yes. Contracts can be canceled at any time and will be active until the end of their billing period. See our [pricing](/pricing) page for more info on costs, discounts, and billing periods.",

"How do I pay you?" => "We use Stripe to process payments. On your first invoice, you'll be sent a link where you'll be able to pay it by credit or debit card. From there on, we'll charge subscriptions automatically - much like Netflix or Uber does. See our [pricing](/pricing) page for more info on costs and discounts.",

"I don't live in Monaco or the French Riviera. Can I still work with you?" => "Absolutely! We can provide our digital marketing services to anyone, anywhere. Some of our physical-location based marketing services may not be available though.",

"Do I even need to market myself online?" => "It depends. Generally yes, but depending on who you're marketing to and the industry you're in, the amount of online marketing efforts will differ. Our [on-request consulting services](/contact) can help you decide what your next steps should be.",

"What are your contact details?" => "<p class='mb-0'>".config('app.name')."</p>
                <p>06230 Villefranche sur Mer, France</p>
                <p class='mb-0'>+33 4 86 06 08 59</p>
                <p>contact@mmediagroup.fr</p>
                <div class='flex' style='flex-wrap: wrap;'>
                    <a class='button button-primary' href='mailto:contact@mmediagroup.fr'>Email</a>
                    <a class='button' rel='noopener' href=".config('blog.messenger_url').">Messenger</a>
                    <a class='button' href='tel:+33486060859'>Call</a>
                </div>"
];
@endphp

@foreach($data as $key => $val)
    <details class="mb-5">
        <summary>
            <dt class="d-inline">{{$key}}</dt>
        </summary>
        <p>
{{Illuminate\Mail\Markdown::parse($val)}}
        </p>
    </details>
@endforeach

@endsection
