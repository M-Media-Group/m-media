@extends('layouts.clean')

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>Dashboard</h1>
        <h2>{{Auth::user()->name}} {{Auth::user()->surname}}</h2>
    </div>
@endsection

@section('content')
    <h2 class="mt-5 mb-0">Home</h2>
    <div class="card-columns">
        <a class="action-section card mb-5 mt-5 round-all-round text-center text-white u-bg-primary" href="/users/{{Auth::id()}}/billing">
              <div class="card-body">
                <h5 class="card-title">Manage invoices</h5>
              </div>
        </a>
        <a class="action-section card mb-5 mt-5 round-all-round text-center" href="/my-bots">
              <div class="card-body">
                <h5 class="card-title">Manage bots</h5>
              </div>
        </a>
        <a class="action-section card mb-5 mt-5 round-all-round text-center text-white bg-danger" href="/users/{{Auth::id()}}/edit">
              <div class="card-body">
                <h5 class="card-title">Account settings</h5>
              </div>
        </a>
        </div>
{{--    <p class="mb-5"><a href="/automation-bot">Learn more about the Marketing Automation Bot</a></p>
 --}}@endsection
