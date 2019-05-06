<?php
namespace App\Model;
use Nette\Security\Passwords;


class Watermark {

	protected $secretKey = "1ptk";
	protected $fractions = 50;
	protected $lsbCandidate = 5; // max. LSB bit ktery chci modifikovat
	protected $detectionLevel = 0.5;

	protected $binImage;

	private const TYPE_STRING = 'string';
	private const TYPE_INT = 'int';
	private const TYPE_DATETIME = 'datetime';

	private const MULTIPLY = 100000;
	private const BIT_MOVE = 19;

	private $debug = false;

	public function __construct(BinImage $binImage) {
		$this->binImage = $binImage;
	}	



	public function run(array $rows, array $numericsAtributtes) {
		foreach ($rows as $row) {

			if($this->debug) {
				dump($row->getSignature());
			}

			$hash = $this->createHash($row->getSignature(), true);	

			if($hash % $this->fractions) {

				$v = count($numericsAtributtes); //pocet atributu pro radek ktery muzu watermaknout
				$atributeIndex = $hash % $v; // atribut radku ktery watermarknu
				// $atributeIndex = 1; // atribut radku ktery watermarknu
				$bitIndex = ($hash % $this->lsbCandidate) + self::BIT_MOVE; // LSB bit od prava, ktery watermarku
				//$bitIndex = 23;
				if($this->debug) {
					dump($row->toArray());
					dump("HASH: " . $hash);
					dump("Pocet atributu ze kterych muzu provadet WM: " . $v);
					dump("Index atributu ktery watermarku " . $atributeIndex);
					dump("lsb bit " . $bitIndex);
				}

				$i = 0;
				$valueForWatermark = null;
				$atributeName = $numericsAtributtes[$atributeIndex];
				$valueForWatermark = $row[$atributeName];

				if ($this->debug) {
					dump("atribute: " . $atributeName);
					dump("Data k WM: " . $valueForWatermark);
				}

				if(!$valueForWatermark) {
					throw new Exception("Neni co watermarkount");
					
				}
		
				list($dataType, $binaryValueForWatermark) = $this->getBitsForValue($valueForWatermark);

				$imageRow = ($atributeIndex * $v) % $this->binImage->getHeight(); //vyska je vlastne pocet radku
				$watermarkIndex = $hash % count($imageRow);
				$h = $this->createHash($hash . implode("", $this->binImage->getRowValue($watermarkIndex))) % $this->binImage->getHeight();
				$w = $this->createHash($hash . implode("", $this->binImage->getColValue($watermarkIndex))) % $this->binImage->getWidth();
				$bit = $this->binImage->getIndexOfImage($h, $w);

				$binaryWatermarkedData = $this->changeBit($binaryValueForWatermark, $bitIndex, $bit);
				$watermarkedData = $this->getValueFromBits($binaryWatermarkedData, $dataType);

				if($this->debug) {
					dump("data type: " . $dataType);
					dump("atribute: " . $atributeName);
					dump("Data k WM: " . $valueForWatermark);
					dump("Binary Data k WM: " . $binaryValueForWatermark);
					dump("Image row: " . $imageRow);
					dump("WM index: " . $watermarkIndex);
					dump("Pozice bitu: " . $h . "x" . $w);
					dump("Bit: " . $bit);
					dump("binary WM data: " . $binaryWatermarkedData);
					dump("WM Data: " . $watermarkedData);
					dump("abs: " . abs($valueForWatermark - $watermarkedData));
					dump(\DateTime::createFromFormat('U.u', $valueForWatermark / self::MULTIPLY),\DateTime::createFromFormat('U.u', $watermarkedData / self::MULTIPLY));
				}
				if($watermarkedData != $valueForWatermark) {
					try {
						$row->update([$atributeName => $watermarkedData]);
					} catch(\PDOException $e) {
						// LOG
					}
				}
		
			}

		}
	}


