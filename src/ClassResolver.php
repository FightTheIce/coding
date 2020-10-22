<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\DocBlock\TagManager;
use Laminas\Code\Reflection\ClassReflection;
use Laminas\Code\Reflection\DocBlock\Tag\TagInterface;

/**
 * @namespace FightTheIce\Coding
 */
class ClassResolver {

    /**
     * reflection
     *
     * @access protected
     * @property NULL $reflection
     */
    protected $reflection = null;

    /**
     * objNonConstruct
     *
     * @access protected
     * @property NULL $objNonConstruct
     */
    protected $objNonConstruct = null;

    /**
     * builder
     *
     * @access protected
     * @property NULL $builder
     */
    protected $builder = null;

    /**
     * __construct
     *
     * @access public
     * @method __construct()
     * @param mixed $classObjOrName
     */
    public function __construct($classObjOrName) {
        try {
            $this->reflection = new ClassReflection($classObjOrName);
        } catch (\Exception $e) {
            throw new \ErrorException('Unable to reflection on: [' . $classObjOrName . ']');
        }

        if ($this->reflection->isInterface() == true) {
            throw new \ErrorException('Unable to reconstruct interfaces at this time!');
        }

        if ($this->reflection->isTrait() == true) {
            throw new \ErrorException('Unable to reconstruct traits at this time!');
        }

        if ($this->reflection->isAbstract() == true) {
            throw new \ErrorException('Unable to reconstruct abstractions at this time!');
        }

        try {
            $this->objNonConstruct = $this->reflection->newInstanceWithoutConstructor($this->reflection->getName());
        } catch (\Exception $e) {
            throw new \ErrorException('Unable to init object without construct!');
        }
    }

    /**
     * classMeta
     *
     * @access public
     * @method classMeta()
     */
    public function classMeta() {
        $results = array(
            'classname'  => '',
            'extends'    => '',
            'implements' => array(),
            'uses'       => array(
                'classes'   => array(),
                'functions' => array(),
            ),
            'docblock'   => array(
                'short' => '',
                'long'  => '',
                'tags'  => array(),
            ),
        );

        $results['classname'] = $this->reflection->getName();

        $extends = $this->reflection->getParentClass();
        if ($extends) {
            $results['extends'] = $this->reflection->getParentClass()->getName();
        }

        $interfaces = $this->reflection->getInterfaces();
        foreach ($interfaces as $interface) {
            $results['implements'][] = $interface->getName();
        }

        $uses = $this->reflection->getDeclaringFile()->getUses();
        foreach ($uses as $use) {
            $x = explode('\\', $use['use']);

            if (count($x) == 1) {
                if (strtolower($use['use']) == $use['use']) {
                    $results['uses']['functions'][] = $use['use'];
                }
            } else {
                $results['uses']['classes'][] = array('use' => $use['use'], 'as' => $use['as']);
            }
        }

        $docblock = $this->reflection->getDocBlock();
        if ($docblock) {
            $results['docblock']['short'] = $docblock->getShortDescription();
            $results['docblock']['long']  = $docblock->getLongDescription();
            $results['docblock']['tags']  = $docblock->getTags();
        } else {
            $docblock = $this->reflection->getDeclaringFile()->getDocBlock();

            if ($docblock) {
                $results['docblock']['short'] = $docblock->getShortDescription();
                $results['docblock']['long']  = $docblock->getLongDescription();
                $results['docblock']['tags']  = $docblock->getTags();
            }
        }

        return $results;
    }

