<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;


class ImportDataFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory @inject */
	private $factory;


	public function __construct(FormFactory $factory)
	{
		$this->factory = $factory;
	}


	/**
	 * @return Form
	 */
	public function create()
	{
		$form = $this->factory->create();

		$form->addUpload('files', 'CSV soubor k importu:');


		$tables = [
			'Jizda' => "Jízda",
			"Ridic"	=> "Řidič",
			"Mezizastavka" => "Mezizastávky",
		];
		$form->addRadioList('table', 'Tabulka:', $tables);
		$form->addSubmit('import', 'Naimpportovat');

		return $form;
	}


}



