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

    public function reflect() {
        if ($this->reflection->isInternal() == true) {
            throw new \ErrorException('This is an internal PHP class');
        }

        $this->classMeta();
        $this->propertiesMeta();
        $this->methodsMeta();

        return $this->reflection;
    }

    protected function classMeta() {
        $name     = $this->reflection->getName();
        $docblock = $this->reflection->getDocBlock();
        if ($docblock == false) {
            $short = '';
            $long  = '';
            $tags  = array();
        } else {
            $short = $docblock->getShortDescription();
            $long  = $docblock->getLongDescription();
            $tags  = $docblock->getTags();
        }

        $this->builder[] = '$class = new \FightTheIce\Coding\ClassBuilder("' . $this->reflection->getName() . '","' . $short . '","' . $long . '");';
        $this->builder[] = '';

        if (count($tags) > 0) {
            foreach ($tags as $tag) {
                $content = '';
                switch (get_class($tag)) {
                case 'Laminas\Code\Reflection\DocBlock\Tag\GenericTag':
                    $content = $tag->getContent();
                    break;

                case 'Laminas\Code\Reflection\DocBlock\Tag\AuthorTag':
                    $content = $tag->getAuthorName();
                    break;

                default:
                    throw new \ErrorException('Unknown tag type: [' . get_class($tag) . ']');
                }
                $this->builder[] = '$class->addClassTag("' . $tag->getName() . '","' . $content . '");';
            }

            $this->builder[] = "";
        }
    }

    protected function propertiesMeta() {
        $properties = $this->reflection->getProperties();
        if (count($properties) > 0) {
            foreach ($properties as $property) {
                $property->setAccessible(true);

                $docblock = $property->getDocBlock();
                if ($docblock == false) {
                    $short = '';
                    $long  = '';
                    $tags  = array();
                } else {
                    $short = $docblock->getShortDescription();
                    $long  = $docblock->getLongDescription();
                    $tags  = $docblock->getTags();
                }

                $access = 'unknown';
                if ($property->isPublic() == true) {
                    $access = 'public';
                }

                if ($property->isPrivate() == true) {
                    $access = 'private';
                }

                if ($property->isProtected() == true) {
                    $access = 'protected';
                }

                $obj   = $this->reflection->newInstanceWithoutConstructor($this->reflection->getName());
                $value = $property->getValue($obj);

                switch (trim(strtoupper(gettype($value)))) {
                case 'ARRAY':
                    if (empty($value)) {
                        //this means empty array
                        $this->builder[] = '$class->newProperty("' . $property->getName() . '",[],"' . $access . '","' . $long . '");';
                    } else {
                        throw new \ErrorException('I don\'t know how to handle pre built arrays.');
                    }
                    break;

                case 'NULL':
                    $this->builder[] = '$class->newProperty("' . $property->getName() . '",null,"' . $access . '","' . $long . '");';
                    break;
                }
            }

            $this->builder[] = "";
        }
    }

    protected function methodsMeta() {
        $methods = $this->reflection->getMethods();
        if (count($methods) > 0) {
            foreach ($methods as $method) {
                $docblock = $method->getDocBlock();
                if ($docblock == false) {
                    $short = '';
                    $long  = '';
                    $tags  = array();
                } else {
                    $short = $docblock->getShortDescription();
                    $long  = $docblock->getLongDescription();
                    $tags  = $docblock->getTags();
                }

                $access = 'unknown';
                if ($method->isPrivate() == true) {
                    $access = 'public';
                }

                if ($method->isPrivate() == true) {
                    $access = 'private';
                }

                if ($method->isProtected() == true) {
                    $access = 'protected';
                }

                $parameters = $method->getParameters();
                if (count($parameters) > 0) {
                    foreach ($parameters as $param) {
                        $name     = $param->getName();
                        $optional = $param->isOptional();
                        $type     = $param->getType();
                        $value    = "ISREALLYEMPTY";
                        try {
                            $value = $param->getDefaultValue();
                        } catch (\Exception $e) {
                            //ignore this exception
                        }

                        if ($optional == true) {
                            //do we have a datatype?
                            switch ($type) {
                            case 'string':
                                //newOptionalParameter(string $name, $dv, $type, string $desc)
                                $this->builder[] = '$method->addOptionalParameter("' . $name . '","' . $value . '","string","' . $docblock->long . '");';
                                break;

                            default:
                                throw new \ErrorException('Unknown DT: [' . $type . ']');
                            }
                        } else {
                            switch ($type) {
                            case 'string':

                                break;

                            default:
                                throw new \ErrorException('Unknown DT: [' . $type . ']');
                                break;
                            }

                        }
                        print_r(get_class_methods($param));
                        echo PHP_EOL;
                        exit;
                    }
                }

                $this->builder[] = '$method = $class->newMethod("' . $method->getName() . '","' . $access . '","' . $long . '");';
            }

            $this->builder[] = "";
        }
    }

    public function getBuilder() {
        return implode(PHP_EOL, $this->builder) . PHP_EOL;
    }
}