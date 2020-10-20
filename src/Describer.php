<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\DocBlock\Tag\AuthorTag;
use Laminas\Code\Generator\DocBlock\Tag\GenericTag;
use Laminas\Code\Generator\DocBlock\Tag\LicenseTag;
use Laminas\Code\Generator\DocBlock\Tag\MethodTag;
use Laminas\Code\Generator\DocBlock\Tag\ParamTag;
use Laminas\Code\Generator\DocBlock\Tag\PropertyTag;
use Laminas\Code\Generator\DocBlock\Tag\ReturnTag;
use Laminas\Code\Generator\DocBlock\Tag\ThrowsTag;
use Laminas\Code\Generator\DocBlock\Tag\VarTag;

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
     * @param string $short A string containing the short description
     * @param string $long A string containing the long description
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
     * @param string $desc A string containg the short description
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
     * @param string $desc A string containing the long description
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
     * @param string $name Tag Name
     * @param string $value Tag Value
     */
    public function tag(string $name, string $value) {
        $tag = new GenericTag($name, $value);
        $this->generator->setTag($tag);

        return $this;
    }

    /**
     * genericTag
     *
     * DocBlock Tag Generator
     *
     * @access public
     * @param string $name Tag Name
     * @param string $value Tag Value
     */
    public function genericTag(string $name, string $value) {
        return $this->tag($name, $value);
    }

    /**
     * authorTag
     *
     * Author Tag Generator
     *
     * @access public
     * @param ?string $name A string containing the authors name
     * @param ?string $email A string containing the authors's email address
     */
    public function authorTag( ? string $name = null,  ? string $email = null) {
        $tag = new AuthorTag($name, $email);
        $this->generator->setTag($tag);

        return $this;
    }

    /**
     * licenseTag
     *
     * License Tag Generator
     *
     * @access public
     * @param ?string $url URL
     * @param ?string $name License Name
     */
    public function licenseTag( ? string $url = null,  ? string $name = null) {
        $tag = new LicenseTag($url, $licenseName);
        $this->generator->setTag($tag);

        return $this;
    }

    /**
     * methodTag
     *
     * Method Tag Generator
     *
     * @access public
     * @param ?string $name Method Name
     * @param $types Method Types
     * @param $description Method Description
     * @param $isStatic Is Method Static?
     */
    public function methodTag( ? string $name = null, $types = [], $description = null, $isStatic = false) {
        $tag = new MethodTag($name, $types, $description, $isStatic);
        $this->generator->setTag($tag);

        return $this;
    }

    /**
     * paramTag
     *
     * Param Tag Generator
     *
     * @access public
     * @param string $name Param Name
     * @param $types Param Types
     * @param $description Param Description
     */
    public function paramTag(string $name, $types = [], $description = null) {
        $tag = new ParamTag($name, $types, $description);
        $this->generator->setTag($tag);

        return $this;
    }

    /**
     * propertyTag
     *
     * Property Tag Generator
     *
     * @access public
     * @param string $name Property name
     * @param $types Property types
     * @param $description Property description
     */
    public function propertyTag(string $name, $types = [], $description = null) {
        $tag = new PropertyTag($name, $types, $description);
        $this->generator->setTag($tag);

        return $this;
    }

    /**
     * returnTag
     *
     * Return Tag Generator
     *
     * @access public
     * @param $types Return Types
     * @param $description Return Description
     */
    public function returnTag($types = [], $description = null) {
        $tag = new ReturnTag($types, $description);
        $this->generator->setTag($tag);

        return $this;
    }

    /**
     * throwsTag
     *
     * Throws Tag Generator
     *
     * @access public
     * @param $types Throws Types
     * @param $description Throws Description
     */
    public function throwsTag($types = [], $description = null) {
        $tag = new ThrowsTag($types, $description);
        $this->generator->setTag($tag);

        return $this;
    }

    /**
     * varTag
     *
     * Var Tag Generator
     *
     * @access public
     * @param string $name Var Name
     * @param $types Var Types
     * @param $description Var Description
     */
    public function varTag(string $name, $types = [], $description = null) {
        $tag = new VarTag($name, $types, $description);
        $this->generator->setTag($tag);

        return $this;
    }

}
