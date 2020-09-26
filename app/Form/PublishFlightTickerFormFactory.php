<?php declare(strict_types = 1);


namespace App\Form;


interface PublishFlightTickerFormFactory
{

	public function create(): PublishFlightTicketForm;

}
