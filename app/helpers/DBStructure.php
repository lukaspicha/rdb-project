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
			'email',
			'cas',
			'cislo',
		],
		'Klient' => [
			'email',
			'jmeno',
			'prijmeni',
		],
		'Kontakt' => [
			'hodnota',
			'typ',
			'cislo_rp',
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

	public function getSettingsForWatermarking() {
		return [
			'Jizda' => [
				'cas',
			], 
			'Jizdenka' => [
				'cas',
			],
		];
	}

	public function getColumnsForTable(string $table) {
		return $this->structure[$table];
	}



}
?>