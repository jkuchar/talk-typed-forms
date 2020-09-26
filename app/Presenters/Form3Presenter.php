<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Form\PublishFlightTicketFormFactory;
use App\Form\PublishFlightTicketForm;
use App\Form\PublishFlightTicketTypedForm;
use App\Form\PublishFlightTicketTypedFormFactory;
use Nette;


final class Form3Presenter extends Nette\Application\UI\Presenter
{

	/** @inject */
	public PublishFlightTicketTypedFormFactory $myFormFactory;

	public function createComponentMyForm(): PublishFlightTicketTypedForm
	{
		return $this->myFormFactory->create();
	}

}
