<?php

namespace FightTheIce\Tests\Coding\Describer;

/**
 * FightTheIce\Coding\Describer
 *
 * Testing of FightTheIce\Coding\Describer
 *
 * @namespace FightTheIce\Tests\Coding\Describer
 */
class Test extends \PHPUnit\Framework\TestCase
{

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
    protected function setUp(): void
    {
        $this->obj = new \FightTheIce\Coding\Describer("short", "long");
    }

    /**
     * getObj
     *
     * Get the property obj
     *
     * @access public
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * test_Describer_hasAttribute_generator
     *
     * Testing that class FightTheIce\Coding\Describer has an attribute of: generator
     *
     * @access public
     */
    public function test_Describer_hasAttribute_generator()
    {
        $this->assertClassHasAttribute('generator', \FightTheIce\Coding\Describer::class);
    }

    /**
     * test_Describer_hasMethod_getGenerator
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * getGenerator
     *
     * @access public
     */
    public function test_Describer_hasMethod_getGenerator()
    {
        $this->assertTrue(method_exists($this->obj, 'getGenerator'));
    }

    /**
     * test_Describer_hasMethod___construct
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * __construct
     *
     * @access public
     */
    public function test_Describer_hasMethod___construct()
    {
        $this->assertTrue(method_exists($this->obj, '__construct'));
    }

    /**
     * test_Describer_hasMethod_short
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * short
     *
     * @access public
     */
    public function test_Describer_hasMethod_short()
    {
        $this->assertTrue(method_exists($this->obj, 'short'));
    }

    /**
     * test_Describer_short_noparams
     *
     * Testing method short with no params
     *
     * @access public
     */
    public function test_Describer_short_noparams()
    {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->short();
    }

    /**
     * test_Describer_hasMethod_long
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * long
     *
     * @access public
     */
    public function test_Describer_hasMethod_long()
    {
        $this->assertTrue(method_exists($this->obj, 'long'));
    }

    /**
     * test_Describer_long_noparams
     *
     * Testing method long with no params
     *
     * @access public
     */
    public function test_Describer_long_noparams()
    {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->long();
    }

    /**
     * test_Describer_hasMethod_tag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of: tag
     *
     * @access public
     */
    public function test_Describer_hasMethod_tag()
    {
        $this->assertTrue(method_exists($this->obj, 'tag'));
    }

    /**
     * test_Describer_tag_noparams
     *
     * Testing method tag with no params
     *
     * @access public
     */
    public function test_Describer_tag_noparams()
    {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->tag();
    }
}
