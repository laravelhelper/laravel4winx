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
			<div class="col-lg-1">{{$spectators}}</div>
			<div class="col-lg-1">{{$size}}</div>
			<?php
			if($choir == 1) {
			?>
			<div class="col-lg-1">Ja</div>
			<?php
			}else {
			?>
			<div class="col-lg-1">Nee</div>
			<?php
			}
			?>
			<form class="delete" action="{{action('LocationsController@destroy', $id)}}" method="POST">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<input class="btn btn-primary" type="submit"
				       value="Verwijderen">
			</form>

		</div>
		<?php
		}

		?>
	</div>
@endsection