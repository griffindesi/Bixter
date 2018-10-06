<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - _set_reporting()
* - _unregister_globals()
* Classes list:
* - Appliction
*/
/**
 *
 */

class Appliction {

    function __construct() {
        $this->_set_reporting();
        $this->_unregister_globals();

    }
    private function _set_reporting() {
        // code...
        if (DEBUG) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            // code...

        }
        else {
            error_reporting(0);
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'errors.log');

        }
    }
    private function _unregister_globals() {
        if (ini_get('register_globals')) {
            $globalAry = ['_SESSSION', '_COOKIE', '_POST', '_GET', '_REQUEST', '_SERVER', '_ENV', '_FILES'];
            foreach ($globalAry as $value) {
                foreach ($GLOBALS[$value] as $k => $v) {
                    if ($GLOBALS[$value] === $v) {
                        unset($GLOBALS[$value]);
                    }
                }
            }
        }
    }
}
