<?php

namespace App\Model;
use Nette;
 
class DataModel {
    
	/** @var Nette\Database\Context */
	protected $db;

	public function __construct(Nette\Database\Context $db) {
		$this->db = $db;
	}


	private $structure = [
		'Klient' => [
			'email',
			'jmeno',
			'prijmeni',
		],
	];

	
	public function importData(string $tableName, $data = [], bool $with_header = true)  {
		$columnNames = $this->structure[$tableName];
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
    			echo $e->getMessage();
    		}
    		
    	}
    	return 0;
	}


}
?>