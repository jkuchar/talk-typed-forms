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
			'arrivalTime' => '10:15',
			'to' => 'KBP',
			'departureTime' => '12:55'
		]);

		$form->onSuccess[] = [$this, 'myForm__onSuccess'];
		$form->addSubmit('send', 'Save!');
		return $form;
	}















	public function myForm__onSuccess(Nette\Application\UI\Form $form): void
	{
		$values = $form->getValues();
		\dump($values);

		// How to validate these values, and how to pass them to the model?
		// So now what?

//		$flightCode = $values['flightCode'];
//		\assert(\is_string($flightCode));



		$this->flightRegistry->publishNewFlight(
			FlightCode::fromString($values['flightCode']),
			AirportCode::fromString($values['from']),
			LocalTime::parse($values['departureTime']),
			AirportCode::fromString($values['from']),
			LocalTime::parse($values['arrivalTime']),
		);


	}

}
