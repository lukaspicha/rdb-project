<?php

namespace App\Model;
 
class CsvParser {
    
	
	protected $data = [];

	public function __construct() {
	}

	public function getData() {
		return $this->data;
	}

	public function importFile($filename, $encoding = 'UTF-8', $delimeter = ';') {

		if (!file_exists($filename)) {
			throw new \Exception("File {$filename} not found");
		}
		try {

			$fp = fopen($filename, 'r');
			$newdata = array();

            while (($data = fgetcsv($fp, 10000000, $delimeter)) !== FALSE) {
		        if ($encoding != 'UTF-8') {
		        	foreach($data as $columName => $value) {
		        		$data[$columName] = iconv($encoding, "UTF-8", $value);
		        	}
		        }
		        $newdata[] = $data;
		    }
		    $this->data = array_merge($this->data, $newdata);
		    fclose($fp);

		} catch (\Exception $e) {

		}
	}

}