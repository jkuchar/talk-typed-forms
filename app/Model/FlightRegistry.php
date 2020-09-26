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

		echo "<h1>Values received by model:</h1>";
		\dump(\get_defined_vars());
	}

}
