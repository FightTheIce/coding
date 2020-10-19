<?php

namespace FightTheIce\Tests\Coding;

/**
 * FightTheIce\Coding\PropertyBuilder
 *
 * Testing of FightTheIce\Coding\PropertyBuilder
 *
 * @namespace FightTheIce\Tests\Coding
 */
class PropertyBuilder extends \PHPUnit\Framework\TestCase {

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
        $this->obj = new \FightTheIce\Coding\PropertyBuilder("property", '', 'protected', 'long desc');
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