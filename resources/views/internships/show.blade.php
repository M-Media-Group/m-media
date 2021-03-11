@extends('layouts.clean')

@section('above_container')
    <div class="header-section bg-secondary">
        <h1>{{$internship->name}}</h1>
        <h2>{{config('app.name')}} Internship</h2>
    </div>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
<h2 class="mt-5 mb-0">Internship data</h2>
<div class="table-responsive table-hover">
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th>Position</th>
                    <td>{{$internship->position}}</td>
                </tr>
                <tr>
                    <th>Intern</th>
                    <td class="text-{{ !$internship->user  ? 'secondary' : null }}">{!! $internship->user ? '<a href="/users/'.$internship->user->id.'">'.$internship->user->name."</a>" : 'No owner' !!}</td>
                </tr>
                <tr>
                    <th>Created</th>
                    <td class="text-muted">{{ $internship->created_at->diffForHumans() }}</td>
                </tr>
                @if($internship->certificate)
                <tr>
                    <th>Certificate</th>
                    <td><a rel="noopener noreferrer" href="/internship-certificates/{{ $internship->certificate->uuid }}/congrats">Awarded {{ $internship->certificate->created_at->diffForHumans() }}</a></td>
                </tr>
                @endif
                <tr>
                    <th>ID</th>
                    <td class="text-muted">{{ $internship->id }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <a href="#app">Jump to top</a>

<div class="row m-0 pt-5 pb-5">
    <h2 class="mt-5 mb-0" id="help">From our Help Center</h2>
    <block-post-component category="378"></block-post-component>
</div>
@endsection
