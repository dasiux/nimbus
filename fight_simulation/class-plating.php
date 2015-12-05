<?
class ceramic extends plating {
	public function __construct() {
		$this->techLv = 2;
		$this->pp = 2; //panzerungspunkte
		$this->special['laser'] = 0.9;
		$this->special['kinetic'] = 0.65;
		$this->special['explosion'] = 1.3;
	}
}

class reactive extends plating {
	public function __construct() {
		$this->techLv = 2;
		$this->pp = 2; //panzerungspunkte
		$this->special['laser'] = 2.0;
		$this->special['explosion'] = 0.3;
		$this->special['kinetic'] = 0.5;
	}
}
?>