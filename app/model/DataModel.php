<?php

namespace App\Model;
use Nette;
use App\Helpers;
 
class DataModel {
    
	/** @var Nette\Database\Context */
	protected $db;

	protected $dbStructureHelper;

	public function __construct(Nette\Database\Context $db) {
		$this->db = $db;
		$this->dbStructureHelper  = new Helpers\DBStructure();
	}
	
	public function importData(string $tableName, $data = [], bool $with_header = true)  {
		$columnNames = $this->dbStructureHelper->getColumnsForTable($tableName);
    	$insert = [];
    	foreach ($data as $line) {
			if($with_header) {
				$with_header = false;
				// $columnsNames = $line; // Pokud by hlavicka obsahovala primo
			} else {
				$insert[] = array_combine($columnNames, $line);
			}
    	}

    	if(count($insert)) {
    		try {
    			return $this->db->table($tableName)->insert($insert);
    		} catch (\PDOException $e) {
    			// LOG
    		}
    		
    	}
    	return 0;
	}


}
?>