    /**
     * propertiesMeta
     *
     * @access public
     * @method propertiesMeta()
     */
    public function propertiesMeta() {
        $results = array();

        $properties = $this->reflection->getProperties();
        foreach ($properties as $property) {
            $tmp = array(
                'name'     => '',
                'value'    => '',
                'access'   => '',
                'docblock' => array(
                    'short' => '',
                    'long'  => '',
                    'tags'  => array(),
                ),
            );

            $property->setAccessible(true);

            $tmp['name'] = $property->getName();
            $access      = 'UNKNOWN';

            if ($property->isPublic() == true) {
                $access = 'public';
            }

            if ($property->isPrivate() == true) {
                $access = 'private';
            }

            if ($property->isProtected() == true) {
                $access = 'protected';
            }
            $tmp['access'] = $access;

            $docblock = $property->getDocBlock();
            if ($docblock) {
                $tmp['docblock']['short'] = $docblock->getShortDescription();
                $tmp['docblock']['long']  = $docblock->getLongDescription();
                $tmp['docblock']['tags']  = $docblock->getTags();
            }

            $tmp['value'] = $property->getValue($this->objNonConstruct);

            $results[] = $tmp;
        }

        return $results;
    }

    /**
     * methodsMeta
     *
     * @access public
     * @method methodsMeta()
     */
    public function methodsMeta() {
        $results = array();

        $methods = $this->reflection->getMethods();
        foreach ($methods as $method) {
            if ($method->isInternal() == true) {
                continue;
            }

            $tmp = array(
                'name'       => '',
                'access'     => '',
                'parameters' => array(

                ),
                'docblock'   => array(
                    'short' => '',
                    'long'  => '',
                    'tags'  => '',
                ),
            );

            $tmp['name'] = $method->getName();

            $access = 'UNKNOWN';
            if ($method->isPublic()) {
                $access = 'public';
            }

            if ($method->isPrivate()) {
                $access = 'private';
            }

            if ($method->isProtected()) {
                $access = 'protected';
            }
            $tmp['access'] = $access;

            $docblock  = $method->getDocBlock();
            $paramTags = array();
            if ($docblock) {
                $tmp['docblock']['short'] = $docblock->getShortDescription();
                $tmp['docblock']['long']  = $docblock->getLongDescription();
                $tmp['docblock']['tags']  = $docblock->getTags();

                //lets find all the parameter tags
                if (count($tmp['docblock']['tags']) > 0) {
                    foreach ($tmp['docblock']['tags'] as $tag) {
                        $paramTMP = array();

                        $type = get_class($tag);
                        if ($type == 'Laminas\Code\Reflection\DocBlock\Tag\ParamTag') {
                            $paramTMP['name']  = ltrim($tag->getVariableName(), '$');
                            $paramTMP['types'] = implode('|', $tag->getTypes());
                            $paramTMP['desc']  = $tag->getDescription();

                            $paramTags[$paramTMP['name']] = $paramTMP;
                        }
                    }
                }
            }

            $parameters = $method->getParameters();
            if (count($parameters) > 0) {
                foreach ($parameters as $param) {
                    $paramtmp = array(
                        'name'         => '',
                        'type'         => '',
                        'defaultValue' => '',
                        'isOptional'   => '',
                        'docblock'     => array(
                            'name'  => '',
                            'types' => '',
                            'desc'  => '',
                        ),
                    );

                    $paramtmp['name'] = $param->getName();
                    if (isset($paramTags[$paramtmp['name']])) {
                        $paramtmp['docblock'] = $paramTags[$paramtmp['name']];
                    }

                    //$paramtmp['type'] = $param->getType();
                    $type = $param->getType();
                    if (is_null($type)) {
                        $paramtmp['type'] = '#UNKNOWN#';
                    } else {
                        $typeClass = get_class($type);

                        switch (get_class($type)) {
                        case 'ReflectionNamedType':
                            if (!method_exists($type, 'getName')) {
                                throw new \ErrorException('getName method does not exists!');
                            }

                            $paramtmp['type'] = $type->getName();
                            break;

                        default:
                            throw new \ErrorException('UNKNOWN type: ' . $typeClass);
                        }
                    }

                    if ($param->isDefaultValueAvailable() == true) {
                        $paramtmp['defaultValue'] = $param->getDefaultValue();
                    }
                    $paramtmp['isOptional'] = $param->isOptional();

                    $tmp['parameters'][] = $paramtmp;
                }
            }

            $results[] = $tmp;
        }

        return $results;
    }

