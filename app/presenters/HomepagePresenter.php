<?php

namespace App\Presenters;

use Nette;
use App\Forms;
use App\Model;
use Nette\Application\UI\Form;

use Tracy\Debugger;

class HomepagePresenter extends BasePresenter
{


	

	/** @var Forms\ExportDataFormFactory */
	protected $exportDataFormFactory;

	/** @var Forms\ImportDataFormFactory */
	protected $importDataFormFactory;

	/** @var Nette\Database\Context */
	protected $db;

	protected $dataModel;

    protected $csvParser;

	public function __construct(Forms\ExportDataFormFactory $exportDataFormFactory, Forms\ImportDataFormFactory $importDataFormFactory, Nette\Database\Context $db) {
		$this->exportDataFormFactory = $exportDataFormFactory;
		$this->importDataFormFactory = $importDataFormFactory;
		$this->db = $db;

		$this->dataModel = new Model\DataModel($this->db);
        $this->csvParser = new Model\CsvParser();

		
	}

	public function renderDefault()
	{

	}

	protected function createComponentExportDataForm()
    {
        $form = $this->exportDataFormFactory->create();
        $form->onSuccess[] = [$this, 'exportData'];
        return $form;
    }

	protected function createComponentImportDataForm()
    {
        $form = $this->importDataFormFactory->create();
        $form->onSuccess[] = [$this, 'importData'];
        return $form;
    }

    public function importData(Form $form) {
    	
    	$values = $form->getValues();
    	$this->csvParser = new Model\CsvParser();

    	if($values->csv_file->isOk()) {
    		$this->csvParser->importFile($values->csv_file->getTemporaryFile(), 'UTF-8', ",");

    	} else {
    		Debugger::log('Chyba souboru ' . $values->csv_file->getFileName() . ' pri importu');
    	}

    	
    	$result = $this->dataModel->importData($values->table, $this->csvParser->getData(), $values->with_header);

    	$this->flashMessage("Bylo naimportováno " . $result . " řádků");
    	$this->redirect('this');	
    	
    }

    public function exportData(Form $form) {
    	$values = $form->getValues();
    	$exportedData = $this->dataModel->exportData($values->tables, $values->with_header);

        foreach ($exportedData as $table => $data) { 
            try {
                $this->csvParser->writeToCsv($data, $table . ".csv");
            } catch (Exception $e) {
                // LOG
            }
        }

        $this->redirect('this');
    	

    }

}
