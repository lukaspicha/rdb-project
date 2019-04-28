<?php

namespace App\Model;
 
class BinImage {
    
	protected $file;

	protected $data = [];
	protected $width = 0;
	protected $height = 0;

	protected $ok = false;


	public function __construct($file) {
		$this->file = $file;
		$this->img2Bin();
	}

	public function getData() {
		return $this->data;
	}

	public function getWidth() {
		return $this->width;
	}

	public function getHeight() {
		return $this->width;
	}

	public function isOK() {
		return $this->ok;
	}

    //Only for debugging
    public function writeToFile(string $name) {
        $file = "watermark/" . $name;
        if(file_exists($file)) {
            unlink($file);
        }

        foreach ($this->data as $row) {
            file_put_contents($file, implode("", $row) . "\n", FILE_APPEND);
        }
    }


    public function getIndexOfImage(int $row, int $col) {
        return $this->data[$row][$col];
    }


    public function getRowValue(int $row) {
        return $this->data[$row];
    }


    public function getColValue(int $col) {
        $colValue = [];
        foreach ($this->data as $row) {
            $colValue[] = $row[$col];
        }
        return $colValue;
    }


	// https://stackoverflow.com/questions/48031293/how-to-convert-image-to-binary-string-using-php-and-file-upload
    protected function img2Bin($scale = 100, $fudge = 0) {

        if (!is_int($scale)) {
            // LOG
            throw new \InvalidArgumentException('Scale argument invalid expecting int, got: '.gettype($scale));
        }
        if(empty($this->file)) {
        	// LOG
        	throw new \InvalidArgumentException('Scale argument invalid expecting int, got: '.gettype($scale));
        }

        if(!file_exists($this->file)) {
        	throw new \InvalidArgumentException("File doesn't, exist's got: ". $this->file);
        }

        $info = getimagesize($this->file);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image_create = 'imagecreatefromjpeg';
                break;

            case 'image/png':
                $image_create = 'imagecreatefrompng';
                break;

            case 'image/gif':
                $image_create = 'imagecreatefromgif';
                break;

            default: 
                // LOG
                throw new \InvalidArgumentException('Unsupported image type: '.$mime);
        }

        $img = $image_create($this->file);
        $img = imagescale($img, $scale, $scale);

        $this->width = imagesx($img);
        $this->height = imagesy($img);

        for ($y = 0; $y < $this->height; $y++) {
            $line = [];
            for ($x = 0; $x < $this->width; $x++) {
                // get current pixel colour
                $rgb = imagecolorat($img, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8 ) & 0xFF;
                $b = $rgb & 0xFF;
                $pixel = ($r + $g + $b)/3;

                // value above 0(white) is 1 
                if ($pixel > $fudge) {
                    $line[] = "1";
                } else {
                    $line[] = "0";
                }
            }
            $this->data[] = $line;
        }

        if(count($this->data) && $this->width > 0 && $this->height > 0) {
        	$this->ok = true;
        } else {
        	$this->ok = false;
        }

        return $this->data;
    }

}