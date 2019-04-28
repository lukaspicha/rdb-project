<?php
namespace App\Model;
use Nette;
use App\Helpers;
use Tracy\ILogger;
 
class DataModel {
    
	/** @var Nette\Database\Context */
	protected $db;

	protected $dbStructureHelper;

	 /** @var ILogger @inject */
    private $logger;

	public function __construct(Nette\Database\Context $db, ILogger $logger) {
		$this->db = $db;
		$this->logger = $logger;
		$this->dbStructureHelper  = new Helpers\DBStructure();
	}
	
	public function importData(string $tableName, $data = [], bool $with_header = true)  {
		$columnNames = $this->dbStructureHelper->getColumnsForTable($tableName);
    	$total = 0;
    	$ok = 0;
    	foreach ($data as $line) {
			if($with_header) {
				$with_header = false;
				$columnsNames = $line;
			} else {
				try {
					$this->db->table($tableName)->insert(array_combine($columnNames, $line));
					$ok++;
				} catch (\PDOException $e) {
					 $this->logger->log($e->getMessage(), ILogger::EXCEPTION);   
				}
				$total++;
			}
    	}

    	return [$ok, $total];
	}


	public function exportData($tables = [], bool $with_header = true) {
		$return = [];
		foreach ($tables as $tableName) {
			try {
				$tableRs = $this->db->table($tableName)->fetchAll();
				if($with_header) {
					$return[$tableName][] = $this->dbStructureHelper->getColumnsForTable($tableName);
				}
				
				$watermark = new Watermark($tableRs);
				$watermark->run();
				 
				foreach ($tableRs as $tableRowRs) {
					
					$return[$tableName][] = array_values($tableRowRs->toArray());
				}
			} catch (\PDOException $e) {
				 // LOG
			}
		}		
		return $return;

	} 

}
?>