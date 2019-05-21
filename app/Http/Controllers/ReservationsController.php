<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller {
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
			if ( $type != 2 ) {
				return redirect( '/' )->with( 'error', 'U mag deze pagina niet bezoeken' );
			}
		}
		
		return view( 'pages.reservations' );
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
			if ( $type != 2 ) {
				return redirect( '/' )->with( 'error', 'U mag deze pagina niet bezoeken' );
			}
		}
		
		return view( 'pages.create_reservations' );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		
		if ( isset( $request->choir ) ) {
			$this->validate( $request, [
				'date'           => 'required|date',
				'dancers'        => 'required|numeric',
				'singers'        => 'required|numeric',
				'choir'          => 'required|numeric',
				'productionName' => 'required',
			] );
			
			
		} else {
			$this->validate( $request, [
				'date'           => 'required|date',
				'dancers'        => 'required|numeric',
				'singers'        => 'required|numeric',
				'productionName' => 'required',
			] );
		}
		
		if ( strtotime( "$request->date" ) < time() ) {
			return redirect( '/reservations/create' )->with( 'error', 'De datum die u probeert te boeken is al verlopen' );
		}
		$reservations = DB::select( 'select * from reservations' );
		
		foreach ( $reservations as $reservation ) {
			if ( $reservation->date == $request->input( 'date' ) && $reservation->fkLocationId == $request->input( 'locationId' ) ) {
				return redirect( '/reservations/create' )->with( 'error', 'De datum is al geboekt' );
			}
		}
		
		
		$newreservation = new Reservation;
		
		$newreservation->fklocationId   = $request->input( 'locationId' );
		$newreservation->date           = $request->input( 'date' );
		$newreservation->dancers        = $request->input( 'dancers' );
		$newreservation->singers        = $request->input( 'singers' );
		$newreservation->choir          = $request->input( 'choir' );
		$newreservation->productionName = $request->input( 'productionName' );
		
		$newreservation->save();
		
		return redirect( '/reservations' )->with( 'success', 'locatie geboekt' );
		
		
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
		//
	}
}
