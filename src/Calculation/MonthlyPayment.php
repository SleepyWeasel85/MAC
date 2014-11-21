<?php
namespace App\Calculation;

Class MonthlyPayment {

private $principle;
private $rate;
private $term;

public function __construct($principle, $rate, $term){
	$this->principle = $principle;
	$this->rate = $rate/100/12;
	$this->term = $term;
}

public function calculate(){
	$numerator = $this->rate*$this->principle*$this->getMultiplier();
	$denominator = $this->getMultiplier()-1;
	return $numerator/$denominator;
}

private function getMultiplier(){
	return pow(1+$this->rate,$this->term);
}
}#