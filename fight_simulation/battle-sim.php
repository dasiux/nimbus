<?
	include('class.php');
	include('fleet.php');

	class battle {
		private $fleets;
		private $round = 0;
		private $stat = array();
		private $list = array();
		
		private function loadFleets($agg,$def) {
			$this->fleets = array(
				'0' => $agg,
				'1' => $def
			);
		}
		
		private function sortRange() {
			foreach($this->fleets as $fNo => $f) {
				foreach($f->shipList as $sNo => $s) {
					$range = $s->getWeaponRange()
					while(isset($this->list[$range])) {
						$range--;
					}
					$this->list[$range]= array($fNo,$sNo);
				}
			}
			ksort($this->list);
			$this->list = array_reverse($this->list,true);
		}
		
		private function bRound() {
			for($i=1;$i<3;$i++) {
				$source = $this->opo[$i];
				$target = $this->opo[3-$i];
				
				if($val = $source->doShot()) {
					echo 'Schiff '. $i .' schießt auf Schiff '. (3-$i) .'mit<br/>';
					echo 'Waffentyp '. $val[0] .' und '. $val[1] .'dp<br/>';
					$target->getHit($val[0],$val[1]);
					echo '--------------------------------<br/>';
				}else{
					echo 'Schiff '. $i .' hat keine bewaffnung<br/>';
				}
			}
		}
		
		public function __construct($agg,$def) {
			$this->loadFleets($agg,$def);
			$this->sortRange();
			
			//liste abarbeiten
		}
	}
	
	new battle();

?>