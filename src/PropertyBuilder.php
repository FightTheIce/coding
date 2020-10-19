<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\PropertyGenerator;

class PropertyBuilder {

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
