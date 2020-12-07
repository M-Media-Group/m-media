@extends('layouts.clean')

@section('meta_image', '/images/covid-page/news.jpg')
@section('title', "Thank you developers")
@section('meta_description', "A lot of people have helped make 2020 somewhat bearable. One of the many great but unsung hero's have been developers, and for that we say thanks." )

@section('header_scripts')
<style type="text/css">
    .no-webp .primary-header-background {
        background:url('/images/covid-page/hobbies.jpg') var(--primary);
        background-position: center, bottom;
    }

    .webp .primary-header-background {
        background:url('/images/covid-page/hobbies.jpg') var(--primary);
        background-position: center, bottom;
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

.resp-sharing-button__link,
.resp-sharing-button__icon {
  display: inline-block
}

.resp-sharing-button__link {
  text-decoration: none;
  color: #fff;
  margin: 0.5em
}

.resp-sharing-button {
  border-radius: 5px;
  transition: 25ms ease-out;
  padding: 0.5em 0.75em;
  font-family: Helvetica Neue,Helvetica,Arial,sans-serif
}

.resp-sharing-button__icon svg {
  width: 1em;
  height: 1em;
  margin-right: 0.4em;
  vertical-align: top
}

.resp-sharing-button--small svg {
  margin: 0;
  vertical-align: middle
}

/* Non solid icons get a stroke */
.resp-sharing-button__icon {
  stroke: #fff;
  fill: none
}

/* Solid icons get a fill */
.resp-sharing-button__icon--solid,
.resp-sharing-button__icon--solidcircle {
  fill: #fff;
  stroke: none
}

.resp-sharing-button--twitter {
  background-color: #55acee
}

.resp-sharing-button--twitter:hover {
  background-color: #2795e9
}

.resp-sharing-button--pinterest {
  background-color: #bd081c
}

.resp-sharing-button--pinterest:hover {
  background-color: #8c0615
}

.resp-sharing-button--facebook {
  background-color: #3b5998
}

.resp-sharing-button--facebook:hover {
  background-color: #2d4373
}

.resp-sharing-button--tumblr {
  background-color: #35465C
}

.resp-sharing-button--tumblr:hover {
  background-color: #222d3c
}

.resp-sharing-button--reddit {
  background-color: #5f99cf
}

.resp-sharing-button--reddit:hover {
  background-color: #3a80c1
}

.resp-sharing-button--google {
  background-color: #dd4b39
}

.resp-sharing-button--google:hover {
  background-color: #c23321
}

.resp-sharing-button--linkedin {
  background-color: #0077b5
}

.resp-sharing-button--linkedin:hover {
  background-color: #046293
}

.resp-sharing-button--email {
  background-color: #777
}

.resp-sharing-button--email:hover {
  background-color: #5e5e5e
}

.resp-sharing-button--xing {
  background-color: #1a7576
}

.resp-sharing-button--xing:hover {
  background-color: #114c4c
}

.resp-sharing-button--whatsapp {
  background-color: #25D366
}

.resp-sharing-button--whatsapp:hover {
  background-color: #1da851
}

.resp-sharing-button--hackernews {
background-color: #FF6600
}
.resp-sharing-button--hackernews:hover, .resp-sharing-button--hackernews:focus {   background-color: #FB6200 }

.resp-sharing-button--vk {
  background-color: #507299
}

.resp-sharing-button--vk:hover {
  background-color: #43648c
}

.resp-sharing-button--facebook {
  background-color: #3b5998;
  border-color: #3b5998;
}

.resp-sharing-button--facebook:hover,
.resp-sharing-button--facebook:active {
  background-color: #2d4373;
  border-color: #2d4373;
}

.resp-sharing-button--twitter {
  background-color: #55acee;
  border-color: #55acee;
}

.resp-sharing-button--twitter:hover,
.resp-sharing-button--twitter:active {
  background-color: #2795e9;
  border-color: #2795e9;
}

.resp-sharing-button--email {
  background-color: #777777;
  border-color: #777777;
}

.resp-sharing-button--email:hover,
.resp-sharing-button--email:active {
  background-color: #5e5e5e;
  border-color: #5e5e5e;
}

.resp-sharing-button--whatsapp {
  background-color: #25D366;
  border-color: #25D366;
}

.resp-sharing-button--whatsapp:hover,
.resp-sharing-button--whatsapp:active {
  background-color: #1DA851;
  border-color: #1DA851;
}

.resp-sharing-button--vk {
  background-color: #507299;
  border-color: #507299;
}

.resp-sharing-button--vk:hover
.resp-sharing-button--vk:active {
  background-color: #43648c;
  border-color: #43648c;
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

<div class="header-section with-bg-dec text-center " style="min-height:70vh;">
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
        <div class="mt-5">Share this with your techie friends</div>
        <!-- Sharingbutton Facebook -->
<a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=https%3A%2F%2Fmmediagroup.fr%2F2020%2Fthank-you-developers" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm3.6 11.5h-2.1v7h-3v-7h-2v-2h2V8.34c0-1.1.35-2.82 2.65-2.82h2.35v2.3h-1.4c-.25 0-.6.13-.6.66V9.5h2.34l-.24 2z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton Twitter -->
<a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=Thank%20you%20developers!&amp;url=https%3A%2F%2Fmmediagroup.fr%2F2020%2Fthank-you-developers" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm5.26 9.38v.34c0 3.48-2.64 7.5-7.48 7.5-1.48 0-2.87-.44-4.03-1.2 1.37.17 2.77-.2 3.9-1.08-1.16-.02-2.13-.78-2.46-1.83.38.1.8.07 1.17-.03-1.2-.24-2.1-1.3-2.1-2.58v-.05c.35.2.75.32 1.18.33-.7-.47-1.17-1.28-1.17-2.2 0-.47.13-.92.36-1.3C7.94 8.85 9.88 9.9 12.06 10c-.04-.2-.06-.4-.06-.6 0-1.46 1.18-2.63 2.63-2.63.76 0 1.44.3 1.92.82.6-.12 1.95-.27 1.95-.27-.35.53-.72 1.66-1.24 2.04z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton E-Mail -->
<a class="resp-sharing-button__link" href="mailto:?subject=Thank%20you%20developers!&amp;body=https%3A%2F%2Fmmediagroup.fr%2F2020%2Fthank-you-developers" target="_self" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--email resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.38 0 0 5.38 0 12s5.38 12 12 12 12-5.38 12-12S18.62 0 12 0zm8 16c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h12c1.1 0 2 .9 2 2v8z"/><path d="M17.9 8.18c-.2-.2-.5-.24-.72-.07L12 12.38 6.82 8.1c-.22-.16-.53-.13-.7.08s-.15.53.06.7l3.62 2.97-3.57 2.23c-.23.14-.3.45-.15.7.1.14.25.22.42.22.1 0 .18-.02.27-.08l3.85-2.4 1.06.87c.1.04.2.1.32.1s.23-.06.32-.1l1.06-.9 3.86 2.4c.08.06.17.1.26.1.17 0 .33-.1.42-.25.15-.24.08-.55-.15-.7l-3.57-2.22 3.62-2.96c.2-.2.24-.5.07-.72z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton WhatsApp -->
<a class="resp-sharing-button__link" href="whatsapp://send?text=Thank%20you%20developers!%20https%3A%2F%2Fmmediagroup.fr%2F2020%2Fthank-you-developers" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24"><path d="m12 0c-6.6 0-12 5.4-12 12s5.4 12 12 12 12-5.4 12-12-5.4-12-12-12zm0 3.8c2.2 0 4.2 0.9 5.7 2.4 1.6 1.5 2.4 3.6 2.5 5.7 0 4.5-3.6 8.1-8.1 8.1-1.4 0-2.7-0.4-3.9-1l-4.4 1.1 1.2-4.2c-0.8-1.2-1.1-2.6-1.1-4 0-4.5 3.6-8.1 8.1-8.1zm0.1 1.5c-3.7 0-6.7 3-6.7 6.7 0 1.3 0.3 2.5 1 3.6l0.1 0.3-0.7 2.4 2.5-0.7 0.3 0.099c1 0.7 2.2 1 3.4 1 3.7 0 6.8-3 6.9-6.6 0-1.8-0.7-3.5-2-4.8s-3-2-4.8-2zm-3 2.9h0.4c0.2 0 0.4-0.099 0.5 0.3s0.5 1.5 0.6 1.7 0.1 0.2 0 0.3-0.1 0.2-0.2 0.3l-0.3 0.3c-0.1 0.1-0.2 0.2-0.1 0.4 0.2 0.2 0.6 0.9 1.2 1.4 0.7 0.7 1.4 0.9 1.6 1 0.2 0 0.3 0.001 0.4-0.099s0.5-0.6 0.6-0.8c0.2-0.2 0.3-0.2 0.5-0.1l1.4 0.7c0.2 0.1 0.3 0.2 0.5 0.3 0 0.1 0.1 0.5-0.099 1s-1 0.9-1.4 1c-0.3 0-0.8 0.001-1.3-0.099-0.3-0.1-0.7-0.2-1.2-0.4-2.1-0.9-3.4-3-3.5-3.1s-0.8-1.1-0.8-2.1c0-1 0.5-1.5 0.7-1.7s0.4-0.3 0.5-0.3z"/></svg>
    </div>
  </div>
</a>

<!-- Sharingbutton VK -->
<a class="resp-sharing-button__link" href="http://vk.com/share.php?title=Thank%20you%20developers!&amp;url=https%3A%2F%2Fmmediagroup.fr%2F2020%2Fthank-you-developers" target="_blank" rel="noopener" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--vk resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solidcircle">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 .5C5.65.5.5 5.65.5 12c0 6.352 5.15 11.5 11.5 11.5 6.352 0 11.5-5.148 11.5-11.5C23.5 5.65 18.352.5 12 .5zm8.11 16.82h-2.603c-.244 0-.48-.094-.658-.26l-1.98-1.862c-.118-.112-.276-.175-.438-.175-.355 0-.646.287-.646.643v1c0 .36-.292.654-.654.654h-1.655c-3.935 0-7.385-6.898-8.185-9.093-.018-.052-.028-.105-.028-.16.002-.247.204-.445.452-.445h2.637c.24 0 .456.14.556.355.57 1.42 1.31 2.764 2.2 4.004.126.14.304.217.49.214.357-.006.64-.3.63-.656-.014-.894-.034-1.958-.034-2.328 0-1.493-1.106-1.313-1.106-1.313.355-.49.94-.76 1.543-.717h2.182c.537 0 .974.435.974.972v3.093c0 .896.646 1.502 1.646-.43.37-.718 1.527-2.848 1.527-2.848.114-.214.337-.347.577-.347h2.9c1.323 0 .358 1.502-.175 2.21-.392.52-1.31 1.727-1.873 2.47-.267.353-.238.845.07 1.165 0 0 1.74 1.834 2.22 2.31.685.673.685 1.545-.57 1.545z"/></svg>
    </div>
  </div>
</a>

</div>

@endsection

@section('footer_scripts')
<script type="text/javascript">

</script>
@endsection
