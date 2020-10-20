<?php

namespace FightTheIce\Tests\Coding\TraitBuilder;

/**
 * FightTheIce\Coding\TraitBuilder
 *
 * Testing of FightTheIce\Coding\TraitBuilder
 *
 * @namespace FightTheIce\Tests\Coding\TraitBuilder
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
        $this->obj = new \FightTheIce\Coding\TraitBuilder();
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
     * test_TraitBuilder_hasAttribute_generator
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has an attribute of:
     * generator
     *
     * @access public
     */
    public function test_TraitBuilder_hasAttribute_generator() {
        $this->assertClassHasAttribute('generator', \FightTheIce\Coding\TraitBuilder::class);
    }

    /**
     * test_TraitBuilder_hasAttribute_describer
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has an attribute of:
     * describer
     *
     * @access public
     */
    public function test_TraitBuilder_hasAttribute_describer() {
        $this->assertClassHasAttribute('describer', \FightTheIce\Coding\TraitBuilder::class);
    }

    /**
     * test_TraitBuilder_hasAttribute_properties
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has an attribute of:
     * properties
     *
     * @access public
     */
    public function test_TraitBuilder_hasAttribute_properties() {
        $this->assertClassHasAttribute('properties', \FightTheIce\Coding\TraitBuilder::class);
    }

    /**
     * test_TraitBuilder_hasAttribute_methods
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has an attribute of: methods
     *
     * @access public
     */
    public function test_TraitBuilder_hasAttribute_methods() {
        $this->assertClassHasAttribute('methods', \FightTheIce\Coding\TraitBuilder::class);
    }

    /**
     * test_TraitBuilder_hasMethod_getGenerator
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * getGenerator
     *
     * @access public
     */
    public function test_TraitBuilder_hasMethod_getGenerator() {
        $this->assertTrue(method_exists($this->obj, 'getGenerator'));
    }

    /**
     * test_TraitBuilder_hasMethod_getDescriber
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * getDescriber
     *
     * @access public
     */
    public function test_TraitBuilder_hasMethod_getDescriber() {
        $this->assertTrue(method_exists($this->obj, 'getDescriber'));
    }

    /**
     * test_TraitBuilder_hasMethod_getProperties
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * getProperties
     *
     * @access public
     */
    public function test_TraitBuilder_hasMethod_getProperties() {
        $this->assertTrue(method_exists($this->obj, 'getProperties'));
    }

    /**
     * test_TraitBuilder_hasMethod_getMethods
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * getMethods
     *
     * @access public
     */
    public function test_TraitBuilder_hasMethod_getMethods() {
        $this->assertTrue(method_exists($this->obj, 'getMethods'));
    }

    /**
     * test_TraitBuilder_hasMethod___construct
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * __construct
     *
     * @access public
     */
    public function test_TraitBuilder_hasMethod___construct() {
        $this->assertTrue(method_exists($this->obj, '__construct'));
    }

    /**
     * test_TraitBuilder___construct_noparams
     *
     * Testing method __construct with no params
     *
     * @access public
     */
    public function test_TraitBuilder___construct_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->__construct();
    }

    /**
     * test_TraitBuilder_hasMethod_addClassTag
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * addClassTag
     *
     * @access public
     */
    public function test_TraitBuilder_hasMethod_addClassTag() {
        $this->assertTrue(method_exists($this->obj, 'addClassTag'));
    }

    /**
     * test_TraitBuilder_addClassTag_noparams
     *
     * Testing method addClassTag with no params
     *
     * @access public
     */
    public function test_TraitBuilder_addClassTag_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->addClassTag();
    }

    /**
     * test_TraitBuilder_hasMethod_newProperty
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * newProperty
     *
     * @access public
     */
    public function test_TraitBuilder_hasMethod_newProperty() {
        $this->assertTrue(method_exists($this->obj, 'newProperty'));
    }

    /**
     * test_TraitBuilder_newProperty_noparams
     *
     * Testing method newProperty with no params
     *
     * @access public
     */
    public function test_TraitBuilder_newProperty_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->newProperty();
    }

    /**
     * test_TraitBuilder_hasMethod_newMethod
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * newMethod
     *
     * @access public
     */
    public function test_TraitBuilder_hasMethod_newMethod() {
        $this->assertTrue(method_exists($this->obj, 'newMethod'));
    }

    /**
     * test_TraitBuilder_newMethod_noparams
     *
     * Testing method newMethod with no params
     *
     * @access public
     */
    public function test_TraitBuilder_newMethod_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->newMethod();
    }

    /**
     * test_TraitBuilder_hasMethod_uses
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * uses
     *
     * @access public
     */
    public function test_TraitBuilder_hasMethod_uses() {
        $this->assertTrue(method_exists($this->obj, 'uses'));
    }

    /**
     * test_TraitBuilder_uses_noparams
     *
     * Testing method uses with no params
     *
     * @access public
     */
    public function test_TraitBuilder_uses_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->uses();
    }

    /**
     * test_TraitBuilder_hasMethod_compile
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * compile
     *
     * @access public
     */
    public function test_TraitBuilder_hasMethod_compile() {
        $this->assertTrue(method_exists($this->obj, 'compile'));
    }

}
