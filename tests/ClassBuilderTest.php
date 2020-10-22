<?php

namespace FightTheIce\Tests\Coding\ClassResolver;

/**
 * FightTheIce\Coding\ClassResolver
 *
 * Testing of FightTheIce\Coding\ClassResolver
 *
 * @namespace FightTheIce\Tests\Coding\ClassResolver
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
        $this->obj = new \FightTheIce\Coding\ClassResolver("FightTheIce\Coding\ClassResolver");
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
     * test_ClassResolver_hasAttribute_reflection
     *
     * Testing that class FightTheIce\Coding\ClassResolver has an attribute of:
     * reflection
     *
     * @access public
     * @method test_ClassResolver_hasAttribute_reflection() Testing that class
     * FightTheIce\Coding\ClassResolver has an attribute of: reflection
     */
    public function test_ClassResolver_hasAttribute_reflection() {
        $this->assertClassHasAttribute('reflection', \FightTheIce\Coding\ClassResolver::class);
    }

    /**
     * test_ClassResolver_hasAttribute_objNonConstruct
     *
     * Testing that class FightTheIce\Coding\ClassResolver has an attribute of:
     * objNonConstruct
     *
     * @access public
     * @method test_ClassResolver_hasAttribute_objNonConstruct() Testing that class
     * FightTheIce\Coding\ClassResolver has an attribute of: objNonConstruct
     */
    public function test_ClassResolver_hasAttribute_objNonConstruct() {
        $this->assertClassHasAttribute('objNonConstruct', \FightTheIce\Coding\ClassResolver::class);
    }

    /**
     * test_ClassResolver_hasAttribute_builder
     *
     * Testing that class FightTheIce\Coding\ClassResolver has an attribute of: builder
     *
     * @access public
     * @method test_ClassResolver_hasAttribute_builder() Testing that class
     * FightTheIce\Coding\ClassResolver has an attribute of: builder
     */
    public function test_ClassResolver_hasAttribute_builder() {
        $this->assertClassHasAttribute('builder', \FightTheIce\Coding\ClassResolver::class);
    }

    /**
     * test_ClassResolver_hasMethod___construct
     *
     * Testing that class FightTheIce\Coding\ClassResolver has a method by the name of:
     * __construct
     *
     * @access public
     * @method test_ClassResolver_hasMethod___construct() Testing that class
     * FightTheIce\Coding\ClassResolver has a method by the name of: __construct
     */
    public function test_ClassResolver_hasMethod___construct() {
        $this->assertTrue(method_exists($this->obj, '__construct'));
    }

    /**
     * test_ClassResolver___construct_noparams
     *
     * Testing method __construct with no params
     *
     * @access public
     * @method test_ClassResolver___construct_noparams() Testing method __construct
     * with no params
     */
    public function test_ClassResolver___construct_noparams() {
        $this->expectException(\ArgumentCountError::class);
        $test = new \FightTheIce\Coding\ClassResolver();
    }

    /**
     * test_ClassResolver_hasMethod_classMeta
     *
     * Testing that class FightTheIce\Coding\ClassResolver has a method by the name of:
     * classMeta
     *
     * @access public
     * @method test_ClassResolver_hasMethod_classMeta() Testing that class
     * FightTheIce\Coding\ClassResolver has a method by the name of: classMeta
     */
    public function test_ClassResolver_hasMethod_classMeta() {
        $this->assertTrue(method_exists($this->obj, 'classMeta'));
    }

    /**
     * test_ClassResolver_hasMethod_propertiesMeta
     *
     * Testing that class FightTheIce\Coding\ClassResolver has a method by the name of:
     * propertiesMeta
     *
     * @access public
     * @method test_ClassResolver_hasMethod_propertiesMeta() Testing that class
     * FightTheIce\Coding\ClassResolver has a method by the name of: propertiesMeta
     */
    public function test_ClassResolver_hasMethod_propertiesMeta() {
        $this->assertTrue(method_exists($this->obj, 'propertiesMeta'));
    }

    /**
     * test_ClassResolver_hasMethod_methodsMeta
     *
     * Testing that class FightTheIce\Coding\ClassResolver has a method by the name of:
     * methodsMeta
     *
     * @access public
     * @method test_ClassResolver_hasMethod_methodsMeta() Testing that class
     * FightTheIce\Coding\ClassResolver has a method by the name of: methodsMeta
     */
    public function test_ClassResolver_hasMethod_methodsMeta() {
        $this->assertTrue(method_exists($this->obj, 'methodsMeta'));
    }

    /**
     * test_ClassResolver_hasMethod_build
     *
     * Testing that class FightTheIce\Coding\ClassResolver has a method by the name of:
     * build
     *
     * @access public
     * @method test_ClassResolver_hasMethod_build() Testing that class
     * FightTheIce\Coding\ClassResolver has a method by the name of: build
     */
    public function test_ClassResolver_hasMethod_build() {
        $this->assertTrue(method_exists($this->obj, 'build'));
    }

}
