<?php

namespace FightTheIce\Tests\Coding\Describer;

/**
 * FightTheIce\Coding\Describer
 *
 * Testing of FightTheIce\Coding\Describer
 *
 * @namespace FightTheIce\Tests\Coding\Describer
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
        $this->obj = new \FightTheIce\Coding\Describer("short", "long");
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
     * test_Describer_hasAttribute_generator
     *
     * Testing that class FightTheIce\Coding\Describer has an attribute of: generator
     *
     * @access public
     * @method test_Describer_hasAttribute_generator() Testing that class
     * FightTheIce\Coding\Describer has an attribute of: generator
     */
    public function test_Describer_hasAttribute_generator() {
        $this->assertClassHasAttribute('generator', \FightTheIce\Coding\Describer::class);
    }

    /**
     * test_Describer_hasMethod___construct
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * __construct
     *
     * @access public
     * @method test_Describer_hasMethod___construct() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: __construct
     */
    public function test_Describer_hasMethod___construct() {
        $this->assertTrue(method_exists($this->obj, '__construct'));
    }

    /**
     * test_Describer_hasMethod_getGenerator
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * getGenerator
     *
     * @access public
     * @method test_Describer_hasMethod_getGenerator() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: getGenerator
     */
    public function test_Describer_hasMethod_getGenerator() {
        $this->assertTrue(method_exists($this->obj, 'getGenerator'));
    }

    /**
     * test_Describer_hasMethod_short
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * short
     *
     * @access public
     * @method test_Describer_hasMethod_short() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: short
     */
    public function test_Describer_hasMethod_short() {
        $this->assertTrue(method_exists($this->obj, 'short'));
    }

    /**
     * test_Describer_short_noparams
     *
     * Testing method short with no params
     *
     * @access public
     * @method test_Describer_short_noparams() Testing method short with no params
     */
    public function test_Describer_short_noparams() {
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
     * @method test_Describer_hasMethod_long() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: long
     */
    public function test_Describer_hasMethod_long() {
        $this->assertTrue(method_exists($this->obj, 'long'));
    }

    /**
     * test_Describer_long_noparams
     *
     * Testing method long with no params
     *
     * @access public
     * @method test_Describer_long_noparams() Testing method long with no params
     */
    public function test_Describer_long_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->long();
    }

    /**
     * test_Describer_hasMethod_tag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of: tag
     *
     * @access public
     * @method test_Describer_hasMethod_tag() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: tag
     */
    public function test_Describer_hasMethod_tag() {
        $this->assertTrue(method_exists($this->obj, 'tag'));
    }

    /**
     * test_Describer_tag_noparams
     *
     * Testing method tag with no params
     *
     * @access public
     * @method test_Describer_tag_noparams() Testing method tag with no params
     */
    public function test_Describer_tag_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->tag();
    }

    /**
     * test_Describer_hasMethod_genericTag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * genericTag
     *
     * @access public
     * @method test_Describer_hasMethod_genericTag() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: genericTag
     */
    public function test_Describer_hasMethod_genericTag() {
        $this->assertTrue(method_exists($this->obj, 'genericTag'));
    }

    /**
     * test_Describer_genericTag_noparams
     *
     * Testing method genericTag with no params
     *
     * @access public
     * @method test_Describer_genericTag_noparams() Testing method genericTag with no
     * params
     */
    public function test_Describer_genericTag_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->genericTag();
    }

    /**
     * test_Describer_hasMethod_authorTag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * authorTag
     *
     * @access public
     * @method test_Describer_hasMethod_authorTag() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: authorTag
     */
    public function test_Describer_hasMethod_authorTag() {
        $this->assertTrue(method_exists($this->obj, 'authorTag'));
    }

    /**
     * test_Describer_hasMethod_licenseTag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * licenseTag
     *
     * @access public
     * @method test_Describer_hasMethod_licenseTag() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: licenseTag
     */
    public function test_Describer_hasMethod_licenseTag() {
        $this->assertTrue(method_exists($this->obj, 'licenseTag'));
    }

    /**
     * test_Describer_hasMethod_methodTag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * methodTag
     *
     * @access public
     * @method test_Describer_hasMethod_methodTag() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: methodTag
     */
    public function test_Describer_hasMethod_methodTag() {
        $this->assertTrue(method_exists($this->obj, 'methodTag'));
    }

    /**
     * test_Describer_hasMethod_paramTag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * paramTag
     *
     * @access public
     * @method test_Describer_hasMethod_paramTag() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: paramTag
     */
    public function test_Describer_hasMethod_paramTag() {
        $this->assertTrue(method_exists($this->obj, 'paramTag'));
    }

    /**
     * test_Describer_paramTag_noparams
     *
     * Testing method paramTag with no params
     *
     * @access public
     * @method test_Describer_paramTag_noparams() Testing method paramTag with no
     * params
     */
    public function test_Describer_paramTag_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->paramTag();
    }

    /**
     * test_Describer_hasMethod_propertyTag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * propertyTag
     *
     * @access public
     * @method test_Describer_hasMethod_propertyTag() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: propertyTag
     */
    public function test_Describer_hasMethod_propertyTag() {
        $this->assertTrue(method_exists($this->obj, 'propertyTag'));
    }

    /**
     * test_Describer_propertyTag_noparams
     *
     * Testing method propertyTag with no params
     *
     * @access public
     * @method test_Describer_propertyTag_noparams() Testing method propertyTag with no
     * params
     */
    public function test_Describer_propertyTag_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->propertyTag();
    }

    /**
     * test_Describer_hasMethod_returnTag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * returnTag
     *
     * @access public
     * @method test_Describer_hasMethod_returnTag() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: returnTag
     */
    public function test_Describer_hasMethod_returnTag() {
        $this->assertTrue(method_exists($this->obj, 'returnTag'));
    }

    /**
     * test_Describer_hasMethod_throwsTag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * throwsTag
     *
     * @access public
     * @method test_Describer_hasMethod_throwsTag() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: throwsTag
     */
    public function test_Describer_hasMethod_throwsTag() {
        $this->assertTrue(method_exists($this->obj, 'throwsTag'));
    }

    /**
     * test_Describer_hasMethod_varTag
     *
     * Testing that class FightTheIce\Coding\Describer has a method by the name of:
     * varTag
     *
     * @access public
     * @method test_Describer_hasMethod_varTag() Testing that class
     * FightTheIce\Coding\Describer has a method by the name of: varTag
     */
    public function test_Describer_hasMethod_varTag() {
        $this->assertTrue(method_exists($this->obj, 'varTag'));
    }

    /**
     * test_Describer_varTag_noparams
     *
     * Testing method varTag with no params
     *
     * @access public
     * @method test_Describer_varTag_noparams() Testing method varTag with no params
     */
    public function test_Describer_varTag_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = $this->obj->varTag();
    }

}
