<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\PropertyGenerator;

/**
 * PropertyBuilder
 *
 * This class is responsible for generating properties
 *
 * @namespace FightTheIce\Coding
 */
class PropertyBuilder {

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
     * __construct
     *
     * Class Construct
     *
     * @access public
     * @param name - A string containing the method name
     * @param dv - The data type for this parameter
     * @param access - Access level
     * @param long - Long Description
     */
    public function __construct(string $name, $dv, string $access, string $long) {
        $this->generator = new PropertyGenerator();
        $this->generator->setName($name);
        $this->generator->setDefaultValue($dv);

        $this->describer = new Describer($name, $long);
        $this->describer->tag('access', $access);
    }

    /**
     * getGenerator
     *
     * Returns the generator object
     *
     * @access public
     */
    public function getGenerator() {
        $this->generator->setDocBlock($this->describer->getGenerator());

        return $this->generator;
    }

}
