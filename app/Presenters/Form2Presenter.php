<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Form\PublishFlightTickerFormFactory;
use App\Form\PublishFlightTicketForm;
use Nette;


final class Form2Presenter extends Nette\Application\UI\Presenter
{

	/** @inject */
	public PublishFlightTickerFormFactory $myFormFactory;

	public function createComponentMyForm(): PublishFlightTicketForm
	{
		return $this->myFormFactory->create();
	}

}
