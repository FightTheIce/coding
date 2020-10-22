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
     * __construct
     *
     * Class Construct
     *
     * @access public
     * @method __construct() Class Construct
     * @param string $name A string containing the method name
     * @param mixed $dv The data type for this parameter
     * @param string $access Access level
     * @param string $long Long Description
     */
    public function __construct(string $name, $dv, string $access, string $long) {
        $this->generator = new PropertyGenerator();
        $this->generator->setName($name);
        $this->generator->setDefaultValue($dv);

        $this->describer = new Describer($name, $long);
        $this->describer->tag('access', $access);

        $this->describer->propertyTag($name, gettype($dv), $long);

        $access = trim(strtoupper($access));
        switch ($access) {
        case 'PROTECTED':
            $this->generator->setVisibility(PropertyGenerator::VISIBILITY_PROTECTED);
            break;

        case 'PRIVATE':
            $this->generator->setVisibility(PropertyGenerator::VISIBILITY_PRIVATE);
            break;

        case 'PUBLIC':
            $this->generator->setVisibility(PropertyGenerator::VISIBILITY_PUBLIC);
            break;

        default:
            throw new \ErrorException('Access type: [' . $access . '] is invalid!');
        }
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
     * getGenerator
     *
     * Returns the class generator
     *
     * @access public
     * @method getGenerator() Returns the class generator
     */
    public function getGenerator() {
        $this->generator->setDocBlock($this->describer->getGenerator());

        return $this->generator;
    }

}
