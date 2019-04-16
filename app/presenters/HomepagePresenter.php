<?php

namespace App\Presenters;

use Nette;
use App\Forms;
use Nette\Application\UI\Form;

class HomepagePresenter extends BasePresenter
{


	/** @var Forms\ImportDataFormFactory */
	private $importDataFormFactory;

	public function __construct(Forms\ImportDataFormFactory $importDataFormFactory) {
		$this->importDataFormFactory = $importDataFormFactory;
	}

	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

	protected function createComponentImportDataForm()
    {
        $form = $this->importDataFormFactory->create();
        $form->onSuccess[] = [$this, 'importData'];
        return $form;
    }


    public function importData(Form $form) {
    	dump($form->getValues());
    	die();
    }

}
