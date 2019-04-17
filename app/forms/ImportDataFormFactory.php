<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use App\Helpers;


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

		$dbStructureHelper = new Helpers\DBStructure();
		$form->addRadioList('table', 'Tabulka:', $dbStructureHelper->getTables());

		$form->addCheckbox('with_header', 'CSV obsahuje hlavičkový řádek');

		$form->addSubmit('import', 'Import');

		return $form;
	}


}



