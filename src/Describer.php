<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\DocBlock\Tag\GenericTag;

/**
 * Describer
 *
 * This class is responsible for interacting with the Laminas docblock generator.
 *
 * @namespace FightTheIce\Coding
 * @author William Knauss
 */
class Describer {

    /**
     * generator
     *
     * The generator object - Laminas\Code\Generator\DocBlockGenerator
     *
     * @access protected
     */
    protected $generator = null;

    /**
     * __construct
     *
     * Class Construct
     *
     * @access public
     * @param short - A string containing the short description
     * @param long - A string containing the long description
     */
    public function __construct(string $short = '', string $long = '') {
        $this->generator = new DocBlockGenerator();

        if (!empty($short)) {
            $this->short($short);
        }

        if (!empty($long)) {
            $this->long($long);
        }
    }

    /**
     * getGenerator
     *
     * Get the property generator
     *
     * @access public
     */
    public function getGenerator() {
        return $this->generator;
    }

    /**
     * short
     *
     * DocBlock short description
     *
     * @access public
     * @param desc - A string containg the short description
     */
    public function short(string $desc) {
        $this->generator->setShortDescription($desc);

        return $this;
    }

    /**
     * long
     *
     * DocBlock long description
     *
     * @access public
     * @param desc - A string containing the long description
     */
    public function long(string $desc) {
        $this->generator->setLongDescription($desc);

        return $this;
    }

    /**
     * tag
     *
     * DocBlock Tag Generator
     *
     * @access public
     * @param name - Tag Name
     * @param value - Tag Value
     */
    public function tag(string $name, string $value) {
        $tag = new GenericTag($name, $value);
        $this->generator->setTag($tag);

        return $this;
    }

}
