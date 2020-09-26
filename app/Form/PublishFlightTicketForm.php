<?php declare(strict_types = 1);


namespace App\Form;


use App\Model\AirportCode;
use App\Model\FlightCode;
use App\Model\FlightRegistry;
use Brick\DateTime\LocalTime;
use Nette\Application\UI\Form;

final class PublishFlightTicketForm extends Form
{

	private FlightRegistry $flightRegistry;

	public function __construct(FlightRegistry $flightRegistry)
	{
		parent::__construct();
		$this->flightRegistry = $flightRegistry;

		$this->configure();
	}


	private function configure(): void
	{
		$this->addText('flightCode', 'Flight code');

		$this->addText('from', 'From (airport code)');
		$this->addText('departureTime', 'Departure time');

		$this->addText('to', 'To (airport code)');
		$this->addText('arrivalTime', 'Arrival time');

		$this->setDefaults([
			'flightCode' => 'PAP101',
			'from' => 'BRQ',
			'arrivalTime' => '10:15',
			'to' => 'KBP',
			'departureTime' => '12:55'
		]);

		$this->onSuccess[] = [$this, 'myForm__onSuccess'];
		$this->addSubmit('send', 'Publish flight ticket');
	}





	/** @internal */
	public function myForm__onSuccess(): void
	{
		$values = $this->getValues();
		\dump($values);

		// How to validate these values, and how to pass them to the model?
		// So now what?

		$this->flightRegistry->publishNewFlight(
			FlightCode::parse($values['flightCode']),
			AirportCode::parse($values['from']),
			LocalTime::parse($values['departureTime']),
			AirportCode::parse($values['from']),
			LocalTime::parse($values['arrivalTime']),
		);



		// Problems:
		// 1. what if I change one of field names?
		// 2. how to handle exceptions? (surround with)
		//   3. how to check which was which, and how to inform user? Duplicated rules into fields?
		// 4. How to teach phpstan to read this code?

	}

}
