<?php
/**
 * class.redirecLogin.php
 *  
 */

  class redirecLoginClass extends PMPlugin {
    function __construct() {
      set_include_path(
        PATH_PLUGINS . 'redirecLogin' . PATH_SEPARATOR .
        get_include_path()
      );
    }

    function setup()
    {
    }

    function getFieldsForPageSetup()
    {
    }

    function updateFieldsForPageSetup()
    {
    }

  }
?>