    /**
     * build
     *
     * @access public
     * @method build()
     */
    public function build() {
        //classMeta first
        $this->buildClassMeta();

        //propertiesMeta second
        $this->buildPropertiesMeta();

        //methodsMeta third
        $this->buildMethodsMeta();

        //return the builder array as a string
        return implode(PHP_EOL, $this->builder);
    }

    /**
     * buildClassMeta
     *
     * @access protected
     * @method buildClassMeta()
     */
    protected function buildClassMeta() {
        $classMeta = $this->classMeta();
        if (!isset($classMeta['classname'])) {
            throw new \ErrorException('buildClassMeta expects a classname');
        }

        $this->addToBuilder('//kick off a new class builder');
        $str = '$class = new \FightTheIce\Coding\ClassBuilder(\'{className}\',\'{docblock_short}\',\'{docblock_long}\');';
        $str = str_replace('{className}', $classMeta['classname'], $str);
        $str = str_replace('{docblock_short}', $classMeta['docblock']['short'], $str);
        $str = str_replace('{docblock_long}', $classMeta['docblock']['long'], $str);
        $this->addToBuilder($str, true);

        $this->addToBuilder('//if we want to update the class docblock for any reason');
        $this->addToBuilder('//$class->getDescriber()->getGenerator();', true);

        if (!empty($classMeta['extends'])) {
            $this->addToBuilder('$class->classExtends(\'' . $classMeta['extends'] . '\');', true);
        }

        if (!empty($classMeta['implements'])) {
            $implementsStr = $this->exportArray($classMeta['implements']);

            $this->addToBuilder('//we should build a native way of doing this in the future');
            $this->addToBuilder('$class->getGenerator()->setImplementedInterfaces(' . $implementsStr . ');', true);
        }

        if (count($classMeta['uses']['classes']) > 0) {
            $this->addToBuilder('//add the following class uses');
            foreach ($classMeta['uses']['classes'] as $use) {
                if (!empty($use['as'])) {
                    $this->addToBuilder('$class->uses(\'' . $use['use'] . '\',\'' . $use['as'] . '\')');
                } else {
                    $this->addToBuilder('$class->uses(\'' . $use['use'] . '\');');
                }
            }
            //add an empty line
            $this->addToBuilder("");
        }

        if (count($classMeta['uses']['functions']) > 0) {
            $this->addToBuilder('//add the following functions to class');
            $this->addToBuilder('//we should create a native way of doing this in the future');
            foreach ($classMeta['uses']['functions'] as $use) {
                $this->addToBuilder('$class->uses(\'function ' . $use . '\');');
            }
            //add an empty line
            $this->addToBuilder("");
        }

        //do we have additional docblock tags?
        if (count($classMeta['docblock']['tags']) > 0) {
            $this->addToBuilder('//add some additional tags to the class docblock');
            foreach ($classMeta['docblock']['tags'] as $tag) {
                $tagData = $this->extractTagAsGeneric($tag);
                $this->addToBuilder('$class->getDescriber()->tag(\'' . $tagData['name'] . '\',\'' . $tagData['content'] . '\');');
            }
            $this->addToBuilder("");
        }
    }

