<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use App\Helpers;

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

		$dbStructureHelper = new Helpers\DBStructure();
		$form->addCheckboxList('tables', 'Tabulka:', $dbStructureHelper->getTables());
		
		$form->addCheckbox('with_header', 'Vložit hlavičkové řádky');

		$form->addSubmit('export', 'Export');

		return $form;
	}


}



