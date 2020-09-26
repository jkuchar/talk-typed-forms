<?php declare(strict_types = 1);


namespace App\CustomField;


use Nette\Application\UI\Form;

trait AddToConstructorForTextBase
{

	abstract public function __construct($caption = NULL);

	public static function addTo(Form $form, string $name, ?string $caption = NULL, ?string $insertBefore = NULL): self {
		$form->addComponent($input = new self($caption), $name, $insertBefore);
		return $input;
	}


}
