@extends('layouts.clean')

@section('above_container')
	<div class="header-section bg-secondary">
		<h1>Files</h1>
		<p class="mb-0">{{config('app.name')}} Files</p>
		<a class="button button-primary mt-3 mb-5" href="/files/create">Upload a new file</a>
	</div>
<div class="container">
<h2 class="mt-5 mb-0">{!! $files->total() !!} files</h2>
<form class="form-group" role="search">
	<label for="site-search">Search</label>
	<input type="search" id="site-search" name="q" aria-label="Search through site content" placeholder="Search" value="{{$_GET['q'] ?? ""}}">
	<input type="hidden" value="{{$_GET['user'] ?? ""}}" name="user">

<div style="display: flex;flex-wrap: wrap;">
	<input type="checkbox" id="checkboxSvg" name="extension[]" value="svg" {{isset($_GET['extension']) && in_array('svg', $_GET['extension'])  ? "checked" : '' }}>
	<label for="checkboxSvg">SVG</label>
	<input type="checkbox" id="checkboxPng" name="extension[]" value="png" {{isset($_GET['extension']) && in_array('png', $_GET['extension'])  ? "checked" : '' }}>
	<label for="checkboxPng">PNG</label>
	<input type="checkbox" id="checkboxJpg" name="extension[]" value="jpg" {{isset($_GET['extension']) && in_array('jpg', $_GET['extension'])  ? "checked" : '' }}>
	<label for="checkboxJpg">JPG</label>
	<input type="checkbox" id="checkboxPdf" name="extension[]" value="pdf" {{isset($_GET['extension']) && in_array('pdf', $_GET['extension'])  ? "checked" : '' }}>
	<label for="checkboxPdf">PDF</label>
</div>
	<button type="submit" class="button button-primary">Search</button>
</form>
	@if($files && count($files) > 0)
	<div class="table-responsive table-hover" id="table">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>Preview</th>
				   <th>Name</th>
				   <th>Extension</th>
				   <th>Size</th>
				   <th>Public</th>
				   <th>User</th>
				   <th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($files as $file)
				<tr style="vertical-align: middle;cursor: pointer;" onclick="window.location='/files/{{ $file->id }}';">
					<td style="text-align:center;"><img src="{{ $file->url }}" class="rounded img-thumbnail" style="max-height: 100px;" alt="{{ $file->name }}"></td>
					<td>{{ $file->name }}</td>
					<td>{{ $file->extension }} <span class="text-muted">({{ $file->mimeType }})</span></td>
					<td class="text-{{ ($file->size / 1000) >= 5000  ? 'secondary' : 'muted' }}">{{ number_format(round($file->size / 1000, 0)) }} Kb</td>
					@can('update', $file)
						<td class="text-{{ $file->is_public  ? 'secondary' : 'muted' }}">
							<checkbox-toggle-component checked="{{$file->is_public ? true : false}}" title="Is public" url="/files/{{$file->id}}" column_title="is_public" onclick="event.stopPropagation();"></checkbox-toggle-component>
						</td>
					@else
						<td class="text-{{ $file->is_public  ? 'secondary' : 'muted' }}">
							{{$file->is_public ? 'Public' : 'Private'}}
						</td>
					@endcan
					@can('update file user', $file)
						<td class="text-{{ !$file->user  ? 'secondary' : null }}">
						<select-component :options="{{$users}}" title="Is serviceable" url="/files/{{$file->id}}" column_title="user_id" current_value="{{$file->user_id}}" onclick="event.stopPropagation();"></select-component>
					</td>
					@else
						<td class="text-{{ !$file->user  ? 'secondary' : null }}">{{$file->user->name}}</td>
					@endcan
					<td class="text-muted">{{ $file->created_at->diffForHumans() }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	{!! $files->appends(request()->except('page'))->fragment('table')->links('vendor.pagination.default') !!}
	@else
		<div class="alert text-muted">
			 There's currently no files matching the request.
		</div>
	@endif
</div>
@endsection
