<?php
namespace App\Calculation;

class MonthlyPayment_Test extends \PHPUnit_Framework_TestCase {

public function setUp() {
	require_once(__DIR__ . "/../../../src/Calculation/MonthlyPayment.php");
}

public function testCalculates() {
	$monthlyPayment = new MonthlyPayment(150000, 4.9, 240);
	$monthlyPaymentAmount = $monthlyPayment->calculate();

	$this->assertEquals(981.67, $monthlyPaymentAmount);
}

}#