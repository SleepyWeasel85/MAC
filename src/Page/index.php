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
	for ($i=1; $i <= $_POST["term"]; $i++) { 
		$tr = $this->template->get("payment");
		$columnList = $tr->querySelectorAll("td");
		$columnList[0]->textContent = $i;
		$tablebody->appendChild($tr);
	}
}

}#