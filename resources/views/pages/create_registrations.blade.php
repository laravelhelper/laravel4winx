@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="text-center mb-5">Inschrijven</h1>
			</div>
		</div>
		<?php
		$userId = Auth::id();
		$reservations = DB::select( 'select reservationId, date, dancers , singers , reservations.choir , productionName, name from reservations INNER JOIN locations on fkLocationId = locationId ' );
		foreach ( $reservations as $reservation ) {
		$reservationId = $reservation->reservationId;
		$date = $reservation->date;
		$dancers = $reservation->dancers;
		$singers = $reservation->singers;
		$choir = $reservation->choir;
		$productionName = $reservation->productionName;
		$name = $reservation->name;

		if ( strtotime( "$date" ) < time() ) {
		} else {

		?>
		<div class="row mb-5">
			<div class="col-lg-3">{{$name}}</div>
			<?php
			if($dancers > 0) {
			?>
			<div class="col-lg-3">
				<h4>Danser</h4>
				<form action="{{action('RegistrationsController@store')}}" method="POST">
					<input type="hidden" name="fkId" value="{{$userId}}">
					<input type="hidden" name="fkReservationId" value="{{$reservationId}}">
					<input type="hidden" name="type" value="1">
					{{ csrf_field() }}
					<input class="btn btn-primary" type="submit" value="Inschrijven">
				</form>
			</div>
			<?php
			}

			if ( $singers > 0 ) {
			?>
			<div class="col-lg-3">
				<h4>Zanger</h4>
				<form action="{{action('RegistrationsController@store')}}" method="POST">
					<input type="hidden" name="fkId" value="{{$userId}}">
					<input type="hidden" name="fkReservationId" value="{{$reservationId}}">
					<input type="hidden" name="type" value="2">
					{{ csrf_field() }}
					<input class="btn btn-primary" type="submit" value="Inschrijven">
				</form>
			</div>
			<?php
			}
			if($choir > 0 ){
			?>
			<div class="col-lg-3">
				<h4>Koor</h4>
				<form action="{{action('RegistrationsController@store')}}" method="POST">
					<input type="hidden" name="fkId" value="{{$userId}}">
					<input type="hidden" name="fkReservationId" value="{{$reservationId}}">
					<input type="hidden" name="type" value="3">
					{{ csrf_field() }}
					<input class="btn btn-primary" type="submit" value="Inschrijven">
				</form>
			</div>
			<?php
			}
			?>


		</div>
		<?php
		}


		}
		?>
	</div>
@endsection