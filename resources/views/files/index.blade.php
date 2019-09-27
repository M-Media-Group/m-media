@extends('layouts.clean')

@section('above_container')
	<div class="header-section" style="background:#246EBA;">
		<h1>Files</h1>
		<h2>M Media Files</h2>
	</div>
<div class="m-3">
<h2 class="mt-5 mb-0">All files</h2>
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
			@foreach ($files->reverse() as $file)
				<tr>

					<td><a href="/files/{{ $file->id }}">{{ $file->id }}</a></td>
					<td><img src="{{ $file->url }}" alt="{{ $file->name }}"></td>
					<td>{{ $file->name }}</td>
					<td>{{ $file->extension }}</td>
					<td>{{ $file->mimeType }}</td>
					<td>{{ number_format(round($file->size / 1000, 0)) }} Kb</td>
					<td><a target="_BLANK" rel="noopener noreferrer" href="{{ $file->url }}">Link</a></td>

					<td class="text-{{ $file->is_public  ? 'primary' : 'muted' }}">{{ $file->is_public  ? 'Yes' : 'No' }} </td>
					<td class="text-{{ !$file->user  ? 'primary' : null }}">{!! $file->user ? '<a href="/users/'.$file->user->id.'">'.$file->user->name."</a>" : 'No owner' !!}</td>
					<td class="text-{{ now()->diffInDays( $file->created_at ) > 6  ? 'primary' : 'muted'}}">{{ $file->created_at->diffForHumans() }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no phone numbers associated with your account. When you asscociate a phone number with your M Media account, you access more and better services via phone, and ensure more security over your account.
		</div>
	@endif
</div>
@endsection
