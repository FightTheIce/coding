<?php

namespace FightTheIce\Coding;

use FightTheIce\Coding\Generator\ParameterGenerator;
use Laminas\Code\Generator\MethodGenerator;
use Laminas\Code\Generator\ValueGenerator;
use Laminas\Code\Reflection\ClassReflection;

/**
 * MethodBuilder
 *
 * This class is responsible for generating methods
 *
 * @namespace FightTheIce\Coding
 */
class MethodBuilder {

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
     * @param access - The access level
     * @param long - The long description
     */
    public function __construct(string $name, string $access, string $long) {
        $this->generator = new MethodGenerator;
        $this->describer = new Describer($name, $long);
        $this->describer->tag('access', trim(strtolower($access)));
        $this->generator->setName($name);

        $access = trim(strtoupper($access));
        switch ($access) {
        case 'PUBLIC':
            $this->generator->setFlags(MethodGenerator::FLAG_PUBLIC);
            break;

        case 'PRIVATE':
            $this->generator->setFlags(MethodGenerator::FLAG_PRIVATE);
            break;

        case 'PROTECTED':
            $this->generator->setFlags(MethodGenerator::FLAG_PROTECTED);
            break;

        default:
            throw new \ErrorException('Access level: [' . $access . '] is invalid!');
        }
    }

    /**
     * getDescriber
     *
     * Get the property describer
     *
     * @access public
     */
    public function getDescriber() {
        return $this->describer;
    }

    /**
     * newRequiredParameter
     *
     * Add a required parameter
     *
     * @access public
     * @param name - Name of parameter
     * @param type - The data type for this parameter
     * @param desc - The description of the parameter
     */
    public function newRequiredParameter(string $name, $type, string $desc) {
        $param = new ParameterGenerator($name, $type);
        $param->omitDefaultValue(true);

        $this->generator->setParameter($param);

        $this->describer->tag('param', $name . ' - ' . $desc);

        return $this;
    }

    /**
     * newRequiredParameterUnknown
     *
     * Add a new required parameter with unknown data type
     *
     * @access public
     * @param name - Name of parameter
     * @param desc - Description of parameter
     */
    public function newRequiredParameterUnknown(string $name, string $desc) {
        $param = new ParameterGenerator($name);
        $param->omitDefaultValue(true);

        $this->generator->setParameter($param);

        $this->describer->tag('param', $name . ' - ' . $desc);

        return $this;
    }

    /**
     * newOptionalParameter
     *
     * Add a new optional parameter
     *
     * @access public
     * @param name - Name of optional parameter
     * @param dv - default value of property
     * @param type - The data type for this parameter
     * @param desc - Description of parameter
     */
    public function newOptionalParameter(string $name, $dv, $type, string $desc) {
        if (is_null($dv)) {
            $dv = new ValueGenerator(null, ValueGenerator::TYPE_NULL);
        }

        $param = new ParameterGenerator($name, $type, $dv);

        $this->generator->setParameter($param);
        $param->omitDefaultValue(false);

        $this->describer->tag('param', $name . ' - ' . $desc);

        return $this;
    }

    /**
     * newOptionalParameterUnknown
     *
     * Add a new optional parameter
     *
     * @access public
     * @param name - Name of optional parameter
     * @param dv - default value of property
     * @param desc - Description of parameter
     */
    public function newOptionalParameterUnknown(string $name, $dv, string $desc) {
        if (is_null($dv)) {
            $dv = new ValueGenerator(null, ValueGenerator::TYPE_NULL);
        }

        $param = new ParameterGenerator($name, null, $dv);

        $this->generator->setParameter($param);
        $param->omitDefaultValue(false);

        $this->describer->tag('param', $name . ' - ' . $desc);

        return $this;
    }

    /**
     * setBody
     *
     * Set the method body
     *
     * @access public
     * @param body - Body contents
     */
    public function setBody(string $body) {
        $this->generator->setBody($body);

        return $this;
    }

    /**
     * getBodyFromObj
     *
     * Get the contents of an existing method
     *
     * @access public
     * @param obj - Object that we can grab it from
     * @param method - Method Name
     */
    public function getBodyFromObj($obj, string $method) {
        $class = new ClassReflection($obj);

        if ($class->hasMethod($method) == false) {
            throw new \ErrorException('The method: [' . $method . '] does not exists in the obj sent.');
        }

        $method = $class->getMethod($method);
        $body   = $method->getBody();

        $this->setBody($body);
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
