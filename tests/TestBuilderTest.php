<?php

namespace FightTheIce\Tests\Coding\TestBuilder;

/**
 * FightTheIce\Coding\TestBuilder
 *
 * Testing of FightTheIce\Coding\TestBuilder
 *
 * @namespace FightTheIce\Tests\Coding\TestBuilder
 */
class Test extends \PHPUnit\Framework\TestCase {

    /**
     * obj
     *
     * Class Obj
     *
     * @access protected
     * @property NULL $obj Class Obj
     */
    protected $obj = null;

    /**
     * setUp
     *
     * Setup the test
     *
     * @access protected
     * @method setUp() Setup the test
     */
    protected function setUp(): void{
        $this->obj = new \FightTheIce\Coding\TestBuilder((new \FightTheIce\Coding\ClassBuilder("class", "short", "long")));
    }

    /**
     * getObj
     *
     * Get the property obj
     *
     * @access public
     * @method getObj() Get the property obj
     */
    public function getObj() {
        return $this->obj;
    }

    /**
     * test_TestBuilder_hasAttribute_class
     *
     * Testing that class FightTheIce\Coding\TestBuilder has an attribute of: class
     *
     * @access public
     * @method test_TestBuilder_hasAttribute_class() Testing that class
     * FightTheIce\Coding\TestBuilder has an attribute of: class
     */
    public function test_TestBuilder_hasAttribute_class() {
        $this->assertClassHasAttribute('class', \FightTheIce\Coding\TestBuilder::class);
    }

    /**
     * test_TestBuilder_hasAttribute_name
     *
     * Testing that class FightTheIce\Coding\TestBuilder has an attribute of: name
     *
     * @access public
     * @method test_TestBuilder_hasAttribute_name() Testing that class
     * FightTheIce\Coding\TestBuilder has an attribute of: name
     */
    public function test_TestBuilder_hasAttribute_name() {
        $this->assertClassHasAttribute('name', \FightTheIce\Coding\TestBuilder::class);
    }

    /**
     * test_TestBuilder_hasAttribute_shortName
     *
     * Testing that class FightTheIce\Coding\TestBuilder has an attribute of: shortName
     *
     * @access public
     * @method test_TestBuilder_hasAttribute_shortName() Testing that class
     * FightTheIce\Coding\TestBuilder has an attribute of: shortName
     */
    public function test_TestBuilder_hasAttribute_shortName() {
        $this->assertClassHasAttribute('shortName', \FightTheIce\Coding\TestBuilder::class);
    }

    /**
     * test_TestBuilder_hasAttribute_test
     *
     * Testing that class FightTheIce\Coding\TestBuilder has an attribute of: test
     *
     * @access public
     * @method test_TestBuilder_hasAttribute_test() Testing that class
     * FightTheIce\Coding\TestBuilder has an attribute of: test
     */
    public function test_TestBuilder_hasAttribute_test() {
        $this->assertClassHasAttribute('test', \FightTheIce\Coding\TestBuilder::class);
    }

    /**
     * test_TestBuilder_hasMethod___construct
     *
     * Testing that class FightTheIce\Coding\TestBuilder has a method by the name of:
     * __construct
     *
     * @access public
     * @method test_TestBuilder_hasMethod___construct() Testing that class
     * FightTheIce\Coding\TestBuilder has a method by the name of: __construct
     */
    public function test_TestBuilder_hasMethod___construct() {
        $this->assertTrue(method_exists($this->obj, '__construct'));
    }

    /**
     * test_TestBuilder___construct_noparams
     *
     * Testing method __construct with no params
     *
     * @access public
     * @method test_TestBuilder___construct_noparams() Testing method __construct with
     * no params
     */
    public function test_TestBuilder___construct_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = new \FightTheIce\Coding\TestBuilder();
    }

    /**
     * test_TestBuilder_hasMethod_getClass
     *
     * Testing that class FightTheIce\Coding\TestBuilder has a method by the name of:
     * getClass
     *
     * @access public
     * @method test_TestBuilder_hasMethod_getClass() Testing that class
     * FightTheIce\Coding\TestBuilder has a method by the name of: getClass
     */
    public function test_TestBuilder_hasMethod_getClass() {
        $this->assertTrue(method_exists($this->obj, 'getClass'));
    }

    /**
     * test_TestBuilder_hasMethod_getName
     *
     * Testing that class FightTheIce\Coding\TestBuilder has a method by the name of:
     * getName
     *
     * @access public
     * @method test_TestBuilder_hasMethod_getName() Testing that class
     * FightTheIce\Coding\TestBuilder has a method by the name of: getName
     */
    public function test_TestBuilder_hasMethod_getName() {
        $this->assertTrue(method_exists($this->obj, 'getName'));
    }

    /**
     * test_TestBuilder_hasMethod_getShortname
     *
     * Testing that class FightTheIce\Coding\TestBuilder has a method by the name of:
     * getShortname
     *
     * @access public
     * @method test_TestBuilder_hasMethod_getShortname() Testing that class
     * FightTheIce\Coding\TestBuilder has a method by the name of: getShortname
     */
    public function test_TestBuilder_hasMethod_getShortname() {
        $this->assertTrue(method_exists($this->obj, 'getShortname'));
    }

    /**
     * test_TestBuilder_hasMethod_getTest
     *
     * Testing that class FightTheIce\Coding\TestBuilder has a method by the name of:
     * getTest
     *
     * @access public
     * @method test_TestBuilder_hasMethod_getTest() Testing that class
     * FightTheIce\Coding\TestBuilder has a method by the name of: getTest
     */
    public function test_TestBuilder_hasMethod_getTest() {
        $this->assertTrue(method_exists($this->obj, 'getTest'));
    }

    /**
     * test_TestBuilder_hasMethod_generate
     *
     * Testing that class FightTheIce\Coding\TestBuilder has a method by the name of:
     * generate
     *
     * @access public
     * @method test_TestBuilder_hasMethod_generate() Testing that class
     * FightTheIce\Coding\TestBuilder has a method by the name of: generate
     */
    public function test_TestBuilder_hasMethod_generate() {
        $this->assertTrue(method_exists($this->obj, 'generate'));
    }

    /**
     * test_TestBuilder_hasMethod_buildSetup
     *
     * Testing that class FightTheIce\Coding\TestBuilder has a method by the name of:
     * buildSetup
     *
     * @access public
     * @method test_TestBuilder_hasMethod_buildSetup() Testing that class
     * FightTheIce\Coding\TestBuilder has a method by the name of: buildSetup
     */
    public function test_TestBuilder_hasMethod_buildSetup() {
        $this->assertTrue(method_exists($this->obj, 'buildSetup'));
    }

    /**
     * test_TestBuilder_buildSetup_noparams
     *
     * Testing method buildSetup with no params
     *
     * @access public
     * @method test_TestBuilder_buildSetup_noparams() Testing method buildSetup with no
     * params
     */
    public function test_TestBuilder_buildSetup_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->buildSetup();
    }

}
