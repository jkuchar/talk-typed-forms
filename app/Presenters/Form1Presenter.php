<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\AirportCode;
use App\Model\FlightCode;
use App\Model\FlightRegistry;
use Brick\DateTime\LocalTime;
use Brick\DateTime\Parser\DateTimeParser;
use Nette;


final class Form1Presenter extends Nette\Application\UI\Presenter
{


	/** @inject */
	public FlightRegistry $flightRegistry;


	public function createComponentMyForm(): Nette\Application\UI\Form
	{
		$form = new Nette\Application\UI\Form();

		$form->addText('flightCode', 'Flight code');

		$form->addText('from', 'From (airport code)');
		$form->addText('departureTime', 'Departure time');

		$form->addText('to', 'To (airport code)');
		$form->addText('arrivalTime', 'Arrival time');

		$form->setDefaults([
			'flightCode' => 'PAP101',
			'from' => 'BRQ',
			'departureTime' => '10:15',
			'to' => 'KBP',
			'arrivalTime' => '12:55',
		]);

		$form->onSuccess[] = [$this, 'myForm__onSuccess'];
		$form->addSubmit('send', 'Publish flight ticket');
		return $form;
	}















	public function myForm__onSuccess(Nette\Application\UI\Form $form): void
	{
		$values = $form->getValues();
		\dump($values);

		// How to validate these values, and how to pass them to the model?
		// So now what?

		$this->flightRegistry->publishNewFlight(
			FlightCode::parse($values['flightCode']),
			AirportCode::parse($values['from']),
			LocalTime::parse($values['departureTime']),
			AirportCode::parse($values['to']),
			LocalTime::parse($values['arrivalTime']),
		);



		// Problems:
		// 1. what if I change one of field names?
		// 2. how to handle exceptions? (surround with)
		//   3. how to check which was which, and how to inform user? Duplicated rules into fields?
		// 4. How to teach phpstan to read this code?
		// 5. Isn't it strange, that everything is configured on the fly?

	}

}
