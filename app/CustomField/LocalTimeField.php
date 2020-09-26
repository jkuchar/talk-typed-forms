<?php declare(strict_types = 1);


namespace App\CustomField;


use Brick\DateTime\DateTimeException;
use Brick\DateTime\LocalTime;
use Brick\DateTime\Parser\DateTimeParseException;
use Nette\Forms\Controls\TextBase;
use Nette\Utils\Html;

final class LocalTimeField extends TextBase
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
	 * @param LocalTime|string $value
	 */
	public function setValue($value)
	{
		// string is there because of values entered by user!
		if ($value instanceof LocalTime) {
			$value = (string) $value;
		}

		return parent::setValue($value);
	}


	public function getValue(): ?LocalTime
	{
		try {
			return LocalTime::parse(parent::getValue());

		} catch (DateTimeException|DateTimeParseException $e) {
			// Discard invalid values, basically the same as if there is no value entered
			// ALTERNATIVELY: If you are interested in invalid values, you can provide
			// second method in API for this
			return NULL;
		}
	}

}
