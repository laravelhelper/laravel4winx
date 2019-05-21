@extends('layouts.app')
@section('content')
	<div class="container">
		<?php
		$locations = DB::select( 'select * from locations' );

		foreach ( $locations as $location ) {
		$name = $location->name;
		$street = $location->street;
		$number = $location->number;
		$city = $location->city;
		$spectators = $location->spectators;
		$size = $location->size;
		$choir = $location->choir;
		$id = $location->locationId;

		?>
		<div class="row">
			<div class="col-lg-2">{{$name}}</div>
			<div class="col-lg-2">{{$street}}</div>
			<div class="col-lg-1">{{$number}}</div>
			<div class="col-lg-2">{{$city}}</div>
		</div>
		<?php
		}

		?>
	</div>
@endsection