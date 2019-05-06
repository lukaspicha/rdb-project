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
		        		$data[$columName] = str_replace("\\n", "", $value);
		        	}
		        }
		        $newdata[] = $data;
		    }
		    $this->data = array_merge($this->data, $newdata);
		    fclose($fp);

		} catch (\Exception $e) {

		}
	}

	public function writeToCsv($data = [], $filename,  $encoding = 'UTF-8', $delimeter = ';') {

		try {

			$fp = fopen("exports/" . $filename, 'w');
			foreach($data as $row) {
				fputcsv($fp, $row, $delimeter);
			}
			fclose($fp);
			return true;
		} catch (Exception $e) {
			return false;
		}
			
	}

}