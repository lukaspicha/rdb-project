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

    private const MULTIPLY = 100000;

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
					$insert = array_combine($columnNames, $line);
					if(array_key_exists("cas", $insert)) {
						$insert["cas"] = (float)($insert["cas"] * self::MULTIPLY);
					}
					$this->db->table($tableName)->insert($insert);
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