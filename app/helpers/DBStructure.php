<?php

namespace App\Helpers;

 
class DBStructure {
    
	private $structure = [
		'Autobus' => [
			'spz',
			'znacka',
		],
		'Jizda' => [
			'linka',
			'spz',
			'cislo_rp',
			'cas',
		],
		'Jizdenka' => [
			'linka',
			'cas',
			'email',
			'cislo',
		],
		'Klient' => [
			'email',
			'jmeno',
			'prijmeni',
		],
		'Kontakt' => [
			'hodnota',
			'cislo_rp',
			'typ',
		],
		'Lokalita' => [
			'nazev',
		],
		'Mezizastavka' => [
			'nazev',
			'linka',
		],
		'Ridic' => [
			'cislo_rp',
			'jmeno',
			'prijmeni',
		],
		'Trasy' => [
			'linka',
			'odkud',
			'kam',
		],
		'TypKontaktu' => [
			'typ',
		],
		'Znacka' => [
			'znacka',
		],
	];

	public function __construct() {

	}

	public function getTables() {
		$tmp = array_keys($this->structure);		
		return array_combine($tmp, $tmp);
	}

	public function getColumnsForTable(string $table) {
		return $this->structure[$table];
	}



}
?>