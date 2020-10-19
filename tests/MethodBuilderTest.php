<?php

namespace FightTheIce\Tests\Coding;

/**
 * FightTheIce\Coding\MethodBuilder
 *
 * Testing of FightTheIce\Coding\MethodBuilder
 *
 * @namespace FightTheIce\Tests\Coding
 */
class MethodBuilder extends \PHPUnit\Framework\TestCase {

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
        $this->obj = new \FightTheIce\Coding\MethodBuilder("methodname", "public", "long desc");
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