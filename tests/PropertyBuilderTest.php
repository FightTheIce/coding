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
        $this->obj = new \FightTheIce\Coding\PropertyBuilder("property", "", "protected", "long");
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
     * test_PropertyBuilder_hasAttribute_generator
     *
     * Testing that class FightTheIce\Coding\PropertyBuilder has an attribute of:
     * generator
     *
     * @access public
     * @method test_PropertyBuilder_hasAttribute_generator() Testing that class
     * FightTheIce\Coding\PropertyBuilder has an attribute of: generator
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
     * @method test_PropertyBuilder_hasAttribute_describer() Testing that class
     * FightTheIce\Coding\PropertyBuilder has an attribute of: describer
     */
    public function test_PropertyBuilder_hasAttribute_describer() {
        $this->assertClassHasAttribute('describer', \FightTheIce\Coding\PropertyBuilder::class);
    }

    /**
     * test_PropertyBuilder_hasMethod___construct
     *
     * Testing that class FightTheIce\Coding\PropertyBuilder has a method by the name
     * of: __construct
     *
     * @access public
     * @method test_PropertyBuilder_hasMethod___construct() Testing that class
     * FightTheIce\Coding\PropertyBuilder has a method by the name of: __construct
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
     * @method test_PropertyBuilder___construct_noparams() Testing method __construct
     * with no params
     */
    public function test_PropertyBuilder___construct_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = new \FightTheIce\Coding\PropertyBuilder();
    }

    /**
     * test_PropertyBuilder_hasMethod_getDescriber
     *
     * Testing that class FightTheIce\Coding\PropertyBuilder has a method by the name
     * of: getDescriber
     *
     * @access public
     * @method test_PropertyBuilder_hasMethod_getDescriber() Testing that class
     * FightTheIce\Coding\PropertyBuilder has a method by the name of: getDescriber
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
     * @method test_PropertyBuilder_hasMethod_getGenerator() Testing that class
     * FightTheIce\Coding\PropertyBuilder has a method by the name of: getGenerator
     */
    public function test_PropertyBuilder_hasMethod_getGenerator() {
        $this->assertTrue(method_exists($this->obj, 'getGenerator'));
    }

}
