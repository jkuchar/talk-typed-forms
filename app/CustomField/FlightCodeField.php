<?php declare(strict_types = 1);


namespace App\CustomField;


use App\Model\FlightCode;
use App\Model\InvalidFlightCodeGiven;
use Nette\Forms\Controls\TextBase;
use Nette\Utils\Html;

final class FlightCodeField extends TextBase
{

	use AddToConstructorForTextBase;

	public function getControl(): Html
	{
		return parent::getControl()->addAttributes([
			'value' => $this->getRenderedValue(),
			'type' => 'email',
		]);
	}


	/**
	 * @param FlightCode|string $value
	 */
	public function setValue($value)
	{
		// string is there because of values entered by user!
		if ($value instanceof FlightCode) {
			$value = $value->toString();
		}

		return parent::setValue($value);
	}


	public function getValue(): ?FlightCode
	{
		try {
			return FlightCode::parse(parent::getValue());

		} catch (InvalidFlightCodeGiven $e) {
			// Discard invalid values, basically the same as if there is no value entered
			// ALTERNATIVELY: If you are interested in invalid values, you can provide
			// second method in API for this
			return NULL;
		}
	}
}
