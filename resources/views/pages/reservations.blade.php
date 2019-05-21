@extends('layouts.app')
@section('content')
	<?php
	$reservations = DB::select( 'select name, date , dancers , singers, reservations.choir , productionName from reservations INNER JOIN locations on fkLocationId = locationId' );

	foreach ( $reservations as $reservation ) {
	$name = $reservation->name;
	$date = $reservation->date;
	$dancers = $reservation->dancers;
	$singers = $reservation->singers;
	$choir = $reservation->choir;
	$productionName = $reservation->productionName;

	?>
	<div class="row">
		<div class="col-lg-2">{{$name}}</div>
		<div class="col-lg-2">{{$date}}</div>
		<div class="col-lg-2">{{$dancers}}</div>
		<div class="col-lg-2">{{$singers}}</div>
		<div class="col-lg-2">{{$choir}}</div>
		<div class="col-lg-2">{{$productionName}}</div>
	</div>
	<?php
	}

	?>
@endsection