<?php
namespace App\Calculation;

Class Interest {

private $rate;
private $totalRepaymentAmount;
private $principal;
private $monthlyRepaymentAmount;
private $term;

public function __construct($rate, $monthlyRepaymentAmount, $totalRepaymentAmount, $principal, $term) {
	$this->rate = $rate;
	$this->monthlyRepaymentAmount = $monthlyRepaymentAmount;
	$this->totalRepaymentAmount = $totalRepaymentAmount;
	$this->principal = $principal;
	$this->term = $term;
}

public function calculateTotal() {
	return ($this->monthlyRepaymentAmount * $this->term) - $this->principal;
}

public function getRate() {
	return $this->rate / 100 / 12;
}

}#