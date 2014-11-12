<?php
namespace App\Page;

Class Index extends \Gt\Page\Logic {

public function go() {
	if(!empty($_POST)){
		$this->outputtable();
		$this->prepopulateForm();
	}
}
private function outputtable(){
	$principle = $_POST["principle"];
	$rate = $_POST["interest"];
	$months = $_POST["term"];

	$tablebody = $this->document->querySelector("table tbody");
	for ($i=1; $i <= $months; $i++) {
		$topline = $rate*$principle*pow(1+$rate,$months);
		$bottomline = pow(1+$rate, $months)-1;
		$amount = $topline/$bottomline;

		$tr = $this->template->get("payment");
		$columnList = $tr->querySelectorAll("td");
		$columnList[0]->textContent = $i;
		$columnList[1]->textContent = number_format($amount, 2);
		$tablebody->appendChild($tr);
	}
}

private function prepopulateForm() {
	foreach ($_POST as $key => $value) {
		$this->document->querySelector("input#$key")->value = $value;
	}
}

}#