<?php

namespace FightTheIce\Coding;

use Laminas\Code\Reflection\ClassReflection;

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

            $docblock = $method->getDocBlock();
            if ($docblock) {
                $tmp['docblock']['short'] = $docblock->getShortDescription();
                $tmp['docblock']['long']  = $docblock->getLongDescription();
                $tmp['docblock']['tags']  = $docblock->getTags();
            }

            $parameters = $method->getParameters();
            if (count($parameters) > 0) {
                foreach ($parameters as $param) {
                    $paramtmp = array(
                        'name'         => '',
                        'type'         => '',
                        'defaultValue' => '',
                        'isOptional'   => '',
                        'docblock'     => '',
                    );

                    $paramtmp['name'] = $param->getName();
                    /*
                    if ($docblock) {
                    foreach ($tmp['docblock']['tags'] as $tag) {

                    }
                    }
                     */
                    $paramtmp['type'] = $param->getType();
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
        $builder = array();

        $classMeta = $this->classMeta();
        $builder[] = '$class = new \FightTheIce\Coding\ClassBuilder("' . $classMeta['classname'] . '","' . $classMeta['docblock']['short'] . '","' . $classMeta['docblock']['long'] . '");';

        $builder[] = "";

        if (!empty($classMeta['uses']['classes'])) {
            foreach ($classMeta['uses']['classes'] as $meta) {
                if (empty($meta['as'])) {
                    $builder[] = '$class->uses("' . $meta['use'] . '");';
                } else {
                    $builder[] = '$class->uses("' . $meta['use'] . '","' . $meta['as'] . '");';
                }
            }

            $builder[] = "";
        }

        if (!empty($classMeta['uses']['functions'])) {
            foreach ($classMeta['uses']['functions'] as $meta) {
                $builder[] = '$class->uses("function ' . $meta . '");';
            }

            $builder[] = "";
        }

        if (!empty($classMeta['extends'])) {
            $builder[] = '$class->classExtends("' . $classMeta['extends'] . '");';
        }

        if (!empty($classMeta['implements'])) {
            foreach ($classMeta['implements'] as &$implements) {
                $implements = "'" . $implements . "'";
            }

            $data      = 'array(' . implode(',', $classMeta['implements']) . ')';
            $builder[] = '$class->getGenerator()->setImplementedInterfaces(' . $data . ');';
            $builder[] = "";
        }

        $propertiesMeta = $this->propertiesMeta();
        foreach ($propertiesMeta as $property) {
            switch (strtoupper(gettype($property['value']))) {
            case 'NULL':
                $builder[] = '$class->newProperty("' . $property['name'] . '",null,"' . $property['access'] . '","' . $property['docblock']['long'] . '");';
                break;

            case 'ARRAY':
                if (empty($property['value'])) {
                    $builder[] = '$class->newProperty("' . $property['name'] . '",[],"' . $property['access'] . '","' . $property['docblock']['long'] . '");';
                } else {
                    throw new \ErrorException('I don\'t know how to handle arrays!');
                }
                break;

            case 'STRING':
                $builder[] = '$class->newProperty("' . $property['name'] . '","' . $property['value'] . '","' . $property['access'] . '","' . $property['docblock']['long'] . '");';
                break;

            default:
                throw new \ErrorException('I don\'t know how to handle property type: [' . gettype($property['value']) . ']');
            }
        }

        if (count($propertiesMeta) > 0) {
            $builder[] = "";
        }

        $methodsMeta = $this->methodsMeta();
        foreach ($methodsMeta as $method) {
            $builder[] = '$method = $class->newMethod("' . $method['name'] . '","' . $method['access'] . '","' . $method['docblock']['long'] . '");';
            if (!empty($method['parameters'])) {
                foreach ($method['parameters'] as $param) {
                    if ($param['isOptional'] == true) {
                        //optional
                        if (empty($param['type'])) {
                            //unknown
                            //newOptionalParameterUnknown(string $name, $dv, string $desc)
                            $builder[] = '$method->newOptionalParameterUnknown("' . $param['name'] . '","' . $param['defaultValue'] . '","' . $method['docblock']['short'] . '");';
                        } else {
                            //known
                            //newOptionalParameter(string $name, $dv, $type, string $desc)
                            $builder[] = '$method->newOptionalParameter("' . $param['name'] . '","' . $param['defaultValue'] . '","' . $param['type'] . '","' . $method['docblock']['long'] . '");';
                        }
                    } else {
                        //required
                        if (empty($param['type'])) {
                            //unknown
                            //newRequiredParameterUnknown(string $name, string $desc)
                            $builder[] = '$method->newRequiredParameterUnknown("' . $param['name'] . '","' . $method['docblock']['long'] . '");';
                        } else {
                            //known
                            //newRequiredParameter(string $name, $type, string $desc)
                            $builder[] = '$method->newRequiredParameter("' . $param['name'] . '","' . $param['type'] . '","' . $method['docblock']['long'] . '");';
                        }
                    }
                }
            }

            $builder[] = "";
        }

        if (count($methodsMeta) > 0) {
            $builder[] = "";
        }

        $build = '<?php' . PHP_EOL . PHP_EOL . implode(PHP_EOL, $builder);
        return $build;
    }

    protected function gcm($obj) {
        print_r(get_class_methods($obj));
    }

    protected function pexit($obj) {
        print_r($obj);
        exit;
    }
}