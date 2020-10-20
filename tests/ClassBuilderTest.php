<?php

namespace FightTheIce\Tests\Coding\ClassBuilder;

/**
 * FightTheIce\Coding\ClassBuilder
 *
 * Testing of FightTheIce\Coding\ClassBuilder
 *
 * @namespace FightTheIce\Tests\Coding\ClassBuilder
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
        $this->obj = new \FightTheIce\Coding\ClassBuilder("class", "short", "long");
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
     * test_ClassBuilder_hasAttribute_generator
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has an attribute of:
     * generator
     *
     * @access public
     */
    public function test_ClassBuilder_hasAttribute_generator() {
        $this->assertClassHasAttribute('generator', \FightTheIce\Coding\ClassBuilder::class);
    }

    /**
     * test_ClassBuilder_hasAttribute_describer
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has an attribute of:
     * describer
     *
     * @access public
     */
    public function test_ClassBuilder_hasAttribute_describer() {
        $this->assertClassHasAttribute('describer', \FightTheIce\Coding\ClassBuilder::class);
    }

    /**
     * test_ClassBuilder_hasAttribute_properties
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has an attribute of:
     * properties
     *
     * @access public
     */
    public function test_ClassBuilder_hasAttribute_properties() {
        $this->assertClassHasAttribute('properties', \FightTheIce\Coding\ClassBuilder::class);
    }

    /**
     * test_ClassBuilder_hasAttribute_methods
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has an attribute of: methods
     *
     * @access public
     */
    public function test_ClassBuilder_hasAttribute_methods() {
        $this->assertClassHasAttribute('methods', \FightTheIce\Coding\ClassBuilder::class);
    }

    /**
     * test_ClassBuilder_hasMethod_getGenerator
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * getGenerator
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_getGenerator() {
        $this->assertTrue(method_exists($this->obj, 'getGenerator'));
    }

    /**
     * test_ClassBuilder_hasMethod_getDescriber
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * getDescriber
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_getDescriber() {
        $this->assertTrue(method_exists($this->obj, 'getDescriber'));
    }

    /**
     * test_ClassBuilder_hasMethod_getProperties
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * getProperties
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_getProperties() {
        $this->assertTrue(method_exists($this->obj, 'getProperties'));
    }

    /**
     * test_ClassBuilder_hasMethod_getMethods
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * getMethods
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_getMethods() {
        $this->assertTrue(method_exists($this->obj, 'getMethods'));
    }

    /**
     * test_ClassBuilder_hasMethod___construct
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * __construct
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod___construct() {
        $this->assertTrue(method_exists($this->obj, '__construct'));
    }

    /**
     * test_ClassBuilder___construct_noparams
     *
     * Testing method __construct with no params
     *
     * @access public
     */
    public function test_ClassBuilder___construct_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->__construct();
    }

    /**
     * test_ClassBuilder_hasMethod_addClassTag
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * addClassTag
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_addClassTag() {
        $this->assertTrue(method_exists($this->obj, 'addClassTag'));
    }

    /**
     * test_ClassBuilder_addClassTag_noparams
     *
     * Testing method addClassTag with no params
     *
     * @access public
     */
    public function test_ClassBuilder_addClassTag_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->addClassTag();
    }

    /**
     * test_ClassBuilder_hasMethod_newProperty
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * newProperty
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_newProperty() {
        $this->assertTrue(method_exists($this->obj, 'newProperty'));
    }

    /**
     * test_ClassBuilder_newProperty_noparams
     *
     * Testing method newProperty with no params
     *
     * @access public
     */
    public function test_ClassBuilder_newProperty_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->newProperty();
    }

    /**
     * test_ClassBuilder_hasMethod_newMethod
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * newMethod
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_newMethod() {
        $this->assertTrue(method_exists($this->obj, 'newMethod'));
    }

    /**
     * test_ClassBuilder_newMethod_noparams
     *
     * Testing method newMethod with no params
     *
     * @access public
     */
    public function test_ClassBuilder_newMethod_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->newMethod();
    }

    /**
     * test_ClassBuilder_hasMethod_uses
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * uses
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_uses() {
        $this->assertTrue(method_exists($this->obj, 'uses'));
    }

    /**
     * test_ClassBuilder_uses_noparams
     *
     * Testing method uses with no params
     *
     * @access public
     */
    public function test_ClassBuilder_uses_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->uses();
    }

    /**
     * test_ClassBuilder_hasMethod_classExtends
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * classExtends
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_classExtends() {
        $this->assertTrue(method_exists($this->obj, 'classExtends'));
    }

    /**
     * test_ClassBuilder_classExtends_noparams
     *
     * Testing method classExtends with no params
     *
     * @access public
     */
    public function test_ClassBuilder_classExtends_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->classExtends();
    }

    /**
     * test_ClassBuilder_hasMethod_generate
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * generate
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_generate() {
        $this->assertTrue(method_exists($this->obj, 'generate'));
    }

    /**
     * test_ClassBuilder_hasMethod_getMethod
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * getMethod
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_getMethod() {
        $this->assertTrue(method_exists($this->obj, 'getMethod'));
    }

    /**
     * test_ClassBuilder_getMethod_noparams
     *
     * Testing method getMethod with no params
     *
     * @access public
     */
    public function test_ClassBuilder_getMethod_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->getMethod();
    }

    /**
     * test_ClassBuilder_hasMethod_getProperty
     *
     * Testing that class FightTheIce\Coding\ClassBuilder has a method by the name of:
     * getProperty
     *
     * @access public
     */
    public function test_ClassBuilder_hasMethod_getProperty() {
        $this->assertTrue(method_exists($this->obj, 'getProperty'));
    }

    /**
     * test_ClassBuilder_getProperty_noparams
     *
     * Testing method getProperty with no params
     *
     * @access public
     */
    public function test_ClassBuilder_getProperty_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->getProperty();
    }

}