	public function isDataWaterMarked(array $rows) {

		$matchCount = 0;
		$totalCount = 0;
		foreach ($rows as $row) {

			$hash = $this->createHash($row->getSignature(), true);		

			if($hash % $this->fractions == 0) {

				$v = count(array_keys($row->toArray())); //pocet atributu pro radek ktery muzu watermaknout
				$atributeIndex = $hash % $v; // atribut radku ktery watermarknu
				// $atributeIndex = 1; // atribut radku ktery watermarknu
				$bitIndex = ($hash % $this->lsbCandidate) + self::BIT_MOVE; // LSB bit od prava, ktery watermarku
				if($this->debug) {
					dump($row->toArray());
					dump("HASH: " . $hash);
					dump("Pocet atributu ze kterych muzu provadet WM: " . $v);
					dump("Index atributu ktery watermarku " . $atributeIndex);
					dump("lsb bit " . $bitIndex);
				}

				$valueForWatermark = null;
				$atributeName = null;
				foreach ($row as $atribute => $value) {
					if($i == $atributeIndex) {
						$valueForWatermark = $value;
						$atributeName = $atribute;
					}
					$i++;					
				}

				if(!$valueForWatermark) {
					throw new Exception("Neni co watermarkount");
					
				}

				list($dataType, $binaryValueForWatermark) = $this->getBitsForValue($valueForWatermark);

				$imageRow = ($atributeIndex * $v) % $this->binImage->getHeight(); //vyska je vlastne pocet radku
				$watermarkIndex = $hash % count($imageRow);
				$h = $this->createHash($hash . implode("", $this->binImage->getRowValue($watermarkIndex))) % $this->binImage->getHeight();
				$w = $this->createHash($hash . implode("", $this->binImage->getColValue($watermarkIndex))) % $this->binImage->getWidth();
				$bit = $this->binImage->getIndexOfImage($h, $w);

				$totalCount++;
				if($bit == $this->getSpecificBitFromValue($binaryValueForWatermark, $bitIndex)) {
					$matchCount++;
				}		
			}

		}

		$decision = $matchCount / $totalCount;
		if($this->debug) {
				dump("decision: " . $decision);
		}
		if($decision > $this->detectionLevel) {
			return true;
		}
		return false;
	}


	protected function getSpecificBitFromValue(string $binary, int $bitIndex) {
		return $binary[strlen($binary) - 1 - $bitIndex];
	}


	protected function changeBit(string $binary, int $bitIndex, string $newBit, $minimizeVariation = false) {
		$binary[strlen($binary) - 1 -  $bitIndex] = $newBit;
		if($minimizeVariation) {
			// TODO
		}
		return $binary;
	}


	protected function getValueFromBits(string $binary, $type) {
		switch ($type) {
			case self::TYPE_INT:
				return bindec($binary);
				break;
			case self::TYPE_STRING:
				$words = str_split($binary, 8);
				$result = "";
				foreach ($words as $asciChar) {
					$result .= chr(bindec($asciChar));
				}
				return $result;
				break;
			case self::TYPE_DATETIME:
				return (new \DateTime())->setTimestamp(bindec($binary));
				break;
			default:
				return null;
				break;
		}
	}


	protected function getBitsForValue($value) {
		if($value instanceof \DateTime)  {
			return [self::TYPE_DATETIME, decbin($value->getTimestamp())];
		}

		if(is_string($value)) {
			$bits = "";
			for($i = 0; $i < strlen($value); $i++) {
    			$bits .= str_pad(decbin(ord($value[$i])), 8, 0, STR_PAD_LEFT);
			}
			return [self::TYPE_STRING, $bits];
		}

		if(is_numeric($value)) {
			return [self::TYPE_INT, decbin($value)];
		}
		return [null, null];
	}


	protected function createHash(string $text, $withSecretKey = false) {
		if($withSecretKey) {
			$text = $this->secretKey . $text;
		}
		//return hexdec(md5($text));
		//return crc32($text);
		return crc32(md5($text));
	}

}