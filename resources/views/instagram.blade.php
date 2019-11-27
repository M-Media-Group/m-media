@extends('layouts.clean')
@section('title', "Instagram Marketing Solutions for Businesses")

@section('above_container')
    <a class="header-section d-block text-center u-bg-primary" href="/instagram-engagement">
        <img src="/images/instagram-like.png" alt="Instagram Engagement" style="max-height:200px; min-height: 190px;">
        <h1 class="u-center">Instagram Engagement</h1>
        <p class="u-center" data-aos="fade">Liking, commenting, and engaging with your potential followers</p>
    </a>
    <a class="header-section d-block text-center text-dark" style="background:initial;" href="/instagram-account-analyzer" data-aos="fade">
        <img src="/images/instagram-person-plus.svg" alt="Instagram Engagement" style="max-height:200px; min-height: 190px;" data-aos="fade">
        <h1 class="u-center" data-aos="fade">Instagram progress monitoring</h1>
        <p class="u-center" data-aos="fade">Daily tracking of your followers, following, and account health</p>
    </a>
    <a class="header-section d-block text-center u-bg-secondary" href="/instagram-content-management" data-aos="fade">
        <img src="/images/polaroid.svg" alt="Instagram Content Management" style="max-height:200px; min-height: 190px;" data-aos="fade">
        <h1 class="u-center" data-aos="fade">Instagram Content Management</h1>
        <p class="u-center" data-aos="fade">Scheduling posts, writing captions and effective hashtags, and keeping your account active</p>
    </a>

@endsection
