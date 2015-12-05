<?
class smaTransporter extends TransportShip {}
class medTransporter extends TransportShip {}
class bigTransporter extends TransportShip {}

class smaArmTrans extends ArmTransShip {}
class medArmTrans extends ArmTransShip {}
class bigArmTrans extends ArmTransShip {}

class Drone extends Ship {
	public $sensorLv;

}

class ColonieShip extends Ship {}

class smCarrier extends CarrierShip {}
class medCarrier extends CarrierShip {}
class bigCarrier extends CarrierShip {}

class Fregatte extends BattleShip {}
class Destroyer extends BattleShip {}
class Crusader extends BattleShip {}
class DreadNought extends BattleShip {}

class Bomber extends CombatShip {}
class ReconUnit extends CombatShip {
	public $sensorLv;
}

class lFighter extends CombatShip {
	public function __construct($userID,$idenfier) {
		parent::__construct($userID,$idenfier,array('volume'=>10,'resources'=>10,'handling'=>400,'weapon'=>(new laser())));
	}
}

class mFighter extends CombatShip {
	public function __construct($userID,$idenfier) {
		parent::__construct($userID,$idenfier,array('volume'=>15,'resources'=>15,'handling'=>350,'plating'=>(new reactive()),'weapon'=>(new laser())));
	}
}

class offensiveDrone extends Ship {
	public $weapon;

	public function __construct($userID,$idenfier) {
		parent::__construct($userID,$idenfier,array('volume'=>3,'resources'=>10,'handling'=>600,'weapon'=>(new slug())));
		$this->dockable = true;
	}
	
	public function doShot() {
		if(isset($this->weapon->dp))
			return array($this->weapon->type,$this->weapon->dp);
		else
			return false;
	}
}
?>