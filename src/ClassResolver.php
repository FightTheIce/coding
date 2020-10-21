<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\DocBlock\TagManager;
use Laminas\Code\Reflection\ClassReflection;
use Laminas\Code\Reflection\DocBlock\Tag\TagInterface;

class ClassResolver {
    protected $reflection      = null;
    protected $objNonConstruct = null;

    protected $builder = array();

    public function __construct($classObjOrName) {
        $this->reflection      = new ClassReflection($classObjOrName);
        $this->objNonConstruct = $this->reflection->newInstanceWithoutConstructor($this->reflection->getName());
    }

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

    public function build() {
        //classMeta first
        $this->buildClassMeta();

        //propertiesMeta second
        $this->buildPropertiesMeta();

        //methodsMeta third
        $this->buildMethodsMeta();

        echo '<?php' . PHP_EOL . 'include(\'vendor/autoload.php\');' . PHP_EOL . PHP_EOL . implode(PHP_EOL, $this->builder) . PHP_EOL;
        echo 'echo \'<?php\'.PHP_EOL.PHP_EOL.$class->generate();';
    }

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
            $implementsStr = @var_export($classMeta['implements'], true);
            if (is_null($implementsStr)) {
                throw new \ErrorException('Unable to parse implements array.');
            }

            $implementsStr = str_replace(PHP_EOL, '', $implementsStr);
            $implementsStr = str_replace('  ', '', $implementsStr);
            $implementsStr = rtrim($implementsStr, ')');
            $implementsStr = rtrim($implementsStr, ',');
            $implementsStr = $implementsStr . ')';

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
                    $defaultValue = @var_export($defaultValue);

                    if (is_null($defaultValue)) {
                        throw new \ErrorException('Var_export can\'t handle your array!');
                    }
                } elseif (is_string($defaultValue)) {
                    $defaultValue = "'" . $defaultValue . "'";
                } else {
                    throw new \ErrorException('Unable to determine datatype for your property.');
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

    protected function buildMethodsMeta() {
        $methodsMeta = $this->methodsMeta();

        foreach ($methodsMeta as $method) {
            $this->addToBuilder('$method = $class->newMethod(\'' . $method['name'] . '\',\'' . $method['access'] . '\',\'' . $method['docblock']['long'] . '\');');

            if (count($method['parameters']) > 0) {
                foreach ($method['parameters'] as $parameter) {
                    switch ($parameter['type']) {
                    case "bool":

                        break;

                    default:
                        //throw new \ErrorException("unknown datatype: [" . $parameter['type'] . "]");
                    }

                    if ($parameter['isOptional'] == true) {
                        //this is an optional parameter

                        if ($parameter['type'] == '#UNKNOWN#') {
                            //newOptionalParameterUnknown(string $name, $dv, string $desc)
                            $this->addToBuilder('$method->newOptionalParameterUnknown(\'' . $parameter['name'] . '\',\'' . $parameter['defaultValue'] . '\',\'' . $parameter['docblock']['desc'] . '\');');
                        } else {
                            //newOptionalParameter(string $name, $dv, $type, string $desc)
                            $this->addToBuilder('$method->newOptionalParameter(\'' . $parameter['name'] . '\',\'' . $parameter['defaultValue'] . '\',\'' . $parameter['type'] . '\',\'' . $parameter['docblock']['desc'] . '\');');
                        }
                    } else {
                        //this is a required parameter

                        if ($parameter['type'] == '#UNKNOWN#') {
                            //newRequiredParameterUnknown(string $name, string $desc)
                            $this->addToBuilder('$method->newRequiredParameterUnknown(\'' . $parameter['name'] . '\',\'' . $parameter['docblock']['desc'] . '\');');
                        } else {
                            //newRequiredParameter(string $name, $type, string $desc)
                            $this->addToBuilder('$method->newRequiredParameter(\'' . $parameter['name'] . '\',\'' . $parameter['type'] . '\',\'' . $parameter['docblock']['desc'] . '\');');
                        }
                    }
                }

                //$this->addToBuilder("");
            }

            //$this->addToBuilder('$method->getBodyFromObj($obj, \'' . $method['name'] . '\');');
            $this->addToBuilder("");
        }
    }

    protected function addToBuilder(string $str, $includeEmptyLine = false) {
        $this->builder[] = $str;
        if ($includeEmptyLine == true) {
            $this->builder[] = "";
        }
    }

    protected function gcm($obj) {
        print_r(get_class_methods($obj));
    }

    protected function pexit($obj) {
        print_r($obj);
        exit;
    }

    protected function extractTagAsGeneric(TagInterface $tag) {
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
}