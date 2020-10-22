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
        $this->obj = new \FightTheIce\Coding\TraitBuilder("trait", "short", "long");
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
     * test_TraitBuilder_hasAttribute_generator
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has an attribute of:
     * generator
     *
     * @access public
     * @method test_TraitBuilder_hasAttribute_generator() Testing that class
     * FightTheIce\Coding\TraitBuilder has an attribute of: generator
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
     * @method test_TraitBuilder_hasAttribute_describer() Testing that class
     * FightTheIce\Coding\TraitBuilder has an attribute of: describer
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
     * @method test_TraitBuilder_hasAttribute_properties() Testing that class
     * FightTheIce\Coding\TraitBuilder has an attribute of: properties
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
     * @method test_TraitBuilder_hasAttribute_methods() Testing that class
     * FightTheIce\Coding\TraitBuilder has an attribute of: methods
     */
    public function test_TraitBuilder_hasAttribute_methods() {
        $this->assertClassHasAttribute('methods', \FightTheIce\Coding\TraitBuilder::class);
    }

    /**
     * test_TraitBuilder_hasMethod___construct
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * __construct
     *
     * @access public
     * @method test_TraitBuilder_hasMethod___construct() Testing that class
     * FightTheIce\Coding\TraitBuilder has a method by the name of: __construct
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
     * @method test_TraitBuilder___construct_noparams() Testing method __construct with
     * no params
     */
    public function test_TraitBuilder___construct_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = new \FightTheIce\Coding\TraitBuilder();
    }

    /**
     * test_TraitBuilder_hasMethod_getGenerator
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * getGenerator
     *
     * @access public
     * @method test_TraitBuilder_hasMethod_getGenerator() Testing that class
     * FightTheIce\Coding\TraitBuilder has a method by the name of: getGenerator
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
     * @method test_TraitBuilder_hasMethod_getDescriber() Testing that class
     * FightTheIce\Coding\TraitBuilder has a method by the name of: getDescriber
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
     * @method test_TraitBuilder_hasMethod_getProperties() Testing that class
     * FightTheIce\Coding\TraitBuilder has a method by the name of: getProperties
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
     * @method test_TraitBuilder_hasMethod_getMethods() Testing that class
     * FightTheIce\Coding\TraitBuilder has a method by the name of: getMethods
     */
    public function test_TraitBuilder_hasMethod_getMethods() {
        $this->assertTrue(method_exists($this->obj, 'getMethods'));
    }

    /**
     * test_TraitBuilder_hasMethod_addClassTag
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * addClassTag
     *
     * @access public
     * @method test_TraitBuilder_hasMethod_addClassTag() Testing that class
     * FightTheIce\Coding\TraitBuilder has a method by the name of: addClassTag
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
     * @method test_TraitBuilder_addClassTag_noparams() Testing method addClassTag with
     * no params
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
     * @method test_TraitBuilder_hasMethod_newProperty() Testing that class
     * FightTheIce\Coding\TraitBuilder has a method by the name of: newProperty
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
     * @method test_TraitBuilder_newProperty_noparams() Testing method newProperty with
     * no params
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
     * @method test_TraitBuilder_hasMethod_newMethod() Testing that class
     * FightTheIce\Coding\TraitBuilder has a method by the name of: newMethod
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
     * @method test_TraitBuilder_newMethod_noparams() Testing method newMethod with no
     * params
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
     * @method test_TraitBuilder_hasMethod_uses() Testing that class
     * FightTheIce\Coding\TraitBuilder has a method by the name of: uses
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
     * @method test_TraitBuilder_uses_noparams() Testing method uses with no params
     */
    public function test_TraitBuilder_uses_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->uses();
    }

    /**
     * test_TraitBuilder_hasMethod_generate
     *
     * Testing that class FightTheIce\Coding\TraitBuilder has a method by the name of:
     * generate
     *
     * @access public
     * @method test_TraitBuilder_hasMethod_generate() Testing that class
     * FightTheIce\Coding\TraitBuilder has a method by the name of: generate
     */
    public function test_TraitBuilder_hasMethod_generate() {
        $this->assertTrue(method_exists($this->obj, 'generate'));
    }

}
