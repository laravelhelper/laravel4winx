<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'reservations', function ( Blueprint $table ) {
			$table->bigIncrements( 'reservationId' );
			$table->bigInteger( 'fkLocationId' );
			$table->date( 'date' );
			$table->integer( 'dancers' );
			$table->integer( 'singers' );
			$table->integer( 'choir' );
			$table->string( 'productionName' );
			$table->timestamps();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'reservations' );
	}
}
