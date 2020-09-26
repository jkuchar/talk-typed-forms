<?php declare(strict_types = 1);


namespace App\Model;


final class FlightCode
{

	private string $code;

	private function __construct(string $code)
	{
		$this->code = $code;
	}

	/**
	 * @throws InvalidFlightCodeGiven
	 */
	public static function fromString(string $code): self
	{
		$matched = \preg_match('/^[a-z]{3}[0-9]+$/i', $code) === 1;

		if (!$matched) {
			throw new InvalidFlightCodeGiven('Flight code must be in form of ABC002.');
		}
		return new self($code);
	}

	public function toString(): string
	{
		return $this->code;
	}

}
