<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* Classes list:
* - Controller extends Appliction
*/
/**
 *
 */

class Controller extends Appliction {
    protected $_controller, $_action;
    public $view;
    public function __construct($controller, $action) {
        parent::__construct();
        $this->_controller = $controller;
        $this->_action     = $action;
        $this->view        = new View();

    }

    protected function load_model($model)
    {
      if (class_exists($model)) {
        $this->{$model.'Model'} = new $model(strtolower($model));
      }
    }
}
