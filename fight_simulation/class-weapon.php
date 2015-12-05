<?
class laser extends weapons {
	public function __construct() {
		$this->dp = 5;
		$this->type = 'laser';
		$this->active = false;
		$this->distance = 5;
		$this->precision = 0.7;
		$this->resources = 15;
		$this->ammoConsumption = 0;
	}
}

class slug extends weapons {
	public function __construct() {
		$this->dp = 4;
		$this->type = 'kinetic';
		$this->active = false;
		$this->distance = 2;
		$this->precision = 0.8;
		$this->resources = 10;
		$this->ammoConsumption = 1;
	}
}

class railgun extends weapons {
	public function __construct() {
		$this->dp = 20;
		$this->type = 'kinetic';
		$this->active = false;
		$this->distance = 10;
		$this->precision = 0.1;
		$this->resources = 50;
		$this->ammoConsumption = 1;
	}
}
?>