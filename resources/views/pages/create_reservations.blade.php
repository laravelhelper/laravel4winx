@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="text-center mb-5">Locatie boeken</h1>
			</div>

		</div>
		<div class="row mb-5">
			<div class="reservations-spacing ml-4 text-center">Naam</div>
			<div class="reservations-spacing text-center">Datum</div>
			<div class="reservations-spacing text-center">Dansers</div>
			<div class="reservations-spacing text-center">Zangers</div>
			<div class="reservations-spacing text-center">Koor</div>
			<div class="reservations-spacing text-center">Productie Naam</div>
		</div>

		<?php
		$locations = DB::select( 'select * from locations' );

		foreach ( $locations as $location ) {
		$locationId = $location->locationId;
		$name = $location->name;
		$choir = $location->choir;
		?>
		<form class="form-check-inline" action="{{action('ReservationsController@store')}}" method="POST">
			<label class="reservations-spacing" for="name" name="name">{{$name}}</label>
			<input class="reservations-spacing form-control ml-1" type="hidden" value="{{$locationId}}"
			       name="locationId">
			<input class="reservations-spacing form-control ml-1" type="date" name="date">
			<input class="reservations-spacing form-control ml-1" type="input" name="dancers">
			<input class="reservations-spacing form-control ml-1" type="input" name="singers">
			<?php
			if($choir == 1){
			?>
			<input class="reservations-spacing form-control ml-1" type="input" name="choir">
			<?php
			}else {
			?>
			<div class="reservations-spacing ml-1"></div>
			<?php
			}
			?>

			<input class="reservations-spacing form-control ml-1" type="input" name="productionName">
			{{ csrf_field() }}
			<input type="submit" class="btn btn-primary reservations-spacing ml-1" value="Boeken">
		</form>
		<?php
		}
		?>


	</div>
@endsection