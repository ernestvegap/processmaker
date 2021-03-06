<?php
require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php';
require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php';
require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php';
require_once PATH_TRUNK . 'gulliver/system/class.form.php';
require_once PATH_TRUNK . 'gulliver/system/class.dbconnection.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/pear/PEAR.php';
require_once PATH_TRUNK . 'workflow/engine/classes/class.pmDashlet.php';

/**
 * Generated by ProcessMaker Test Unit Generator on 2012-07-12 at 22:32:31.
*/

class classPMDashletTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PMDashlet
    */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
    */
    protected function setUp()
    {
        $this->object = new PMDashlet();
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
        $methods = get_class_methods('PMDashlet');        $this->assertTrue( count($methods) == 58);
    }

    /**
    * @covers PMDashlet::getAdditionalFields
    * @todo   Implement testgetAdditionalFields().
    */
    public function testgetAdditionalFields()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getAdditionalFields', $methods ), 'exists method getAdditionalFields' );
        $r = new ReflectionMethod('PMDashlet', 'getAdditionalFields');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'className');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers PMDashlet::setup
    * @todo   Implement testsetup().
    */
    public function testsetup()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('setup', $methods ), 'exists method setup' );
        $r = new ReflectionMethod('PMDashlet', 'setup');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'dasInsUid');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers PMDashlet::render
    * @todo   Implement testrender().
    */
    public function testrender()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('render', $methods ), 'exists method render' );
        $r = new ReflectionMethod('PMDashlet', 'render');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'width');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == true);
        $this->assertTrue( $params[0]->getDefaultValue() == '300');
    } 

    /**
    * @covers PMDashlet::getDashletInstance
    * @todo   Implement testgetDashletInstance().
    */
    public function testgetDashletInstance()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getDashletInstance', $methods ), 'exists method getDashletInstance' );
        $r = new ReflectionMethod('PMDashlet', 'getDashletInstance');
        $params = $r->getParameters();
    } 

    /**
    * @covers PMDashlet::getDashletObject
    * @todo   Implement testgetDashletObject().
    */
    public function testgetDashletObject()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getDashletObject', $methods ), 'exists method getDashletObject' );
        $r = new ReflectionMethod('PMDashlet', 'getDashletObject');
        $params = $r->getParameters();
    } 

    /**
    * @covers PMDashlet::getDashletsInstances
    * @todo   Implement testgetDashletsInstances().
    */
    public function testgetDashletsInstances()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getDashletsInstances', $methods ), 'exists method getDashletsInstances' );
        $r = new ReflectionMethod('PMDashlet', 'getDashletsInstances');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'start');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == true);
        $this->assertTrue( $params[0]->getDefaultValue() == '');
        $this->assertTrue( $params[1]->getName() == 'limit');
        $this->assertTrue( $params[1]->isArray() == false);
        $this->assertTrue( $params[1]->isOptional () == true);
        $this->assertTrue( $params[1]->getDefaultValue() == '');
    } 

    /**
    * @covers PMDashlet::getDashletsInstancesQuantity
    * @todo   Implement testgetDashletsInstancesQuantity().
    */
    public function testgetDashletsInstancesQuantity()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getDashletsInstancesQuantity', $methods ), 'exists method getDashletsInstancesQuantity' );
        $r = new ReflectionMethod('PMDashlet', 'getDashletsInstancesQuantity');
        $params = $r->getParameters();
    } 

    /**
    * @covers PMDashlet::loadDashletInstance
    * @todo   Implement testloadDashletInstance().
    */
    public function testloadDashletInstance()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('loadDashletInstance', $methods ), 'exists method loadDashletInstance' );
        $r = new ReflectionMethod('PMDashlet', 'loadDashletInstance');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'dasInsUid');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers PMDashlet::saveDashletInstance
    * @todo   Implement testsaveDashletInstance().
    */
    public function testsaveDashletInstance()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('saveDashletInstance', $methods ), 'exists method saveDashletInstance' );
        $r = new ReflectionMethod('PMDashlet', 'saveDashletInstance');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'data');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers PMDashlet::deleteDashletInstance
    * @todo   Implement testdeleteDashletInstance().
    */
    public function testdeleteDashletInstance()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('deleteDashletInstance', $methods ), 'exists method deleteDashletInstance' );
        $r = new ReflectionMethod('PMDashlet', 'deleteDashletInstance');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'dasInsUid');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers PMDashlet::getDashletsInstancesForUser
    * @todo   Implement testgetDashletsInstancesForUser().
    */
    public function testgetDashletsInstancesForUser()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getDashletsInstancesForUser', $methods ), 'exists method getDashletsInstancesForUser' );
        $r = new ReflectionMethod('PMDashlet', 'getDashletsInstancesForUser');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'userUid');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers PMDashlet::getXTemplate
    * @todo   Implement testgetXTemplate().
    */
    public function testgetXTemplate()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getXTemplate', $methods ), 'exists method getXTemplate' );
        $r = new ReflectionMethod('PMDashlet', 'getXTemplate');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'className');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

  } 
