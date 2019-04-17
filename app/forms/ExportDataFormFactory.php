<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;


class ExportDataFormFactory
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

		$tables = [
			'Jizda' => "Jízda",
			"Ridic"	=> "Řidič",
			"Mezizastavka" => "Mezizastávky",
		];
		$form->addCheckboxList('table', 'Tabulka:', $tables);
		
		$form->addCheckbox('with_header', 'Vložit hlavičkové řádky');

		$form->addSubmit('import', 'Export');

		return $form;
	}


}



