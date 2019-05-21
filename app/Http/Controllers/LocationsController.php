<?php

namespace App\Http\Controllers;

use App\Location;
use App\Registration;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LocationsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$userId = Auth::id();
		// select a particular user by id
		$users = DB::select( 'select * from users where id = ?', [ $userId ] );
		foreach ( $users as $user ) {
			
			$type = $user->type;
			if ( $type != 1 ) {
				return redirect( '/' )->with( 'error', 'U mag deze pagina niet bezoeken' );
			}
		}
		
		
		return view( 'pages.locations' );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$userId = Auth::id();
		// select a particular user by id
		$users = DB::select( 'select * from users where id = ?', [ $userId ] );
		foreach ( $users as $user ) {
			
			$type = $user->type;
			if ( $type != 1 ) {
				return redirect( '/' )->with( 'error', 'U mag deze pagina niet bezoeken' );
			}
		}
		
		return view( 'pages.create_locations' );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$this->validate( $request, [
			'name'       => 'required|unique:locations,name',
			'street'     => 'required',
			'number'     => 'required|numeric',
			'city'       => 'required',
			'spectators' => 'required|numeric',
			'size'       => 'required|numeric',
			'choir'      => 'required|boolean',
		] );
		
		
		
		$location             = new Location;
		$location->name       = $request->input( 'name' );
		$location->street     = $request->input( 'street' );
		$location->number     = $request->input( 'number' );
		$location->city       = $request->input( 'city' );
		$location->spectators = $request->input( 'spectators' );
		$location->size       = $request->input( 'size' );
		$location->choir      = $request->input( 'choir' );
		
		$location->save();
		
		return redirect( '/locations' )->with( 'success', 'Locatie aangemaakt' );
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		
		$userId = Auth::id();
		// select a particular user by id
		$users = DB::select( 'select * from users where id = ?', [ $userId ] );
		foreach ( $users as $user ) {
			
			$type = $user->type;
			if ( $type != 1 ) {
				return redirect( '/' )->with( 'error', 'U mag deze pagina niet bezoeken' );
			}
		}
		$reservations = DB::select( 'select * from reservations WHERE fkLocationId = ?', [ $id ] );
		
		foreach ( $reservations as $reservation ) {
			Registration::where( 'fkReservationId', $reservation->reservationId )->delete();
			Reservation::destroy( $reservation->reservationId );
		}
		
		
		$location = Location::find( $id );
		$location->delete();
		
		return redirect( '/locations' )->with( 'success', 'Locatie Verwijderd' );
	}
}
