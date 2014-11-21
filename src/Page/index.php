<?php
namespace App\Page;
use \App\Calculation\MonthlyPayment;
use \App\Calculation\TotalRepayment;
use \App\Calculation\Interest;

Class Index extends \Gt\Page\Logic {

public function go() {
	if(!empty($_POST)){
		$this->prepopulateForm();
		$monthlyPayment = new MonthlyPayment(
			$_POST["principle"], 
			$_POST["interest"], 
			$_POST["term"]
		);
		$monthlyPaymentAmount = $monthlyPayment->calculate();

		$totalRepayment = new TotalRepayment(
			$monthlyPaymentAmount, 
			$_POST["term"]
		);
		$totalRepaymentAmount = $totalRepayment->calculate();
		$interest = new Interest(
			$_POST["interest"], 
			$monthlyPaymentAmount, 
			$totalRepaymentAmount, 
			$_POST["principle"], 
			$_POST["term"]
		);
		$interestTotal = $interest->calculateTotal();
		$this->outputTopTips($monthlyPaymentAmount, $totalRepaymentAmount, $interestTotal);

		$this->outputtable(
			$_POST["principle"], 
			$monthlyPaymentAmount, 
			$monthlyPayment->getMonths(),
			$interest->getRate()
		);
	}
}
private function outputtable(
$principle, $monthlyPaymentAmount, $numMonths, $rate) {
	$tablebody = $this->document->querySelector("table tbody");
	$balance = $principle;

	for($currentMonth = 0; $currentMonth <= $numMonths; $currentMonth++) {
		$tr = $this->template->get("payment");
		$columnList = $tr->querySelectorAll("td");

		$monthlyInterestAmount = $balance * $rate;
		$monthlyPrinciplePayment = $monthlyPaymentAmount - $monthlyInterestAmount;

		$columnList[0]->textContent = $currentMonth;
		$columnList[1]->textContent = number_format($monthlyPaymentAmount, 2);
		$columnList[2]->textContent = number_format($monthlyInterestAmount, 2);
		$columnList[3]->textContent = number_format($monthlyPrinciplePayment, 2);
		$columnList[4]->textContent = number_format($balance, 2);

		$balance -= $monthlyPrinciplePayment;

		$tablebody->appendChild($tr);
	}
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