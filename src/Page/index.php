<?php
namespace App\Page;

Class Index extends \Gt\Page\Logic {

public function go() {
	if(!empty($_POST)){
		$this->outputtable();
	}
}
private function outputtable(){
	var_dump($_POST);
	die("cunt");
}

}#