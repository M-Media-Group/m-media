@extends('layouts.clean')

@section('above_container')
	<div class="header-section bg-secondary">
		<h1>Internships</h1>
		<p>{{config('app.name')}} Internships</p>
	</div>
<div class="container">
<h2 class="mt-5 mb-0">{{count($internships)}} internships</h2>
	@if($internships && count($internships) > 0)
	<div class="table-responsive table-hover">
		<table class="table mb-0">
			<thead>
				<tr>
				   <th>Type</th>
				   	@can('update internship addresses')
				   <th>User</th>
				   @endcan

				   <th>Created at</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($internships->sortByDesc('logs_count') as $internship)
				<tr style="vertical-align: middle;cursor: pointer;" onclick="window.location='/internships/{{ $internship->id }}';">
					<td>{{ $internship->position }}</td>
					@can('update internship addresses')

					<td class="text-{{ !$internship->user  ? 'secondary' : null }}">
						{{ $internship->user->full_name }}
					</td>
					@endcan

					<td class="text-{{ now()->diffInDays( $internship->created_at ) > 6  ? 'secondary' : 'muted'}}">{{ $internship->created_at->diffForHumans() }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	@else
		<div class="alert text-muted">
			 There's currently no Internships associated with your internship. When you asscociate an Internship with your {{config('app.name')}} internship, you access more and better services, as well as track progress easily.
		</div>
	@endif
</div>
@endsection
