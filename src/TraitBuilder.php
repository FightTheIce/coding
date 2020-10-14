<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\TraitGenerator;

/**
 * ClassBuilder
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
     */
    public $generator = null;

    /**
     * describer
     *
     * Describer Object
     *
     * @access protected
     */
    public $describer = null;

    /**
     * properties
     *
     * Properties to generate
     *
     * @access protected
     */
    public $properties = [

    ];

    /**
     * methods
     *
     * Methods to generate
     *
     * @access protected
     */
    public $methods = [

    ];

    /**
     * __construct
     *
     * Class Construct
     *
     * @access public
     * @param name - A string containg the class name
     * @param short - A string containing the short description of the class
     * @param long - A string containing the long description of the class
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
     * addClassTag
     *
     * Add a tag to the class docblock
     *
     * @access public
     * @param name - A string containing the name of the docblock tag
     * @param value - A string containing the value of the docblock tag
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
     * @param name - Name of property
     * @param dv - default value of property
     * @param access - access level
     * @param long - Long Description of property
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
     * @param name - Name of method
     * @param access - access level
     * @param long - long description
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
     * @param name - Name of class
     * @param alias - Alias
     */
    public function uses(string $name,  ? string $alias = null) {
        $this->generator->addUse($name, $alias);

        return $this;
    }

    /**
     * compile
     *
     * Compile data
     *
     * @access public
     */
    public function compile() {
        foreach ($this->properties as $name => $obj) {
            $this->generator->addPropertyFromGenerator($obj->getGenerator());
        }

        foreach ($this->methods as $name => $obj) {
            $this->generator->addMethodFromGenerator($obj->getGenerator());
        }

        return $this;
    }

    /**
     * getGenerator
     *
     * Returns the class generator
     *
     * @access public
     */
    public function getGenerator() {
        $this->generator->setDocBlock($this->describer->getGenerator());

        return $this->generator;
    }

}
