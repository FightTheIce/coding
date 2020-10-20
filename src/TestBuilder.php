<?php

namespace FightTheIce\Coding;

/**
 * TestBuilder
 *
 * This class is responsible interacting with Laminas\Code\Generator\ClassGenerator
 *
 * @namespace FightTheIce\Coding
 */
class TestBuilder {

    /**
     * class
     *
     * ClassBuilder Object
     *
     * @access protected
     */
    protected $class = '';

    /**
     * name
     *
     * Fully Qualified Class Name
     *
     * @access protected
     */
    protected $name = '';

    /**
     * shortName
     *
     * Short Name
     *
     * @access protected
     */
    protected $shortName = '';

    /**
     * test
     *
     * Test Generator
     *
     * @access protected
     */
    protected $test = null;

    /**
     * __construct
     *
     * Class Construct
     *
     * @access public
     * @param builder - The generated class builder
     */
    public function __construct(ClassBuilder $builder) {
        $this->class = $builder;
        $this->name  = $this->class->getGenerator()->getName();
        $ns          = $this->class->getGenerator()->getNamespaceName();
        if (!empty($ns)) {
            $this->name = $ns . '\\' . $this->name;
        }
        $this->shortName = $this->class->getGenerator()->getName();

        $x        = explode('\\', $this->name);
        $blah     = $x[0];
        $x[0]     = 'Tests';
        $testName = $blah . '\\' . implode('\\', $x);

        $this->test = new ClassBuilder($testName . '\\Test', $this->name, 'Testing of ' . $this->name);
        $this->test->classExtends('\PHPUnit\Framework\TestCase');
    }

    /**
     * getClass
     *
     * Get the property class
     *
     * @access public
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * getName
     *
     * Get the property name
     *
     * @access public
     */
    public function getName() {
        return $this->name;
    }

    /**
     * getShortname
     *
     * Get the property shortName
     *
     * @access public
     */
    public function getShortname() {
        return $this->shortName;
    }

    /**
     * getTest
     *
     * Get the property test
     *
     * @access public
     */
    public function getTest() {
        return $this->test;
    }

    /**
     * generate
     *
     * Generate
     *
     * @access public
     */
    public function generate() {
        //setup
        $method = $this->test->newMethod('setUp', 'protected', 'Setup the test');
        $method->setBody('$this->obj = new \\' . $this->name . '();');
        $method->getGenerator()->setReturnType('void');

        //teardown
        $method = $this->test->newMethod('tearDown', 'protected', 'Teardown the test');
        $method->getGenerator()->setReturnType('void');

        $this->test->newProperty('obj', null, 'protected', 'Class Obj', 'The class object');

        //lets get all the properties first
        $properties = $this->class->getProperties();

        if (count($properties) > 0) {
            foreach ($properties as $name => $obj) {
                $method = $this->test->newMethod('test_' . $this->shortName . '_hasAttribute_' . $name, 'public', 'Testing that class ' . $this->name . ' has an attribute of: ' . $name);

                $content = "this->assertClassHasAttribute('{attribute}',\{class}::class);";
                $content = str_replace('{attribute}', $name, $content);
                $content = str_replace('{class}', $this->name, $content);
                $method->setBody('$' . $content);
            }
        }

        //lets get all the methods
        $methods = $this->class->getMethods();

        if (count($methods) > 0) {
            foreach ($methods as $name => $obj) {
                $methodName = 'test_' . $this->shortName . '_hasMethod_' . $name;
                $method     = $this->test->newMethod($methodName, 'public', 'Testing that class ' . $this->name . ' has a method by the name of: ' . $name);

                $content = "this->assertTrue(method_exists(\$this->obj,'" . $name . "'));";
                $method->setBody('$' . $content);

                //does this method have parameters?
                print_r($obj);
                exit;
            }
        }

        return $this->test->generate();
    }

}
