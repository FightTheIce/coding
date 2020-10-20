<?php

namespace FightTheIce\Tests\Coding\PropertyBuilder;

/**
 * FightTheIce\Coding\PropertyBuilder
 *
 * Testing of FightTheIce\Coding\PropertyBuilder
 *
 * @namespace FightTheIce\Tests\Coding\PropertyBuilder
 */
class Test extends \PHPUnit\Framework\TestCase {

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
        $this->obj = new \FightTheIce\Coding\PropertyBuilder("propertyname", "", "public", "long");
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
     * test_PropertyBuilder_hasAttribute_generator
     *
     * Testing that class FightTheIce\Coding\PropertyBuilder has an attribute of:
     * generator
     *
     * @access public
     */
    public function test_PropertyBuilder_hasAttribute_generator() {
        $this->assertClassHasAttribute('generator', \FightTheIce\Coding\PropertyBuilder::class);
    }

    /**
     * test_PropertyBuilder_hasAttribute_describer
     *
     * Testing that class FightTheIce\Coding\PropertyBuilder has an attribute of:
     * describer
     *
     * @access public
     */
    public function test_PropertyBuilder_hasAttribute_describer() {
        $this->assertClassHasAttribute('describer', \FightTheIce\Coding\PropertyBuilder::class);
    }

    /**
     * test_PropertyBuilder_hasMethod_getDescriber
     *
     * Testing that class FightTheIce\Coding\PropertyBuilder has a method by the name
     * of: getDescriber
     *
     * @access public
     */
    public function test_PropertyBuilder_hasMethod_getDescriber() {
        $this->assertTrue(method_exists($this->obj, 'getDescriber'));
    }

    /**
     * test_PropertyBuilder_hasMethod___construct
     *
     * Testing that class FightTheIce\Coding\PropertyBuilder has a method by the name
     * of: __construct
     *
     * @access public
     */
    public function test_PropertyBuilder_hasMethod___construct() {
        $this->assertTrue(method_exists($this->obj, '__construct'));
    }

    /**
     * test_PropertyBuilder___construct_noparams
     *
     * Testing method __construct with no params
     *
     * @access public
     */
    public function test_PropertyBuilder___construct_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = new \FightTheIce\Coding\PropertyBuilder();
    }

    /**
     * test_PropertyBuilder_hasMethod_getGenerator
     *
     * Testing that class FightTheIce\Coding\PropertyBuilder has a method by the name
     * of: getGenerator
     *
     * @access public
     */
    public function test_PropertyBuilder_hasMethod_getGenerator() {
        $this->assertTrue(method_exists($this->obj, 'getGenerator'));
    }

}
