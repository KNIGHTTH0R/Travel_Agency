<?php

if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
    preg_match('|([a-z]+)://([^:]*)(:(.*))?@([A-Za-z0-9\.-]*)(/([0-9a-zA-Z_/\.]*))|',
        $_ENV['CLEARDB_DATABASE_URL'],$matches);
    $dsn=array(
        $matches[1].':host='.$matches[5].';dbname='.$matches[7],
        $matches[2],
        $matches[4]
    );
    $db = new \atk4\data\Persistence_SQL($dsn[0].';charset=utf8', $dsn[1], $dsn[2]);
} else {
    $db = new \atk4\data\Persistence_SQL('mysql:host=127.0.0.1;dbname=main;charset=utf8', 'root', '');
}

class Place extends \atk4\data\Model {
	public $table = 'places'; dsfd

function init() {
	parent::init();
	$this->addField('city');
}
}

class Record extends \atk4\data\Model {
	public $table = 'records';

function init() {
	parent::init();
  $this->addField('name');
  $this->addField('surname');
  $this->addField('phone_number');
  $this->addField('email');
  $this->addField('departure_date',['type'=>'date']);
  $this->addField('arrival_date',['type'=>'date']);
  $this->hasOne('place_id', new Place)->addTitle();
}
}