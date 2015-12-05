<?
	$agg = new Fleet();
	$agg->addShip(new lFighter(1,'a1'));
	$agg->addShip(new lFighter(1,'a2'));
	$agg->addShip(new lFighter(1,'a3'));
	$agg->addShip(new lFighter(1,'a4'));
	$agg->addShip(new lFighter(1,'a5'));
	$agg->addShip(new lFighter(1,'a6'));
	$agg->addShip(new offensivDrone(1,'a7'));
	$agg->addShip(new offensivDrone(1,'a8'));
	$agg->addShip(new offensivDrone(1,'a9'));
	$agg->addShip(new offensivDrone(1,'aa'));
	
	$def = new Fleet();
	$def->addShip(new mFighter(1,'d1'));
	$def->addShip(new mFighter(1,'d2'));
	$def->addShip(new mFighter(1,'d3'));
	$def->addShip(new mFighter(1,'d4'));
	$def->addShip(new offensivDrone(1,'d5'));
	$def->addShip(new offensivDrone(1,'d6'));
	
?>