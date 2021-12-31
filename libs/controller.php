<?php
class Controller {
	function __construct() {
//        if (isset($_SESSION[SID])) {
            $this->view = new view();
//        } else
//            header('Location: '.HOME);
	}
	
	public function loadModel($name) {
		$path = 'models/'.$name.'_model.php';
		if (file_exists($path)) {
			require 'models/'.$name.'_model.php';	
			$modelName = $name . '_Model';
			$this->model = new $modelName();
		}
	}
}
?>