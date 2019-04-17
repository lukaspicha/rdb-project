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

		$form->addUpload('csv_file', 'CSV soubor k importu:');

		$tables = [
			'Jizda' => "Jízda",
			"Ridic"	=> "Řidič",
			"Mezizastavka" => "Mezizastávky",
			'Klient'		=> 'Klient',
		];
		$form->addRadioList('table', 'Tabulka:', $tables);

		$form->addCheckbox('with_header', 'CSV obsahuje hlavičkový řádek');

		$form->addSubmit('import', 'Import');

		return $form;
	}


}



