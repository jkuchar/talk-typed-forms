<?php declare(strict_types = 1);


namespace App\Model;


use Brick\DateTime\LocalTime;

final class FlightRegistry
{

	public function publishNewFlight(
		FlightCode $flightCode,
		AirportCode $from,
		LocalTime $departureTime,
		AirportCode $to,
		LocalTime $arrivalTime
	): void {

		// do something with these objects

		\dump(\get_defined_vars());
	}

}
