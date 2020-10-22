<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\TraitGenerator;

/**
 * TraitBuilder
 *
 * This class is responsible interacting with Laminas\Code\Generator\TraitGenerator
 *
 * @namespace FightTheIce\Coding
 */
class TraitBuilder {

    /**
     * generator
     *
     * Generator Object
     *
     * @access protected
     * @property NULL $generator Generator Object
     */
    protected $generator = null;

    /**
     * describer
     *
     * Describer Object
     *
     * @access protected
     * @property NULL $describer Describer Object
     */
    protected $describer = null;

    /**
     * properties
     *
     * Properties to generate
     *
     * @access protected
     * @property NULL $properties Properties to generate
     */
    protected $properties = null;

    /**
     * methods
     *
     * Methods to generate
     *
     * @access protected
     * @property NULL $methods Methods to generate
     */
    protected $methods = null;

    /**
     * __construct
     *
     * Class Construct
     *
     * @access public
     * @method __construct() Class Construct
     * @param string $name A string containg the class name
     * @param string $short A string containing the short description of the class
     * @param string $long A string containing the long description of the class
     */
    public function __construct(string $name, string $short, string $long) {
        $this->generator = new TraitGenerator();
        $this->describer = new Describer($short, $long);

        $x = explode('\\', $name);
        if (count($x) > 1) {
            $blah = array_pop($x);
            $ns   = implode('\\', $x);
            $this->describer->tag('namespace', $ns);
        }

        $this->generator->setName($name);
    }

    /**
     * getGenerator
     *
     * Get the property generator
     *
     * @access public
     * @method getGenerator() Get the property generator
     */
    public function getGenerator() {
        return $this->generator;
    }

    /**
     * getDescriber
     *
     * Get the property describer
     *
     * @access public
     * @method getDescriber() Get the property describer
     */
    public function getDescriber() {
        return $this->describer;
    }

    /**
     * getProperties
     *
     * Get the property properties
     *
     * @access public
     * @method getProperties() Get the property properties
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * getMethods
     *
     * Get the property methods
     *
     * @access public
     * @method getMethods() Get the property methods
     */
    public function getMethods() {
        return $this->methods;
    }

    /**
     * addClassTag
     *
     * Add a tag to the class docblock
     *
     * @access public
     * @method addClassTag() Add a tag to the class docblock
     * @param string $name A string containing the name of the docblock tag
     * @param string $value A string containing the value of the docblock tag
     */
    public function addClassTag(string $name, string $value) {
        $this->describer->tag($name, $value);

        return $this;
    }

    /**
     * newProperty
     *
     * Add a new property to the class
     *
     * @access public
     * @method newProperty() Add a new property to the class
     * @param string $name Name of property
     * @param mixed $dv default value of property
     * @param string $access access level
     * @param string $long Long Description of property
     */
    public function newProperty(string $name, $dv, string $access, string $long) {
        if (isset($this->properties[$name])) {
            throw new \ErrorException('This property already exists!');
        }

        $this->properties[$name] = new PropertyBuilder($name, $dv, $access, $long);

        return $this;
    }

    /**
     * newMethod
     *
     * Generate a new method
     *
     * @access public
     * @method newMethod() Generate a new method
     * @param string $name Name of method
     * @param string $access access level
     * @param string $long long description
     */
    public function newMethod(string $name, string $access, string $long) {
        if (isset($this->methods[$name])) {
            throw new \ErrorException('The method already exists!');
        }

        $this->methods[$name] = new MethodBuilder($name, $access, $long);

        return $this->methods[$name];
    }

    /**
     * uses
     *
     * Add a use statement
     *
     * @access public
     * @method uses() Add a use statement
     * @param string $name Name of class
     * @param string $alias Alias
     */
    public function uses(string $name, string $alias = null) {
        $this->generator->addUse($name, $alias);

        return $this;
    }

    /**
     * generate
     *
     * Compile data
     *
     * @access public
     * @method generate() Compile data
     */
    public function generate() {
        foreach ($this->properties as $name => $obj) {
            $this->generator->addPropertyFromGenerator($obj->getGenerator());
        }

        foreach ($this->methods as $name => $obj) {
            $this->generator->addMethodFromGenerator($obj->getGenerator());
        }

        return $this->generator->generate();
    }

}
