<?php

namespace App\Presenters;

use Nette;
use Faker;
use Tracy\ILogger;

class FeedPresenter extends BasePresenter
{

	/** @var Nette\Database\Context */
	protected $db;

    protected $faker;

    /** @var ILogger */
    protected $logger;

    protected $default = 30;

	public function __construct(Nette\Database\Context $db, ILogger $logger) {
        $this->db = $db; 
        $this->logger = $logger;

        $this->faker = Faker\Factory::create('cs_cZ');
		
	} 

    public function actionDelete() {
        try {
            $this->db->table("Jizdenka")->delete();
            $this->db->table("Klient")->delete();
            $this->db->table("Mezizastavka")->delete();
            $this->db->table("Jizda")->delete();
            $this->db->table("Trasy")->delete();
            $this->db->table("Kontakt")->delete();
            $this->db->table("Ridic")->delete();
            $this->db->table("Lokalita")->delete();
            $this->db->table("Autobus")->delete();
            $this->db->table("Znacka")->delete();
           
            
        } catch (\PDOException $e) {
            $this->logger->log($e->getMessage(), ILogger::EXCEPTION);   
        }
        $this->flashMessage("Smazáno");
        $this->redirect("default");
    } 

    public function renderDefault() {

    }

	public function actionAddClients($id) {
        if(!$id || intval($id) == 0) {
            $id = $this->default;
        }
        $ok = 0;
        for($i = 0; $i < $id; $i ++) {
            try {
            $man = $i % 2 == 0 ? true: false;
            $this->db->table("Klient")->insert([
                'email'     => $this->faker->email,
                'jmeno'     => $man ? $this->faker->firstNameMale : $this->faker->firstNameFemale,
                'prijmeni'  => $man ? $this->faker->lastNameMale :  $this->faker->lastNameFemale,
            ]);
            $ok++;
            } catch (\PDOException $e) {
                $this->logger->log($e->getMessage(), ILogger::EXCEPTION);   
            }
        }
        $this->flashMessage("Přidáno " . $ok . "/" . $id . " klientů.");
        $this->redirect("default");
    }

    public function actionAddBusManufacturer() {

        $mfs = [
            "Iveco",
            "Karosa",
            "MAN",
            "TEDOM",
            "Volvo",
        ];
        $ok = 0;
        foreach ($mfs as $manafactufer) {
            try {
                $this->db->table("Znacka")->insert([
                    "znacka" => $manafactufer,
                ]);
                $ok++;
            } catch (\PDOException $e) {
                $this->logger->log($e->getMessage(), ILogger::EXCEPTION);   
            }
        }
        $this->flashMessage("Přidáno " . $ok . "/" . count($mfs) . " vyrobcu autobusu.");
        $this->redirect("default");
    }

    public function actionAddBusses() {

        $db = $this->db->query("SELECT znacka, CEIL(RAND() * 10) AS n FROM Znacka");
        $ok = 0;
        $total = 0;
        foreach ($db as $mf_data) {
            $total += $mf_data->n;
            for($i = 0; $i < $mf_data->n; $i++) {
                try {
                    $this->db->table("Autobus")->insert([
                        'spz' => $this->generateSPZ(),
                        'znacka' => $mf_data->znacka,
                    ]);
                    $ok++;
                } catch (\PDOException $e) {
                     $this->logger->log($e->getMessage(), ILogger::EXCEPTION);
                }
            }
        }
        $this->flashMessage("Přidáno " . $ok . "/" . $total . " autobusu.");
        $this->redirect("default");
    }

    public function actionAddLocality($id) {
        if(!$id || intval($id) == 0) {
            $id = $this->default;
        }
        $ok = 0;
        for($i = 0; $i < $id; $i ++) {
            try {
                $this->db->table("Lokalita")->insert([
                    'nazev'   => $this->faker->city,
                ]);
                $ok++;
            
            } catch (\PDOException $e) {
                $this->logger->log($e->getMessage(), ILogger::EXCEPTION);   
            }
        }
        $this->flashMessage("Přidáno " . $ok . "/" . $id . " lokalit.");
        $this->redirect("default");
    }

    public function actionAddRoutes($id) {
        if(!$id || intval($id) == 0) {
            $id = $this->default;
        }

        $routes = $this->db->query("SELECT source.nazev AS source, dest.nazev AS dest FROM Lokalita AS source JOIN Lokalita AS dest WHERE source.nazev != dest.nazev ORDER by RAND() LIMIT ?", intval($id));

        $ok = 0;
        foreach ($routes as $route) {
            try {
                $this->db->table("Trasy")->insert([
                    'linka'   => $this->generateRouteId(5),
                    'odkud'   => $route->source,
                    'kam'     => $route->dest,
                ]);
                $ok++;
            
            } catch (\PDOException $e) {
                $this->logger->log($e->getMessage(), ILogger::EXCEPTION);   
            }
        }

        $this->flashMessage("Přidáno " . $ok . "/" . $id . " tras.");
        $this->redirect("default");
    }