    /**
     * buildPropertiesMeta
     *
     * @access protected
     * @method buildPropertiesMeta()
     */
    protected function buildPropertiesMeta() {
        $propertiesMeta = $this->propertiesMeta();
        if (count($propertiesMeta) > 0) {
            $this->addToBuilder('//lets generate some properties');
            foreach ($propertiesMeta as $property) {
                $defaultValue = $property['value'];
                if (empty($defaultValue)) {
                    $defaultValue = null;
                    $this->addToBuilder('$class->newProperty(\'' . $property['name'] . '\',null,\'' . $property['access'] . '\',\'' . $property['docblock']['long'] . '\');');
                } elseif (is_array($defaultValue)) {
                    $defaultValue = $this->exportArray($defaultValue);
                } elseif (is_string($defaultValue)) {
                    $defaultValue = "'" . $defaultValue . "'";
                } elseif (is_bool($defaultValue)) {
                    if ($defaultValue == true) {
                        $defaultValue = 'true';
                    } else {
                        $defaultValue = 'false';
                    }
                } elseif (is_int($defaultValue)) {
                    $defaultValue = (string) $defaultValue;
                } else {
                    throw new \ErrorException('Unable to determine datatype for your property. [' . gettype($defaultValue) . ']');
                }

                if (count($property['docblock']['tags']) > 0) {
                    foreach ($property['docblock']['tags'] as $tag) {
                        $tagData = $this->extractTagAsGeneric($tag);
                        $this->addToBuilder('$property = $class->getProperty(\'' . $property['name'] . '\');');
                        $this->addToBuilder('$property->getDescriber()->tag(\'' . $tagData['name'] . '\',\'' . $tagData['content'] . '\'); #in the future this should use $property->getDescriber()->' . strtolower($property['name']) . 'Tag()');

                        $this->addToBuilder("");
                    }
                    $this->addToBuilder("");
                }
            }

            $this->addToBuilder("");
        }
    }

    /**
     * buildMethodsMeta
     *
     * @access protected
     * @method buildMethodsMeta()
     */
    protected function buildMethodsMeta() {
        $methodsMeta = $this->methodsMeta();

        foreach ($methodsMeta as $method) {
            $this->addToBuilder('$method = $class->newMethod(\'' . $method['name'] . '\',\'' . $method['access'] . '\',\'' . $method['docblock']['long'] . '\');');

            if (count($method['parameters']) > 0) {
                foreach ($method['parameters'] as $parameter) {
                    $call         = "";
                    $defaultValue = $this->exportDataTypeAsString($parameter['defaultValue']);

                    if ($parameter['isOptional'] == true) {
                        //this is an optional parameter

                        if ($parameter['type'] == '#UNKNOWN#') {
                            //newOptionalParameterUnknown(string $name, $dv, string $desc)
                            $call = 'newOptionalParameterUnknown({name}, {dv}, {desc})';
                            if (empty($defaultValue)) {
                                throw new \ErrorException('X-1');
                            }
                        } else {
                            //newOptionalParameter(string $name, $dv, $type, string $desc)
                            $call = 'newOptionalParameter({name}, {dv}, {type}, {desc})';
                            if (empty($defaultValue)) {
                                throw new \ErrorException('X-2');
                            }
                        }
                    } else {
                        //this is a required parameter

                        if ($parameter['type'] == '#UNKNOWN#') {
                            //newRequiredParameterUnknown(string $name, string $desc)
                            $call = 'newRequiredParameterUnknown({name}, {desc})';
                        } else {
                            //newRequiredParameter(string $name, $type, string $desc)
                            $call = 'newRequiredParameter({name}, {type}, {desc})';
                        }
                    }

                    $call = str_replace('{name}', "'" . $parameter['name'] . "'", $call);

                    $call = str_replace('{dv}', $defaultValue, $call);

                    if ($parameter['type'] != '#UNKNOWN#') {
                        /*
                        switch (strtoupper($parameter['type'])) {
                        case 'BOOLEAN':
                        case 'INTEGER':
                        case 'FLOAT':
                        case 'STRING':
                        case 'ARRAY':
                        case 'NULL':
                        break;

                        default:
                        //if the type is not a basic one then lets add a "use" and use the shortname for the type hint
                        $x         = explode('\\', $parameter['type']);
                        $shortName = array_pop($x);

                        if (count($x) > 1) {
                        $this->addToBuilder('$class->uses(\'' . implode('\\', $x) . '\');');

                        $parameter['type'] = $shortName;
                        }
                        break;
                        }
                         */
                        $call = str_replace('{type}', "'" . $parameter['type'] . "'", $call);
                    }

                    $call = str_replace('{desc}', "'" . str_replace("'", "\'", $parameter['docblock']['desc']) . "'", $call);
                    $this->addToBuilder('$method->' . $call . ';');
                }
            }

            $this->addToBuilder('$method->getBodyFromObj($obj, \'' . $method['name'] . '\');');
            $this->addToBuilder("");
        }
    }

