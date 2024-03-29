@extends('layouts.clean')

@section('above_container')
    <div id="file_header" class="header-section bg-secondary bg-blur" style="background:url({{$file->url}}), #246EBA;background-position: center;background-repeat: no-repeat;background-size: cover;">
        <h1>{{$file->name}}</h1>
        <p>{{config('app.name')}} file</p>
    </div>
@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
<div class="row m-0 pt-5 pb-5">
<h2 class="mt-5 mb-0">File data</h2>
<div class="table-responsive table-hover">
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th>URL</th>
                    <td><a target="_BLANK" rel="noopener noreferrer" href="{{ $file->url }}">{{ $file->is_public  ? 'Long-lived link' : 'Temporary link' }}</a></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td>{{ number_format(round($file->size / 1000, 0)) }} Kb</td>
                </tr>
                <tr>
                    <th>Is public</th>
                    <td class="text-{{ $file->is_public  ? 'secondary' : 'muted' }}">{{ $file->is_public  ? 'Yes, URL never expires' : 'No, URL expires after 5 minutes' }} </td>
                </tr>
                <tr>
                    <th>Extension</th>
                    <td>{{ $file->extension }}</td>
                </tr>
                <tr>
                    <th>MIME Type</th>
                    <td>{{ $file->mimeType }}</td>
                </tr>
                <tr>
                    <th>Owned by</th>
                    <td class="text-{{ !$file->user  ? 'secondary' : null }}">{!! $file->user ? '<a href="/users/'.$file->user->id.'">'.$file->user->name."</a>" : 'No owner' !!}</td>
                </tr>

                <tr>
                    <th>Created</th>
                    <td class="text-muted">{{ $file->created_at->diffForHumans() }}</td>
                </tr>
                <tr>
                    <th>ID</th>
                    <td class="text-muted">{{ $file->id }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="mb-5"><a href="/contact">Contact us if you need to change info about this file.</a></p>
    <div class="w-100">
        <a class="button button-secondary" target="_BLANK" rel="noopener noreferrer" href="{{ $file->url }}">
                {{ __('Open file') }}
            </a>

{{--         <force-download-button-component url="{{ $file->url }}"></force-download-button-component>
 --}}        @can('delete', $file)
            <form class="d-inline" method="POST" action="/files/{{$file->id}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="button button-primary" onclick="return confirm('Please confirm you want to delete this file forever. Deleting this file is permanent. Anywhere this file is referenced, like your WordPress websites, will no longer show this file.');">
                    {{ __('Delete file') }}
                </button>
            </form>
            @endcan
    </div>
    </div>
    <div class="row m-0 pt-5 pb-5 d-none">
        <h2 class="mt-5 mb-0">Preview</h2>
        <embed src="{{ $file->url }}" height="500" width="100%" style="object-fit: contain;" title="{{$file->name}}" frameborder="0" loading="lazy" style="border:none;"></embed>
    </div>
    <div class="row m-0 pt-5 pb-5 d-none">
        <h2 class="mt-5 mb-0">People currently viewing this file</h2>
        <p>You can see who else is on this page with you right now. <a href="https://blog.mmediagroup.fr/post/m-media-website-update-jazz/" target="_BLANK" rel="noopener">Learn more</a>.</p>
        <p>The following people are on this page right now: <users-online-list-component channel="files.{{$file->id}}"></users-online-list-component></p>
    </div>
@endsection

@section('footer_scripts')
<script type="text/javascript">

var element = document.getElementById("file_header");

var exposeBackground = function (event) {
    element.classList.remove("bg-blur");
    element.style.color = "transparent"
};

var obscureBackground = function (event) {
    element.classList.add("bg-blur");
    element.style.color = null
};

element.addEventListener('touchstart', exposeBackground, false);
element.addEventListener('mousedown', exposeBackground, false);

element.addEventListener('touchend', obscureBackground, false);
element.addEventListener('mouseup', obscureBackground, false);


</script>
@endsection
