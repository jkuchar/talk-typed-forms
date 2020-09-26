<?php declare(strict_types = 1);


namespace App\CustomField;


use App\Model\AirportCode;
use App\Model\InvalidAirportCodeGiven;
use Nette\Forms\Controls\TextBase;
use Nette\Utils\Html;

final class AirportCodeField extends TextBase
{

	use AddToConstructorForTextBase;

	public function getControl(): Html
	{
		return parent::getControl()->addAttributes([
			'value' => $this->getRenderedValue(),
			'type' => 'text',
		]);
	}


	/**
	 * @param AirportCode|string $value
	 */
	public function setValue($value)
	{
		// string is there because of values entered by user!
		if ($value instanceof AirportCode) {
			$value = $value->toString();
		}

		return parent::setValue($value);
	}


	public function getValue(): ?AirportCode
	{
		try {
			return AirportCode::parse(parent::getValue());

		} catch (InvalidAirportCodeGiven $e) {
			// Discard invalid values, basically the same as if there is no value entered
			// ALTERNATIVELY: If you are interested in invalid values, you can provide
			// second method in API for this
			return NULL;
		}
	}

}
