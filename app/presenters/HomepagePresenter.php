<?php

namespace App\Presenters;

use Nette;
use App\Forms;
use App\Model;
use App\Helpers;
use Nette\Application\UI\Form;

use Tracy\Debugger;
use Tracy\ILogger;
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

    /** @var ILogger @inject */
    private $logger;





	public function __construct(Forms\ExportDataFormFactory $exportDataFormFactory, Forms\ImportDataFormFactory $importDataFormFactory, Nette\Database\Context $db, ILogger $logger) {
		$this->exportDataFormFactory = $exportDataFormFactory;
		$this->importDataFormFactory = $importDataFormFactory;
		$this->db = $db;

		$this->dataModel = new Model\DataModel($this->db, $logger);
        $this->csvParser = new Model\CsvParser();

		
	}

   
	public function renderDefault()
	{  

        try {

            $dbStructureHelper = new Helpers\DBStructure();

            $binImage = new Model\BinImage($this->context->getParameters()["wwwDir"] . "/watermark/TrollFace.jpg");
            $binImage->writeToFile("TrollFace.txt");
            $watermark = new Model\Watermark($binImage);

            foreach ($dbStructureHelper->getSettingsForWatermarking() as $tblName => $numericsAtributtes) {
                $table = $this->db->table($tblName)
                            ->fetchAll();

                if (true) {
                    $watermark->run($table, $numericsAtributtes);
                }

                if (false) {
                    if($watermark->isDataWaterMarked($table, $numericsAtributtes)) {
                        dump($tblName . " is watermarked");
                    } else {
                        dump($tblName . " is not  watermarked");
                    }
                }
                    
            }
                
        
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
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
    		$this->csvParser->importFile($values->csv_file->getTemporaryFile(), '', ",");

    	} else {
    		Debugger::log('Chyba souboru ' . $values->csv_file->getFileName() . ' pri importu');
    	}

    	
    	list($ok, $total) = $this->dataModel->importData($values->table, $this->csvParser->getData(), $values->with_header);

    	$this->flashMessage("Bylo naimportováno " . $ok .  "/" . $total . " řádků");
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
