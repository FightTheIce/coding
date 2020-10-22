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
     * @property NULL $class ClassBuilder Object
     */
    protected $class = null;

    /**
     * name
     *
     * Fully Qualified Class Name
     *
     * @access protected
     * @property NULL $name Fully Qualified Class Name
     */
    protected $name = null;

    /**
     * shortName
     *
     * Short Name
     *
     * @access protected
     * @property NULL $shortName Short Name
     */
    protected $shortName = null;

    /**
     * test
     *
     * Test Generator
     *
     * @access protected
     * @property NULL $test Test Generator
     */
    protected $test = null;

    /**
     * __construct
     *
     * Class Construct
     *
     * @access public
     * @method __construct() Class Construct
     * @param FightTheIce\Coding\ClassBuilder $builder The generated class builder
     */
    public function __construct(\FightTheIce\Coding\ClassBuilder $builder) {
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
     * @method getClass() Get the property class
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
     * @method getName() Get the property name
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
     * @method getShortname() Get the property shortName
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
     * @method getTest() Get the property test
     */
    public function getTest() {
        return $this->test;
    }

    /**
     * generate
     *
     * Generate the test suite
     *
     * @access public
     * @method generate() Generate the test suite
     */
    public function generate() {
        $method = $this->test->newMethod('setUp', 'protected', 'Setup the test');
        if (!empty($this->setup)) {
            $method->setBody($this->setup);
        } else {
            //setup

            $method->setBody('$this->obj = new \\' . $this->name . '();');
        }
        $method->getGenerator()->setReturnType('void');

        /*
        //teardown
        $method = $this->test->newMethod('tearDown', 'protected', 'Teardown the test');
        $method->getGenerator()->setReturnType('void');
         */

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
                if ($obj->getGenerator()->getVisibility() != 'public') {
                    continue;
                }

                $methodName = 'test_' . $this->shortName . '_hasMethod_' . $name;
                $method     = $this->test->newMethod($methodName, 'public', 'Testing that class ' . $this->name . ' has a method by the name of: ' . $name);

                $content = "this->assertTrue(method_exists(\$this->obj,'" . $name . "'));";
                $method->setBody('$' . $content);

                //does this method have parameters?
                $parameters  = $obj->getGenerator()->getParameters();
                $countParams = count($parameters);
                if ($countParams > 0) {
                    $requiredParams = false;
                    foreach ($parameters as $param) {
                        if ($param->hasDefaultValue() == true) {
                            $requiredParams = true;
                            break;
                        }
                    }

                    if ($requiredParams == true) {
                        //lets generate a test method with no parameters sent
                        $methodName = 'test_' . $this->shortName . '_' . $name . '_noparams';
                        $method     = $this->test->newMethod($methodName, 'public', 'Testing method ' . $name . ' with no params');

                        $content = '$this->expectException(\ArgumentCountError::class);' . PHP_EOL;
                        if ($name == '__construct') {
                            $content = $content . '$test = new \\' . $this->name . '();';
                        } else {
                            $content = $content . '$test = $this->obj->' . $name . '();';
                        }

                        $method->setBody($content);
                    }
                }
            }
        }

        return $this->test->generate();
    }

    /**
     * buildSetup
     *
     * Builds the Test setUp method
     *
     * @access public
     * @method buildSetup() Builds the Test setUp method
     * @param string $setup Setup methodlogy
     */
    public function buildSetup(string $setup) {
        $this->setup = $setup;
    }

}