    public function actionAddDrivers($id) {
        if(!$id || intval($id) == 0) {
            $id = $this->default;
        }
        $ok = 0;
        $kontakt = 0;
        for($i = 0; $i < $id; $i++) {
            try {
                $licenseNumber = $this->generateLicenseNumber();
                $this->db->table("Ridic")->insert([
                    'cislo_rp'   => $licenseNumber,
                    'jmeno'      => $this->faker->firstNameMale,
                    'prijmeni'   => $this->faker->lastNameMale,
                ]);
                $ok++;
                
                
                $this->db->table('Kontakt')->insert([
                    [
                        "cislo_rp" => $licenseNumber,
                        "typ"     => 'email',
                        'hodnota'  => $this->faker->email,
                    ],
                    [
                        "cislo_rp" => $licenseNumber,
                        "typ"     => 'telefon',
                        'hodnota'  => $this->faker->e164PhoneNumber,
                    ], 
                ]);
                $kontakt++;

            
            } catch (\PDOException $e) {
                $this->logger->log($e->getMessage(), ILogger::EXCEPTION);   
            }
        }

        $this->flashMessage("Přidáno " . $ok . "/" . $id . " řidičů. A " . $kontakt . "/" . $id . " kontaktů");
        $this->redirect("default");
    }

    public function actionAddBusStopes($id) {
        if(!$id || intval($id) == 0) {
            $id = $this->default;
        }
        $routes = $this->db->query("SELECT linka, odkud, kam, CEIL(RAND() * 10) AS n FROM Trasy LIMIT ?", intval($id));
        $ok = 0;
        $total = 0;
        foreach ($routes as $route) {
            $total += $route->n;
            for($i = 0; $i < $route->n; $i++) {
                try {
                    $this->db->table("Mezizastavka")->insert([
                        'linka' => $route->linka,
                        'nazev' => $this->db->table("Lokalita")->where("NOT nazev ?", [$route->odkud, $route->kam])->select("nazev")->order("RAND()")->fetchField(),
                    ]);
                    $ok++;
                } catch (\PDOException $e) {
                    $this->logger->log($e->getMessage(), ILogger::EXCEPTION);
                }
            }
        }

        $this->flashMessage("Přidáno " . $ok . "/" . $total . " mezizastávek na trasy.");
        $this->redirect("default");
    }

    public function actionAddDrives($id) {
        if(!$id || intval($id) == 0) {
            $id = $this->default;
        }
        $ok = 0;
        $db = $this->db->query("SELECT Ridic.cislo_rp, Autobus.spz, Trasy.linka FROM Ridic, Autobus, Trasy ORDER by RAND() LIMIT ?", intval($id));
        foreach ($db as $drive) {
            
            try {
                $this->db->table("Jizda")->insert([
                    'linka'     => $drive->linka,
                    'spz'       => $drive->spz,
                    'cislo_rp'  => $drive->cislo_rp,
                    'cas'       => $this->faker->dateTimeBetween("-1 week", 'now', 'Europe/Prague'),
                ]);
                $ok++;
            } catch (\PDOException $e) {
                $this->logger->log($e->getMessage(), ILogger::EXCEPTION);  
            }
        }
         $this->flashMessage("Přidáno " . $ok . "/" . $id . " jizd");
        $this->redirect("default");
    }

    public function actionAddTickets($id) {
        if(!$id || intval($id) == 0) {
            $id = $this->default;
        }
        $ok = 0;
        $total = 0;
        $db = $this->db->query("SELECT linka, cas, CEIL(RAND() * 10) AS n, IF(CEIL(RAND() * 10) % 3 = 0, (SELECT email FROM Klient ORDER  BY RAND() LIMIT 1), '') AS email FROM Jizda LIMIT ?", intval($id));
        foreach ($db as $jizda) {
            $total += $jizda->n;
            for($i = 0; $i < $jizda->n; $i++) {
                try {
                    $this->db->table("Jizdenka")->insert([
                        'linka' => $jizda->linka,
                        'cas'   => $jizda->cas,
                        'email' => $jizda->email,
                    ]);
                    $ok++;
                } catch (\PDOException $e) {
                    $this->logger->log($e->getMessage(), ILogger::EXCEPTION);
                }
            }
           
        }
        $this->flashMessage("Přidáno " . $ok . "/" . $total . " jizdenek.");
        $this->redirect("default");

    }

    protected function generateLicenseNumber() {
        return (string)(chr(rand(65, 90)) . chr(rand(65, 90)) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9));
    }

    protected function generateRouteId($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function generateSPZ() {
        return (string)(rand(0,9) . chr(rand(65, 90)) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9));
    }



}
