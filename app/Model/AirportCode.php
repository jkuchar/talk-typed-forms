<?php declare(strict_types = 1);


namespace App\Model;


final class AirportCode
{

	private string $code;

	private function __construct(string $code)
	{
		$this->code = $code;
	}

	/**
	 * @throws InvalidAirportCodeGiven
	 */
	public static function parse(string $code): self
	{
		if (\strlen($code) !== 3) {
			throw new InvalidAirportCodeGiven('Airport code must be 3 letters string.');
		}
		return new self($code);
	}

	public function toString(): string
	{
		return $this->code;
	}

}
