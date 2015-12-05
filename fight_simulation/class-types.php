<?
class Fleet {
	public $shipList = array();
	public $admiral;
	private $volume = false;
	
	public function addShip($ship){
		$this->shipList[] = $ship;
	}
	
	public function remShip($identifier){
		
		//wichtig
		$this->volume = false;
	}
	
	public function getMaxRange($force = false) {
		$range = 0;
		foreach ($this->shipList as $s) {
			$r = $s->getSensorRange();
			if($r>$range) $range = $r;
			$r = $s->getWeaponRange();
			if($r>$range) $range = $r;
		}
		return $range;
	}
	
	public function getVolume($force = false) {
		if(!$this->volume || $force){
			$r = 0;
			foreach($this->shipList as $v) {
				$r += $v->volume;
			}
			$this->volume = $r;
		}
		return $this->volume;
	}
}

class Ship {
	public $identifier = '';
	public $acceleration = 10;
	public $handling = 10;
	public $volume = 50;
	public $maxHP = 20;
	public $aktHP = 20;
	public $fuelStore = 100;
	public $fuelReserves = 100;
	public $fuelConsumption = 1;
	public $fleet = 0;
	public $master;
	public $commander;
	public $dockable = false;
	public $resources = 10;
	public $maxCrew = 5;
	public $minCrew = 1;
	public $status = '';
	
	private $wRange = false;
	protected $aggro = 100;
	public $triggerhappy = array();
	
	public function __construct($userID,$idenfier,$vars=array()) {
		$this->master = $userID;
		
		foreach($vars as $k => $v) {
			$this->$k = $v;
		}
	}
		
	public function fuelUp() {
		$return = $this->fuelStore - $this->fuelReserves;
		$this->fuelReserves = $this->fuelStore;
		return $return;
	}
	
	public function addFleet($fleetID=false) {
		if(is_numeric($fleetID)) {
			$this->fleet = $fleetID;
		}else{
			$thos->fleet = false;
		}
	}
	
	public function repair() {
		$this->aktHP = $this->maxHP;
	}
	
	public function getDestroyed($overkill) {}
	
	public function escape() {}
	
	public function getHit($type,$dp) {
		if($this->aktHP < $dp) {
			$overkill = $dp-$this->aktHP;
			$this->aktHP = 0;
			$this->getDestroyed($overkill);
			return $overkill;
		}else{
			$this->aktHP -= $dp; 
			return true;
		}
	}
	
	public function getWeaponRange() {
		if(!$this->wRange) {
			if(isset($this->weapon->distance))
				$this->wRange = $this->weapon->distance;
			else {
				$this->wRange = 0;
			}
		}
		return $this->wRange;
	}
	
	public function getSensorRange() {
		if(isset($this->weapon->distance))
			return $this->sensorLv*1000;
		return 0;
	}
}

class ArmoredShip extends Ship {
	public $plating;

	public function getHit($type,$dp) {
		if(isset($this->plating->special[$type])) {
			$dp = $dp * $this->plating->special[$type];
			echo 'Schaden durch panzerungstyp verringert um Faktor '. $this->plating->special[$type] .' auf '.$dp.'dp<br/>';
			echo 'Panzerung '. $this->plating->pp .'pp<br/>';
			if($dp <= $this->plating->pp) {
				echo 'panzerung nicht durchdrungen<br/>';
				return false;
				//munition kann keinen schaden anrichten
			}
			$dp -= $this->plating->pp;
		}
		$this->aktHP -= $dp;
		echo $dp.'dp Schaden. '. $this->aktHP .'hp<br/>';
		
		if($this->aktHP < $dp) {
			$overkill = $dp-$this->aktHP;
			$this->aktHP = 0;
			$this->getDestroyed($overkill);
			echo 'Schiff zerstört!!!!!!!!!<br/>';
			return $overkill;
		}else{
			$this->aktHP -= $dp; 
			return true;
		}
	}
}

class CombatShip extends ArmoredShip {
	public $weapon;
	// public $ammo;
	// public $ammoStorage;
	public function __construct($userID,$idenfier,$vars=array()) {
		parent::__construct($userID,$idenfier,$vars);
		$this->dockable = true;
	}
	
	public function doShot() {
		if(isset($this->weapon->dp))
			return array($this->weapon->type,$this->weapon->dp);
		else
			return false;
		// if($this->ammo > 0) {
			// $this->ammo--;
			// return true;
		// }
		// return false;	
	}
}

class BattleShip extends ArmoredShip {
	public $towerSlots;
	public $defenceSystem;
	public $generalPurposeSlot;
}

class CarrierShip extends ArmoredShip {
	public $hangarVolume;
	public $dockList = array();	
	public $defenceSystem;
	
	public function dockIn() {}
	public function dockOut() {}
}

class TransportShip extends Ship {
	public $freightSpaceTotal;
	public $freightList = array();
	
	// $this->funcList[loadIn] = 'Beladen';
	// $this->funcList[loadOut] = 'Entladen';
	
	public function loadIn($freight,$vol) {}
	
	public function loadOut($freight,$vol=false) {}
}

class ArmTransShip extends ArmoredShip {
	public $freightSpaceTotal;
	public $freightList = array();
	public $plating;
	
	// $this->funcList[loadIn] = 'Beladen';
	// $this->funcList[loadOut] = 'Entladen';
	
	public function loadIn($freight,$vol) {}
	
	public function loadOut($freight,$vol=false) {}
} 

///////////////////////////////////////////

class weapons {
	public $resources;
	public $dp;
	public $type;
	public $active; //true|false
	public $ammoConsumption = 0;
	public $distance = 1; //km
	public $precision = 0.2; //20%
}

class turrets extends weapons {
	public $handling = 200;
}

class plating {
	public $techLv;
	public $pp; //panzerungspunkte
	public $special = array(
		'laser'		=>1,
		'explosion'	=>1,
		'plasma'	=>1,
		'newtron'	=>1,
		'antimatter'=>1,
		'tachion'	=>1,
		'kinetic'	=>1);
}

class defenceSystem {
	public $techLv;
	public $special = array(
		'laser'		=>0.0,
		'explosion'	=>0.0,
		'plasma'	=>0.0,
		'newtron'	=>0.0,
		'antimatter'=>0.0,
		'tachion'	=>0.0,
		'kinetic'	=>0.0);	
}

class GPS { //GeneralPurposeSlot
	public $techLv;
	public $addition = array();
	public $multiplier = array();
}

?>