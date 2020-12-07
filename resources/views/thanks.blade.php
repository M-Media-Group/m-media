@extends('layouts.clean')

@section('meta_image', '/images/home_meta_image.jpg')

@section('header_scripts')
<style type="text/css">
    .no-webp .primary-header-background {
        background:url('/images/covid-page/hobbies.jpg') var(--primary);
        background-position: center, bottom;
    }

    .webp .primary-header-background {
        background:url('/images/background_sky.webp') var(--primary);
    }

    .no-webp .looking-up-background {
        background:url('/images/person_looking_up.jpg') white;
    }

    .webp .looking-up-background {
        background:url('/images/person_looking_up.webp') white;
    }
    .header-section-title {
      max-width: 70rem;
    }
    @media (max-width: 750px) {
        .header-section-title {
          font-size: 3.2rem;
        }
    }
</style>
@endsection

@section('above_container')

    <div class="header-section with-bg-dec text-center " style="min-height:100vh;">
        <img src="/images/covid-page/toiletpaper.svg" alt="Multiple devices showing responsive websites" class="mt-5 mb-0 mx-auto">
        <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto">2020 started off <span class="text-danger">sh*t</span>.</h1>
        <p class="mb-3 mt-3 m-text-body mx-auto text-center" data-aos="fade" style="text-align: left;">Over 67 million people caught the coronavirus.</p>
    </div>


<div class="header-section with-bg-dec text-center" style="min-height:36rem;">
    <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto" data-aos="fade" data-aos-delay="300">But then,<br/> something incredible happened.</h1>
</div>

  <div class="header-section with-bg-dec text-center " style="min-height:100vh;background: #FBF6CC">
        <img src="/images/covid-page/news.jpg" alt="Multiple devices showing responsive websites" class="mb-0 mx-auto" data-aos="zoom-in-up" data-aos-delay="150">
        <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto mt-0" data-aos-delay="300">We adapted.</h1>
  </div>

  <div class="header-section with-bg-dec text-center u-bg-primary" style="min-height:100vh;background: #17BAB4">
        <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto">Our bravest men and women went to fight.</h1>
        <img src="/images/covid-page/docs.jpg" alt="Multiple devices showing responsive websites" class="mb-0 mx-auto" data-aos="fade-left" data-aos-delay="300">
  </div>

<div class="header-section with-bg-dec text-center" style="min-height:100vh;">
        <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto" data-aos="fade" data-aos-delay="150">Others kept our neighborhoods clean and our stomachs happy.</h1>
        <img src="/images/pizzeria.svg" alt="Multiple devices showing responsive websites" class="mb-0 mx-auto" data-aos="fade" data-aos-delay="300" style="max-height:63rem;">
</div>

<div class="header-section with-bg-dec text-center" style="min-height:100vh;background: #F3EEE8">
        <img src="/images/covid-page/home.svg" alt="Multiple devices showing responsive websites" class="mb-0 mx-auto" data-aos="fade" data-aos-delay="300">
        <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto " style="z-index:99;">While we did whatever we could from home.</h1>
</div>

<div class="header-section with-bg-dec text-center " style="min-height:100vh;">
    <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto">Among all the humanity and incredible deeds, <br/><br/>it’s easy to miss a quiet but highly influential group of people that helped.</h1>
</div>

<div class="header-section with-bg-dec text-center " style="min-height:100vh;">
    <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto" data-aos="fade-up">The <span class="text-primary">techies</span>.</h1>
</div>

<div class="header-section with-bg-dec text-center " style="min-height:100vh;background: #F7E5D4">
        <img src="/images/covid-page/connected-people.jpg" alt="Multiple devices showing responsive websites" class="mb-0 mx-auto" data-aos="fade-down" data-aos-delay="150">
        <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto mt-0" data-aos="fade" data-aos-delay="300"><span class="text-primary">Web</span> and <span class="text-primary">app developers</span> enabled us to connect with  family we couldn’t.</h1>
</div>

<div class="header-section with-bg-dec text-center primary-header-background u-bg-primary" style="min-height:120rem;">
        <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto"><span style="color:#4a96e3">Server administrators</span> and <span style="color:#4a96e3">building operators</span> kept the internet running while we Googled all our new hobbies.</h1>
</div>

<div class="header-section with-bg-dec text-center " style="min-height:100vh;">
        <img src="/images/covid-page/developer.svg" alt="Multiple devices showing responsive websites" class="mb-0 mx-auto" data-aos="fade" data-aos-delay="150">
        <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto" data-aos="fade"><span class="text-primary">Freelancers</span> helped get our businesses online and out of trouble.</h1>
</div>

<div class="header-section with-bg-dec text-center " style="min-height:100vh;">
    <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto" data-aos="fade" data-aos-delay="300">And hundreds of thousands of people helped <span class="text-primary">set up networks</span>, <span class="text-primary">squash bugs</span>, <span class="text-primary">scale applications</span>, and <span class="text-primary">make the internet a better and more accessible place</span>.
</div>

<div class="header-section with-bg-dec text-center " style="min-height:100vh;">
    <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto" data-aos="fade" data-aos-delay="300">Incredible efforts that allow us to continue living, growing, and becoming better people.
</div>

<div class="header-section with-bg-dec text-center  u-bg-primary" style="min-height:100vh;
">
        <img src="/images/covid-page/graduation.svg" alt="Multiple devices showing responsive websites" class="mb-0 mx-auto" data-aos="fade" data-aos-delay="150">
        <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto mt-0" data-aos="fade" data-aos-delay="300">Even when that means doing things a little bit differently.</h1>
</div>

<div class="header-section with-bg-dec text-center " style="min-height:80vh;">
    <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto" data-aos="fade">So the next time you click on something, <br/><br/>spare a thought for all the people that make that possible.
</div>

<div class="header-section with-bg-dec text-center u-bg-primary" style="min-height:100vh;
">
        <img src="/images/covid-page/thanks.svg" alt="Multiple devices showing responsive websites" class="mb-0 mx-auto" data-aos="fade">
        <h1 class="header-section-title aos-init aos-animate text-title-heading mx-auto" data-aos="fade" data-aos-delay="150">If you ever get a chance to meet a brilliant person that helps build our modern world, be sure to say thanks.</h1>
        <a class="button button-secondary mt-5" href="/contact">Share this with a techie friend</a>
</div>

@endsection
