<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Form\PublishFlightTicketFormFactory;
use App\Form\PublishFlightTicketForm;
use Nette;


final class Form2Presenter extends Nette\Application\UI\Presenter
{

	/** @inject */
	public PublishFlightTicketFormFactory $myFormFactory;

	public function createComponentMyForm(): PublishFlightTicketForm
	{
		return $this->myFormFactory->create();
	}

}
