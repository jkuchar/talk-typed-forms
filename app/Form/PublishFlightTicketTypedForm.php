<?php declare(strict_types = 1);


namespace App\Form;


use App\CustomField\AirportCodeField;
use App\CustomField\FlightCodeField;
use App\CustomField\LocalTimeField;
use App\Model\AirportCode;
use App\Model\FlightCode;
use App\Model\FlightRegistry;
use Brick\DateTime\LocalTime;
use Nette\Application\UI\Form;

final class PublishFlightTicketTypedForm extends Form
{

	private FlightRegistry $flightRegistry;

	private FlightCodeField $flightCodeField;
	private LocalTimeField $arrivalTime;
	private AirportCodeField $toField;
	private LocalTimeField $departureTimeField;
	private AirportCodeField $fromField;

	public function __construct(FlightRegistry $flightRegistry)
	{
		parent::__construct();
		$this->flightRegistry = $flightRegistry;

		$this->configure();
	}


	private function configure(): void
	{
		$this->flightCodeField = FlightCodeField::addTo($this, 'flightCode', 'Flight code')
			->setRequired();

		$this->fromField = AirportCodeField::addTo($this, 'from', 'From (airport code)')
			->setRequired();
		$this->departureTimeField = LocalTimeField::addTo($this, 'departureTime', 'Departure time')
			->setRequired();

		$this->toField = AirportCodeField::addTo($this, 'to', 'To (airport code)')
			->setRequired();
		$this->arrivalTime = LocalTimeField::addTo($this, 'arrivalTime', 'Arrival time')
			->setRequired();

		$this->setDefaults([
			'flightCode' => 'PAP101',
			'from' => 'BRQ',
			'departureTime' => '10:15',
			'to' => 'KBP',
			'arrivalTime' => '12:55',
		]);

		$this->onSuccess[] = [$this, 'myForm__onSuccess'];
		$this->addSubmit('send', 'Publish flight ticket');
	}





	/** @internal */
	public function myForm__onSuccess(): void
	{
		$values = $this->getValues();
		\dump($values);

		$flightCode = $this->flightCodeField->getValue();
		$from = $this->fromField->getValue();
		$departureTime = $this->departureTimeField->getValue();
		$to = $this->toField->getValue();
		$arrivalTime = $this->arrivalTime->getValue();

		\assert($flightCode !== NULL && $from !== NULL && $departureTime !== NULL && $to !== NULL && $arrivalTime !== NULL);

		$this->flightRegistry->publishNewFlight(
			$flightCode,
			$from,
			$departureTime,
			$to,
			$arrivalTime,
		);



		// Further investigation:
		// - how to write a little bit less – probably possible with generics, which may allow mark field which are required to NULL-proof

	}

}
