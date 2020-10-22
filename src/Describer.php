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
     * @property NULL $generator The generator object -
     * Laminas\Code\Generator\DocBlockGenerator
     */
    protected $generator = null;

    /**
     * __construct
     *
     * Class Construct
     *
     * @access public
     * @method __construct() Class Construct
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
     * @method getGenerator() Get the property generator
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
     * @method short() DocBlock short description
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
     * @method long() DocBlock long description
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
     * @method tag() DocBlock Tag Generator
     * @param string $name Tag Name
     * @param string $value Tag Value
     */
    public function tag(string $name, string $value) {
        if (!isset($this->tags[$name])) {
            $this->tags[$name] = new GenericTag($name, $value);

            $this->generator->setTag($this->tags[$name]);
        }

        return $this;
    }

    /**
     * genericTag
     *
     * DocBlock Tag Generator
     *
     * @access public
     * @method genericTag() DocBlock Tag Generator
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
     * @method authorTag() Author Tag Generator
     * @param string $name A string containing the authors name
     * @param string $email A string containing the authors's email address
     */
    public function authorTag(string $name = null, string $email = null) {
        if (!isset($this->tags['author'])) {
            $this->tags['author'] = new AuthorTag($name, $email);

            $this->generator->setTag($this->tags['author']);
        }

        return $this;
    }

    /**
     * licenseTag
     *
     * License Tag Generator
     *
     * @access public
     * @method licenseTag() License Tag Generator
     * @param string $url URL
     * @param string $licenseName
     */
    public function licenseTag(string $url = null, string $licenseName = null) {
        if (!isset($this->tags['license'])) {
            $this->tags['license'] = new LicenseTag($url, $licenseName);

            $this->generator->setTag($this->tags['license']);
        }

        return $this;
    }

    /**
     * methodTag
     *
     * Method Tag Generator
     *
     * @access public
     * @method methodTag() Method Tag Generator
     * @param string $name Method Name
     * @param $types
     * @param $description
     * @param $isStatic
     */
    public function methodTag(string $name = null, $types = [], $description = null, $isStatic = false) {
        if (!isset($this->tags['method'])) {
            $this->tags['method'] = new MethodTag($name, $types, $description, $isStatic);

            $this->generator->setTag($this->tags['method']);
        }

        return $this;
    }

    /**
     * paramTag
     *
     * Param Tag Generator
     *
     * @access public
     * @method paramTag() Param Tag Generator
     * @param string $name Param Name
     * @param $types
     * @param $description
     */
    public function paramTag(string $name, $types = [], $description = null) {
        if (!isset($this->tags['params'][$name])) {
            $this->tags['params'][$name] = new ParamTag($name, $types, $description);

            $this->generator->setTag($this->tags['params'][$name]);
        }

        return $this;
    }

    /**
     * propertyTag
     *
     * Property Tag Generator
     *
     * @access public
     * @method propertyTag() Property Tag Generator
     * @param string $name Property name
     * @param $types
     * @param $description
     */
    public function propertyTag(string $name, $types = [], $description = null) {
        if (!isset($this->tags['property'])) {
            $this->tags['property'] = new PropertyTag($name, $types, $description);

            $this->generator->setTag($this->tags['property']);
        }

        return $this;
    }

    /**
     * returnTag
     *
     * Return Tag Generator
     *
     * @access public
     * @method returnTag() Return Tag Generator
     * @param $types
     * @param $description
     */
    public function returnTag($types = [], $description = null) {
        if (!isset($this->tags['return'])) {
            $this->tags['return'] = new ReturnTag($types, $description);

            $this->generator->setTag($this->tags['return']);
        }

        return $this;
    }

    /**
     * throwsTag
     *
     * Throws Tag Generator
     *
     * @access public
     * @method throwsTag() Throws Tag Generator
     * @param $types
     * @param $description
     */
    public function throwsTag($types = [], $description = null) {
        if (is_array($types)) {
            $types = implode('|', $types);
        }

        if (!isset($this->tags['throws'][$type])) {
            $this->tags['throws'][$type] = new ThrowsTag($types, $description);

            $this->generator->setTag(end($this->tags['throws']));
        }

        return $this;
    }

    /**
     * varTag
     *
     * Var Tag Generator
     *
     * @access public
     * @method varTag() Var Tag Generator
     * @param string $name Var Name
     * @param $types
     * @param $description
     */
    public function varTag(string $name, $types = [], $description = null) {
        if (!isset($this->tags['var'])) {
            $this->tags['var'] = new VarTag($name, $types, $description);

            $this->generator->setTag($this->tags['var']);
        }

        return $this;
    }

}
