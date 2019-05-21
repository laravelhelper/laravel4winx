@extends('layouts.app')
@section('content')
	<div class="container">
		<?php
		$userId = Auth::id();
		$registrations = DB::select( 'select type, name, street, number , city from registrations
INNER JOIN reservations on fkReservationId = reservationId
INNER JOIN locations on fkLocationId = locationId
where fkId = ?', [ $userId ] );

		foreach ( $registrations as $registration ) {
		$name = $registration->name;
		$street = $registration->street;
		$number = $registration->number;
		$city = $registration->city;
		$type = $registration->type;

		?>
		<div class="row">
			<div class="col-lg-2">{{$name}}</div>
			<div class="col-lg-2">{{$street}}</div>
			<div class="col-lg-2">{{$number}}</div>
			<div class="col-lg-2">{{$city}}</div>
			<div class="col-lg-2"><?php
				if ( $type == 1 ) {
					echo 'Danser';
				} elseif ( $type == 2 ) {
					echo 'Zanger';
				} else {
					echo 'Koor';
				}
				?>
			</div>
		</div>
		<?php
		}
		?>
	</div>
@endsection