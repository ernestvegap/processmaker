<?php
require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php';
require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php';
require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php';
require_once PATH_TRUNK . 'gulliver/system/class.form.php';
require_once PATH_TRUNK . 'gulliver/system/class.dbconnection.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/pear/PEAR.php';
require_once PATH_TRUNK . 'gulliver/system/class.dbtable.php';

/**
 * Generated by ProcessMaker Test Unit Generator on 2012-07-12 at 22:32:22.
*/

class classDBTableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DBTable
    */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
    */
    protected function setUp()
    {
        $this->object = new DBTable();
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
        $methods = get_class_methods('DBTable');        $this->assertTrue( count($methods) == 11);
    }

    /**
    * @covers DBTable::dBTable
    * @todo   Implement testdBTable().
    */
    public function testdBTable()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('dBTable', $methods ), 'exists method dBTable' );
        $r = new ReflectionMethod('DBTable', 'dBTable');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'objConnection');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == true);
        $this->assertTrue( $params[0]->getDefaultValue() == '');
        $this->assertTrue( $params[1]->getName() == 'strTable');
        $this->assertTrue( $params[1]->isArray() == false);
        $this->assertTrue( $params[1]->isOptional () == true);
        $this->assertTrue( $params[1]->getDefaultValue() == '');
        $this->assertTrue( $params[2]->getName() == 'arrKeys');
        $this->assertTrue( $params[2]->isArray() == false);
        $this->assertTrue( $params[2]->isOptional () == true);
        $this->assertTrue( $params[2]->getDefaultValue() == 'Array');
    } 

    /**
    * @covers DBTable::setTo
    * @todo   Implement testsetTo().
    */
    public function testsetTo()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('setTo', $methods ), 'exists method setTo' );
        $r = new ReflectionMethod('DBTable', 'setTo');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'objDBConnection');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
        $this->assertTrue( $params[1]->getName() == 'strTable');
        $this->assertTrue( $params[1]->isArray() == false);
        $this->assertTrue( $params[1]->isOptional () == true);
        $this->assertTrue( $params[1]->getDefaultValue() == '');
        $this->assertTrue( $params[2]->getName() == 'arrKeys');
        $this->assertTrue( $params[2]->isArray() == false);
        $this->assertTrue( $params[2]->isOptional () == true);
        $this->assertTrue( $params[2]->getDefaultValue() == 'Array');
    } 

    /**
    * @covers DBTable::loadEmpty
    * @todo   Implement testloadEmpty().
    */
    public function testloadEmpty()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('loadEmpty', $methods ), 'exists method loadEmpty' );
        $r = new ReflectionMethod('DBTable', 'loadEmpty');
        $params = $r->getParameters();
    } 

    /**
    * @covers DBTable::loadWhere
    * @todo   Implement testloadWhere().
    */
    public function testloadWhere()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('loadWhere', $methods ), 'exists method loadWhere' );
        $r = new ReflectionMethod('DBTable', 'loadWhere');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'strWhere');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers DBTable::load
    * @todo   Implement testload().
    */
    public function testload()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('load', $methods ), 'exists method load' );
        $r = new ReflectionMethod('DBTable', 'load');
        $params = $r->getParameters();
    } 

    /**
    * @covers DBTable::nextvalPGSql
    * @todo   Implement testnextvalPGSql().
    */
    public function testnextvalPGSql()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('nextvalPGSql', $methods ), 'exists method nextvalPGSql' );
        $r = new ReflectionMethod('DBTable', 'nextvalPGSql');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'seq');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers DBTable::insert
    * @todo   Implement testinsert().
    */
    public function testinsert()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('insert', $methods ), 'exists method insert' );
        $r = new ReflectionMethod('DBTable', 'insert');
        $params = $r->getParameters();
    } 

    /**
    * @covers DBTable::update
    * @todo   Implement testupdate().
    */
    public function testupdate()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('update', $methods ), 'exists method update' );
        $r = new ReflectionMethod('DBTable', 'update');
        $params = $r->getParameters();
    } 

    /**
    * @covers DBTable::save
    * @todo   Implement testsave().
    */
    public function testsave()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('save', $methods ), 'exists method save' );
        $r = new ReflectionMethod('DBTable', 'save');
        $params = $r->getParameters();
    } 

    /**
    * @covers DBTable::delete
    * @todo   Implement testdelete().
    */
    public function testdelete()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('delete', $methods ), 'exists method delete' );
        $r = new ReflectionMethod('DBTable', 'delete');
        $params = $r->getParameters();
    } 

    /**
    * @covers DBTable::next
    * @todo   Implement testnext().
    */
    public function testnext()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('next', $methods ), 'exists method next' );
        $r = new ReflectionMethod('DBTable', 'next');
        $params = $r->getParameters();
    } 

  } 
