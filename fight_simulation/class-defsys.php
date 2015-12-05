<?
class deflaser extends defenceSystem {
	public function __construct() {
		$this->techLv = 2;
		$this->special['laser'] = 0.0;
		$this->special['kinetic'] = 0.1;
		$this->special['explosion'] = 0.7;
	}
}
?>