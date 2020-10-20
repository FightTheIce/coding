<?php

namespace FightTheIce\Tests\Coding\MethodBuilder;

/**
 * FightTheIce\Coding\MethodBuilder
 *
 * Testing of FightTheIce\Coding\MethodBuilder
 *
 * @namespace FightTheIce\Tests\Coding\MethodBuilder
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
        $this->obj = new \FightTheIce\Coding\MethodBuilder("method", "public", "long");
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
     * test_MethodBuilder_hasAttribute_generator
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has an attribute of:
     * generator
     *
     * @access public
     */
    public function test_MethodBuilder_hasAttribute_generator() {
        $this->assertClassHasAttribute('generator', \FightTheIce\Coding\MethodBuilder::class);
    }

    /**
     * test_MethodBuilder_hasAttribute_describer
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has an attribute of:
     * describer
     *
     * @access public
     */
    public function test_MethodBuilder_hasAttribute_describer() {
        $this->assertClassHasAttribute('describer', \FightTheIce\Coding\MethodBuilder::class);
    }

    /**
     * test_MethodBuilder_hasMethod_getDescriber
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has a method by the name of:
     * getDescriber
     *
     * @access public
     */
    public function test_MethodBuilder_hasMethod_getDescriber() {
        $this->assertTrue(method_exists($this->obj, 'getDescriber'));
    }

    /**
     * test_MethodBuilder_hasMethod___construct
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has a method by the name of:
     * __construct
     *
     * @access public
     */
    public function test_MethodBuilder_hasMethod___construct() {
        $this->assertTrue(method_exists($this->obj, '__construct'));
    }

    /**
     * test_MethodBuilder___construct_noparams
     *
     * Testing method __construct with no params
     *
     * @access public
     */
    public function test_MethodBuilder___construct_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->__construct();
    }

    /**
     * test_MethodBuilder_hasMethod_newRequiredParameter
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has a method by the name of:
     * newRequiredParameter
     *
     * @access public
     */
    public function test_MethodBuilder_hasMethod_newRequiredParameter() {
        $this->assertTrue(method_exists($this->obj, 'newRequiredParameter'));
    }

    /**
     * test_MethodBuilder_newRequiredParameter_noparams
     *
     * Testing method newRequiredParameter with no params
     *
     * @access public
     */
    public function test_MethodBuilder_newRequiredParameter_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->newRequiredParameter();
    }

    /**
     * test_MethodBuilder_hasMethod_newRequiredParameterUnknown
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has a method by the name of:
     * newRequiredParameterUnknown
     *
     * @access public
     */
    public function test_MethodBuilder_hasMethod_newRequiredParameterUnknown() {
        $this->assertTrue(method_exists($this->obj, 'newRequiredParameterUnknown'));
    }

    /**
     * test_MethodBuilder_newRequiredParameterUnknown_noparams
     *
     * Testing method newRequiredParameterUnknown with no params
     *
     * @access public
     */
    public function test_MethodBuilder_newRequiredParameterUnknown_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->newRequiredParameterUnknown();
    }

    /**
     * test_MethodBuilder_hasMethod_newOptionalParameter
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has a method by the name of:
     * newOptionalParameter
     *
     * @access public
     */
    public function test_MethodBuilder_hasMethod_newOptionalParameter() {
        $this->assertTrue(method_exists($this->obj, 'newOptionalParameter'));
    }

    /**
     * test_MethodBuilder_newOptionalParameter_noparams
     *
     * Testing method newOptionalParameter with no params
     *
     * @access public
     */
    public function test_MethodBuilder_newOptionalParameter_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->newOptionalParameter();
    }

    /**
     * test_MethodBuilder_hasMethod_newOptionalParameterUnknown
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has a method by the name of:
     * newOptionalParameterUnknown
     *
     * @access public
     */
    public function test_MethodBuilder_hasMethod_newOptionalParameterUnknown() {
        $this->assertTrue(method_exists($this->obj, 'newOptionalParameterUnknown'));
    }

    /**
     * test_MethodBuilder_newOptionalParameterUnknown_noparams
     *
     * Testing method newOptionalParameterUnknown with no params
     *
     * @access public
     */
    public function test_MethodBuilder_newOptionalParameterUnknown_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->newOptionalParameterUnknown();
    }

    /**
     * test_MethodBuilder_hasMethod_setBody
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has a method by the name of:
     * setBody
     *
     * @access public
     */
    public function test_MethodBuilder_hasMethod_setBody() {
        $this->assertTrue(method_exists($this->obj, 'setBody'));
    }

    /**
     * test_MethodBuilder_setBody_noparams
     *
     * Testing method setBody with no params
     *
     * @access public
     */
    public function test_MethodBuilder_setBody_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->setBody();
    }

    /**
     * test_MethodBuilder_hasMethod_getBodyFromObj
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has a method by the name of:
     * getBodyFromObj
     *
     * @access public
     */
    public function test_MethodBuilder_hasMethod_getBodyFromObj() {
        $this->assertTrue(method_exists($this->obj, 'getBodyFromObj'));
    }

    /**
     * test_MethodBuilder_getBodyFromObj_noparams
     *
     * Testing method getBodyFromObj with no params
     *
     * @access public
     */
    public function test_MethodBuilder_getBodyFromObj_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->getBodyFromObj();
    }

    /**
     * test_MethodBuilder_hasMethod_getGenerator
     *
     * Testing that class FightTheIce\Coding\MethodBuilder has a method by the name of:
     * getGenerator
     *
     * @access public
     */
    public function test_MethodBuilder_hasMethod_getGenerator() {
        $this->assertTrue(method_exists($this->obj, 'getGenerator'));
    }

}
