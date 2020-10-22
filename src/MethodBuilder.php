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
     * @param string $access The access level
     * @param string $long The long description
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

        $this->describer->methodTag($name, [], $long);
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
     * newRequiredParameter
     *
     * Add a required parameter
     *
     * @access public
     * @method newRequiredParameter() Add a required parameter
     * @param string $name Name of parameter
     * @param mixed $type The data type for this parameter
     * @param string $desc The description of the parameter
     */
    public function newRequiredParameter(string $name, $type, string $desc) {
        $param = new ParameterGenerator($name, $type);
        $param->omitDefaultValue(true);

        $this->generator->setParameter($param);

        $this->describer->paramTag($name, array($type), $desc);

        return $this;
    }

    /**
     * newRequiredParameterUnknown
     *
     * Add a new required parameter with unknown data type
     *
     * @access public
     * @method newRequiredParameterUnknown() Add a new required parameter with unknown
     * data type
     * @param string $name Name of parameter
     * @param string $desc Description of parameter
     */
    public function newRequiredParameterUnknown(string $name, string $desc) {
        $param = new ParameterGenerator($name);
        $param->omitDefaultValue(true);

        $this->generator->setParameter($param);

        $this->describer->paramTag($name, array('mixed'), $desc);

        return $this;
    }

    /**
     * newOptionalParameter
     *
     * Add a new optional parameter
     *
     * @access public
     * @method newOptionalParameter() Add a new optional parameter
     * @param string $name Name of optional parameter
     * @param mixed $dv default value of property
     * @param mixed $type The data type for this parameter
     * @param string $desc Description of parameter
     */
    public function newOptionalParameter(string $name, $dv, $type, string $desc) {
        if (is_null($dv)) {
            $dv = new ValueGenerator(null, ValueGenerator::TYPE_NULL);
        }

        $param = new ParameterGenerator($name, $type, $dv);

        $this->generator->setParameter($param);
        $param->omitDefaultValue(false);

        $this->describer->paramTag($name, array($type), $desc);

        return $this;
    }

    /**
     * newOptionalParameterUnknown
     *
     * Add a new optional parameter
     *
     * @access public
     * @method newOptionalParameterUnknown() Add a new optional parameter
     * @param string $name Name of optional parameter
     * @param mixed $dv default value of property
     * @param string $desc Description of parameter
     */
    public function newOptionalParameterUnknown(string $name, $dv, string $desc) {
        if (is_null($dv)) {
            $dv = new ValueGenerator(null, ValueGenerator::TYPE_NULL);
        }

        $param = new ParameterGenerator($name, null, $dv);

        $this->generator->setParameter($param);
        $param->omitDefaultValue(false);

        $this->describer->paramTag($name, [], $desc);

        return $this;
    }

    /**
     * setBody
     *
     * Set the method body
     *
     * @access public
     * @method setBody() Set the method body
     * @param string $body Body contents
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
     * @method getBodyFromObj() Get the contents of an existing method
     * @param mixed $obj Object that we can grab it from
     * @param string $method Method Name
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
     * @method getGenerator() Returns the class generator
     */
    public function getGenerator() {
        $this->generator->setDocBlock($this->describer->getGenerator());

        return $this->generator;
    }

}
