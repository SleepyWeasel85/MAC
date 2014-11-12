<?php
namespace App\Page;

Class Index extends \Gt\Page\Logic {

public function go() {
	if(!empty($_POST)){
		$this->outputtable();
	}
}
private function outputtable(){
	$tablebody = $this->document->querySelector("table tbody");
	for ($i=0; $i < 10; $i++) { 
		$tr = $this->template->get("payment");
		$tablebody->appendChild($tr);
	}
}

}#