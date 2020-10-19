<?php

namespace FightTheIce\Tests\Coding;

/**
 * FightTheIce\Coding\TestBuilder
 *
 * Testing of FightTheIce\Coding\TestBuilder
 *
 * @namespace FightTheIce\Tests\Coding
 */
class TestBuilder extends \PHPUnit\Framework\TestCase {

    /**
     * obj
     *
     * Class Obj
     *
     * @access protected
     */
    protected $obj = null;

    /**
     * setUp
     *
     * Setup the test
     *
     * @access protected
     */
    protected function setUp(): void{
        $this->obj = new \FightTheIce\Coding\TestBuilder((new \FightTheIce\Coding\ClassBuilder("classname", "long", "desc")));
    }

    /**
     * tearDown
     *
     * Teardown the test
     *
     * @access protected
     */
    protected function tearDown(): void {
    }

    /**
     * getObj
     *
     * Get the property obj
     *
     * @access public
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
     */
    public function test_TestBuilder_hasAttribute_test() {
        $this->assertClassHasAttribute('test', \FightTheIce\Coding\TestBuilder::class);
    }

    /**
     * test_TestBuilder_hasMethod_getClass
     *
     * Testing that class FightTheIce\Coding\TestBuilder has a method by the name of:
     * getClass
     *
     * @access public
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
     */
    public function test_TestBuilder_hasMethod_generate() {
        $this->assertTrue(method_exists($this->obj, 'generate'));
    }

}