@extends('layouts.clean')

@section('above_container')
	<div class="header-section u-bg-primary">
		<h1>Files</h1>
		<p class="mb-0">{{config('app.name')}} Files</p>
		<a class="button button-secondary mt-3 mb-5" href="/files/create">Upload a new file</a>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">{!! $files->total() !!} files</h2>
	@if($files && count($files) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>ID</th>
				   <th>Preview</th>
				   <th>Name</th>
				   <th>Extension</th>
				   <th>MIME type</th>
				   <th>Size</th>
				   <th>URL</th>

				   <th>Public</th>
				   <th>User</th>
				   <th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($files as $file)
				<tr>

					<td><a href="/files/{{ $file->id }}">{{ $file->id }}</a></td>
					<td><img src="{{ $file->url }}" class="rounded img-thumbnail" style="max-height: 100px;" alt="{{ $file->name }}"></td>
					<td>{{ $file->name }}</td>
					<td>{{ $file->extension }}</td>
					<td>{{ $file->mimeType }}</td>
					<td class="text-{{ ($file->size / 1000) >= 5000  ? 'primary' : 'muted' }}">{{ number_format(round($file->size / 1000, 0)) }} Kb</td>
					<td><a target="_BLANK" rel="noopener noreferrer" href="{{ $file->url }}">{{ $file->is_public  ? 'Long-lived link' : 'Temporary link' }}</a></td>
					@can('update file visibility', $file)
						<td class="text-{{ $file->is_public  ? 'primary' : 'muted' }}">
							<checkbox-toggle-component checked="{{$file->is_public ? true : false}}" title="Is public" url="/files/{{$file->id}}" column_title="is_public"></checkbox-toggle-component>
						</td>
					@else
						<td class="text-{{ $file->is_public  ? 'primary' : 'muted' }}">
							{{$file->is_public ? 'Public' : 'Private'}}
						</td>
					@endcan
					@can('update file user', $file)
						<td class="text-{{ !$file->user  ? 'primary' : null }}">
						<select-component :options="{{$users}}" title="Is serviceable" url="/files/{{$file->id}}" column_title="user_id" current_value="{{$file->user_id}}"></select-component>
					</td>
					@else
						<td class="text-{{ !$file->user  ? 'primary' : null }}">{{$file->user->name}}</td>
					@endcan
					<td class="text-{{ now()->diffInDays( $file->created_at ) > 6  ? 'primary' : 'muted'}}">{{ $file->created_at->diffForHumans() }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	{!! $files->appends(request()->except('page'))->links('vendor.pagination.default') !!}
	@else
		<div class="alert text-muted">
			 There's currently no phone numbers associated with your account. When you asscociate a phone number with your {{config('app.name')}} account, you access more and better services via phone, and ensure more security over your account.
		</div>
	@endif
</div>
@endsection
