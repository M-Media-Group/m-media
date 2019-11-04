@extends('layouts.clean')

@section('content')
<h1>Upload</h1>
<file-upload-component class="mt-5" />
@endsection
@section('footer_scripts')
<!-- STAY - Scripts -->
    <script src="{{ asset('js/manifest.js') }}" defer></script>

    <script src="{{ asset('js/vendor.js') }}" defer></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
