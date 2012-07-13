<?php
require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php';
require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php';
require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php';
require_once PATH_TRUNK . 'gulliver/system/class.form.php';
require_once PATH_TRUNK . 'gulliver/system/class.dbconnection.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/pear/PEAR.php';
require_once PATH_TRUNK . 'workflow/engine/classes/class.wsResponse.php';

/**
 * Generated by ProcessMaker Test Unit Generator on 2012-07-12 at 22:32:31.
*/

class classwsResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var wsResponse
    */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
    */
    protected function setUp()
    {
        $this->object = new wsResponse();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
    */
    protected function tearDown()
    {
    }

    /**
     * This is the default method to test, if the class still having 
     * the same number of methods.
    */
    public function testNumberOfMethodsInThisClass()
    {
        $methods = get_class_methods('wsResponse');        $this->assertTrue( count($methods) == 3);
    }

    /**
    * @covers wsResponse::__construct
    * @todo   Implement test__construct().
    */
    public function test__construct()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('__construct', $methods ), 'exists method __construct' );
        $r = new ReflectionMethod('wsResponse', '__construct');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'status');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
        $this->assertTrue( $params[1]->getName() == 'message');
        $this->assertTrue( $params[1]->isArray() == false);
        $this->assertTrue( $params[1]->isOptional () == false);
    } 

    /**
    * @covers wsResponse::getPayloadString
    * @todo   Implement testgetPayloadString().
    */
    public function testgetPayloadString()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getPayloadString', $methods ), 'exists method getPayloadString' );
        $r = new ReflectionMethod('wsResponse', 'getPayloadString');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'operation');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers wsResponse::getPayloadArray
    * @todo   Implement testgetPayloadArray().
    */
    public function testgetPayloadArray()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getPayloadArray', $methods ), 'exists method getPayloadArray' );
        $r = new ReflectionMethod('wsResponse', 'getPayloadArray');
        $params = $r->getParameters();
    } 

  } 