    /**
     * addToBuilder
     *
     * @access protected
     * @method addToBuilder()
     * @param string $str
     * @param bool $includeEmptyLine
     */
    protected function addToBuilder(string $str, bool $includeEmptyLine = false) {
        $this->builder[] = $str;
        if ($includeEmptyLine == true) {
            $this->builder[] = "";
        }
    }

    /**
     * gcm
     *
     * @access protected
     * @method gcm()
     * @param mixed $obj
     */
    protected function gcm($obj) {
        print_r(get_class_methods($obj));
    }

    /**
     * pexit
     *
     * @access protected
     * @method pexit()
     * @param mixed $obj
     */
    protected function pexit($obj) {
        print_r($obj);
        exit;
    }

    /**
     * extractTagAsGeneric
     *
     * @access protected
     * @method extractTagAsGeneric()
     * @param Laminas\Code\Reflection\DocBlock\Tag\TagInterface $tag
     */
    protected function extractTagAsGeneric(\Laminas\Code\Reflection\DocBlock\Tag\TagInterface $tag) {
        $return = array(
            'name'    => '',
            'content' => '',
        );

        $manager = new TagManager();
        $manager->initializeDefaultTags();
        $newTag = $manager->createTagFromReflection($tag);
        $string = $newTag->generate();
        $string = ltrim($string, '@');
        $x      = explode(' ', $string);
        $name   = $x[0];
        unset($x[0]);
        $content = implode(' ', $x);

        $return['name']    = $name;
        $return['content'] = $content;

        return $return;
    }

    /**
     * exportArray
     *
     * @access protected
     * @method exportArray()
     * @param array $arr
     */
    protected function exportArray(array $arr) {
        $arrStr = @var_export($arr, true);
        if (is_null($arrStr)) {
            throw new \ErrorException('Unable to var_export array.');
        }

        $arrStr = str_replace(PHP_EOL, '', $arrStr);
        $arrStr = str_replace('  ', '', $arrStr);
        $arrStr = rtrim($arrStr, ')');
        $arrStr = rtrim($arrStr, ',');
        $arrStr = $arrStr . ')';

        return $arrStr;
    }

    /**
     * exportDataTypeAsString
     *
     * @access protected
     * @method exportDataTypeAsString()
     * @param mixed $data
     */
    protected function exportDataTypeAsString($data) {
        $return = '';

        $type = trim(strtoupper(gettype($data)));
        switch ($type) {
        case 'BOOLEAN':
            if ($data == true) {
                $return = 'true';
            } else {
                $return = 'false';
            }
            break;

        case 'INTEGER':
            $return = (string) $data;
            break;

        case 'FLOAT':
            $return = (string) $data;
            break;

        case 'STRING':
            if (empty($data)) {
                $data = "''";
            }

            $return = $data;
            break;

        case 'ARRAY':
            $return = $this->exportArray($data);
            break;

        case 'OBJECT':
            throw new \ErrorException('Unable to export type: [object]');
            break;

        case 'CALLABLE':
            throw new \ErrorException('Unable to export type: [callable]');
            break;

        case 'ITERABLE':
            throw new \ErrorException('Unable to export type: [iterable]');
            break;

        case 'RESOURCE':
            throw new \ErrorException('Unable to export type: [resource]');
            break;

        case 'NULL':
            $return = 'null';
            break;
        }

        if (!is_string($return)) {
            throw new \ErrorException('Unable to cast to string!');
        }

        return $return;
    }

}
