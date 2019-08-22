@extends('layouts.clean')

@section('above_container')
	<map-component style="z-index:95;"></map-component>
@endsection
@section('content')
	<div class="action-section container" style="z-index: 100;">
	    <label for="">Business location</label>
	    <input type="text" name="" value="" placeholder="Street address (France or Monaco)" id="lB">
	    <a class="button button-primary" id="search_button">Find</a>
	</div>

@endsection
