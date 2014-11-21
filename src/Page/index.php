<?php
namespace App\Page;
use \App\Calculation\MonthlyPayment;

Class Index extends \Gt\Page\Logic {

public function go() {
	if(!empty($_POST)){
		$monthlyPayment = new MonthlyPayment($_POST["principle"], $_POST["interest"], $_POST["term"]);
		$monthlyPaymentAmount = $monthlyPayment->calculate();
		$this->outputtable();
		$this->prepopulateForm();
		$this->outputTopTips($monthlyPaymentAmount);
	}
}
private function outputtable(){
	// $tablebody = $this->document->querySelector("table tbody");

	// 	$tr = $this->template->get("payment");
	// 	$columnList = $tr->querySelectorAll("td");
	// 	$columnList[0]->textContent = $i;
	// 	$columnList[1]->textContent = number_format($amount, 2);
	// 	$tablebody->appendChild($tr);
}

private function outputTopTips($monthlyPaymentAmount){
	$this->document->querySelector("aside #monthlyPaymentAmount")->textContent=
		number_format($monthlyPaymentAmount,2);
}

private function prepopulateForm() {
	foreach ($_POST as $key => $value) {
		$this->document->querySelector("input#$key")->value = $value;
	}
}

}#