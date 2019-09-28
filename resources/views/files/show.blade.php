@extends('layouts.clean')

@section('above_container')
    <div class="header-section" style="background:#246EBA;">
        <h1>{{$file->name}}</h1>
        <h2>{{config('app.name')}} file</h2>
    </div>
@endsection

@section('content')

<h2 class="mt-5 mb-0">File data</h2>
<div class="table-responsive table-hover">
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $file->id }}</td>
                </tr>
                <tr>
                    <th>Preview</th>
                    <td><img src="{{ $file->url }}" class="rounded img-thumbnail" style="max-height: 30px;" alt="{{ $file->name }}"></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $file->name }}</td>
                </tr>
                <tr>
                    <th>URL</th>
                    <td>{{ $file->url }}</td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td>{{ number_format(round($file->size / 1000, 0)) }} Kb</td>
                </tr>
                <tr>
                    <th>Is public</th>
                    <td class="text-{{ $file->is_public  ? 'primary' : 'muted' }}">{{ $file->is_public  ? 'Yes, URL never expires' : 'No, URL expires after 5 minutes' }} </td>
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
                    <td class="text-{{ !$file->user  ? 'primary' : null }}">{!! $file->user ? '<a href="/users/'.$file->user->id.'">'.$file->user->name."</a>" : 'No owner' !!}</td>
                </tr>
                <tr>
                    <th>Updated at</th>
                    <td class="text-muted">{{ $file->updated_at->diffForHumans() }}</td>
                </tr>
                <tr>
                    <th>Created at</th>
                    <td class="text-muted">{{ $file->created_at->diffForHumans() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="mb-5"><a href="/contact">Contact us if you need to change info about this file.</a></p>
        @if (Auth::user()->can('update', $file))
            @if($file->is_public)
                <a class="button button-primary" href="/contact">
                    {{ __('Make private') }}
                </a>
            @else
            <a class="button button-primary" href="/contact">
                {{ __('Make public') }}
            </a>
            @endif
        @else
            <a class="button button-primary" href="/contact">
                {{ __('Get help') }}
            </a>
        @endif
        @can('delete', $file)
            <form class="d-inline" method="POST" action="/files/{{$file->id}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="button button-primary" onclick="return confirm('Please confirm you want to delete this file forever.');">
                    {{ __('Delete file') }}
                </button>.
            </form>
        @endif
@endsection
