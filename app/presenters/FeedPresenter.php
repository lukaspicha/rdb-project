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

    protected $default = 10;

	public function __construct(Nette\Database\Context $db, ILogger $logger) {
        $this->db = $db; 
        $this->logger = $logger;

        $this->faker = Faker\Factory::create('cs_cZ');
		
	} 

    public function renderDefault() {

    }


	public function actionAddClients($id) {
        if(!$id || intval($id) == 0) {
            $id = $this->default;
        }

        $insert = [];
        for($i = 0; $i < $id; $i ++) {
            $man = $i % 2 == 0 ? true: false;
            $insert[] = [
                'email'     => $this->faker->email,
                'jmeno'     => $man ? $this->faker->firstNameMale : $this->faker->firstNameFemale,
                'prijmeni'  => $man ? $this->faker->lastNameMale :  $this->faker->lastNameFemale,
            ]; 
        }

        try {
            $this->logger->log(print_r($insert, true), ILogger::DEBUG);
            $this->db->table("Klient")->insert($insert);
            $this->flashMessage("Klienti přidáni.");
            
        } catch (\PDOException $e) {
             $this->flashMessage("Nepodařilo se přidat klienty.");
            $this->logger->log($e->geMessage(), ILogger::EXCEPTION);   
        }
        
        $this->redirect("default");
    }
}
