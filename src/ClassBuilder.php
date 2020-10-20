<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\ClassGenerator;

/**
 * ClassBuilder
 *
 * This class is responsible interacting with Laminas\Code\Generator\ClassGenerator
 *
 * @namespace FightTheIce\Coding
 */
class ClassBuilder
{

    /**
     * generator
     *
     * Generator Object
     *
     * @access protected
     */
    protected $generator = null;

    /**
     * describer
     *
     * Describer Object
     *
     * @access protected
     */
    protected $describer = null;

    /**
     * properties
     *
     * Properties to generate
     *
     * @access protected
     */
    protected $properties = [

    ];

    /**
     * methods
     *
     * Methods to generate
     *
     * @access protected
     */
    protected $methods = [

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
    public function __construct(string $name, string $short, string $long)
    {
        $this->generator = new ClassGenerator();
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
     */
    public function getGenerator()
    {
        return $this->generator;
    }

    /**
     * getDescriber
     *
     * Get the property describer
     *
     * @access public
     */
    public function getDescriber()
    {
        return $this->describer;
    }

    /**
     * getProperties
     *
     * Get the property properties
     *
     * @access public
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * getMethods
     *
     * Get the property methods
     *
     * @access public
     */
    public function getMethods()
    {
        return $this->methods;
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
    public function addClassTag(string $name, string $value)
    {
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
     * @param getMethod - Should we generate a getProperty method
     */
    public function newProperty(string $name, $dv, string $access, string $long, bool $getMethod = false)
    {
        if (isset($this->properties[$name])) {
            throw new \ErrorException('This property already exists!');
        }

        $this->properties[$name] = new PropertyBuilder($name, $dv, $access, $long);

        if ($getMethod == true) {
            $getName = ucfirst(strtolower(trim($name)));
            $method  = $this->newMethod('get' . $getName, 'public', 'Get the property ' . $name);
            $method->setBody('return $this->' . $name . ';');
        }

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
    public function newMethod(string $name, string $access, string $long)
    {
        if (isset($this->methods[$name])) {
            throw new \ErrorException('The method already exists! [' . $name . ']');
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
    public function uses(string $name, ? string $alias = null)
    {
        $this->generator->addUse($name, $alias);

        return $this;
    }

    /**
     * classExtends
     *
     * Should this class extend an existing one
     *
     * @access public
     * @param name - Name of parent class
     */
    public function classExtends(string $name)
    {
        $this->generator->setExtendedClass($name);

        return $this;
    }

    /**
     * generate
     *
     * Generate the class data
     *
     * @access public
     */
    public function generate()
    {
        $this->generator->setDocBlock($this->describer->getGenerator());

        //does a _construct method exists?
        //if it does we always want this to be the first method
        if (isset($this->methods['__construct'])) {
            $this->generator->addMethodFromGenerator($this->methods['__construct']->getGenerator());
            // unset($this->methods['__construct']);
        }

        foreach ($this->properties as $name => $obj) {
            $this->generator->addPropertyFromGenerator($obj->getGenerator());
        }

        foreach ($this->methods as $name => $obj) {
            if ($name == '__construct') {
                continue;
            }
            $this->generator->addMethodFromGenerator($obj->getGenerator());
        }

        return $this->generator->generate();
    }

    /**
     * getMethod
     *
     * Returns a method object by name
     *
     * @access public
     * @param name - Name of method
     */
    public function getMethod(string $name)
    {
        if (!isset($this->methods[$name])) {
            throw new \ErrorException('The method: [' . $name . '] does not exists!');
        }

        return $this->methods[$name];
    }

    /**
     * getProperty
     *
     * Returns a property object by name
     *
     * @access public
     * @param name - Name of method
     */
    public function getProperty(string $name)
    {
        if (!isset($this->properties[$name])) {
            throw new \ErrorException('The method: [' . $name . '] does not exists!');
        }

        return $this->properties[$name];
    }
}
