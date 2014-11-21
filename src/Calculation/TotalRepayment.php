<?php
namespace App\Calculation;

Class TotalRepayment {

private $monthlyPaymentAmount;
private $term;

public function __construct($monthlyPaymentAmount, $term) {
	$this->monthlyPaymentAmount = $monthlyPaymentAmount;
	$this->term = $term;
}

public function calculate() {
	return $this->monthlyPaymentAmount * $this->term;
}

}#
