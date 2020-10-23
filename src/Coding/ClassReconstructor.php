<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\DocBlock\TagManager;
use Laminas\Code\Reflection\ClassReflection;
use Laminas\Code\Reflection\DocBlock\Tag\TagInterface;
use PhpParser\ParserFactory;

class ClassReconstructor {
    protected $reflection = null;
    protected $meta       = array(
        'class' => array(
            'classname'  => array(
                'shortName'     => '',
                'namespaceName' => '',
                'fullName'      => '',
            ),
            'extends'    => '',
            'implements' => array(
            ),
            'uses'       => array(
                'classes'   => array(
                ),
                'functions' => array(
                ),
                'constants' => array(
                ),
            ),
            'docblock'   => array(
                'shortDescription' => '',
                'longDescription'  => '',
                'tags'             => array(),
            ),
        ),
    );
    protected $builder = array();

    public function __construct($objOrName) {
        $this->reflection = new ClassReflection($objOrName);
    }

    public function classMeta() {
        $this->classMeta_classname();
        $this->classMeta_extends();
        $this->classMeta_implements();
        $this->classMeta_uses();
        $this->classMeta_docblock();

        return $this->meta['class'];
    }

    protected function classMeta_docblock() {
        $docblock = $this->reflection->getDocBlock();
        if ($docblock) {
            $this->meta['class']['docblock']['shortDescription'] = $docblock->getShortDescription();
            $this->meta['class']['docblock']['longDescription']  = $docblock->getLongDescription();
            $this->meta['class']['docblock']['tags']             = $docblock->getTags();
        } else {
            $docblock = $this->reflection->getDeclaringFile()->getDocBlock();

            if ($docblock) {
                $this->meta['class']['docblock']['shortDescription'] = $docblock->getShortDescription();
                $this->meta['class']['docblock']['longDescription']  = $docblock->getLongDescription();
                $this->meta['class']['docblock']['tags']             = $docblock->getTags();
            }
        }
    }

    protected function classMeta_classname() {
        $this->meta['class']['classname'] = array(
            'shortName'     => $this->reflection->getShortName(),
            'namespaceName' => $this->reflection->getNamespaceName(),
            'fullName'      => $this->reflection->getName(),
        );
    }

    protected function classMeta_extends() {
        $extends = $this->reflection->getParentClass();
        if ($extends) {
            $this->meta['class']['extends'] = $this->reflection->getParentClass()->getName();
        }
    }

    protected function classMeta_implements() {
        $interfaces = $this->reflection->getInterfaces();
        foreach ($interfaces as $interface) {
            $this->meta['class']['implements'][] = $interface->getName();
        }
    }

    protected function classMeta_uses() {
        $contents      = $this->reflection->getDeclaringFile()->getContents();
        $contentsArray = preg_split('/\R/', $contents);
        $parser        = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $uses          = array();

        $stmts = $parser->parse($contents);
        $json  = json_decode(json_encode($stmts, JSON_PRETTY_PRINT), true);
        foreach ($json as $statement) {
            if (isset($statement['stmts'])) {
                foreach ($statement['stmts'] as $stmts) {
                    if (isset($stmts['uses'])) {
                        foreach ($stmts['uses'] as $use) {
                            $uses[] = rtrim(trim($contentsArray[$use['attributes']['startLine'] - 1]), ';');
                        }
                    }
                }
            }
        }

        foreach ($uses as $use) {
            $x = explode(' ', trim($use));

            switch ($x[1]) {
            case 'function':
                //use function moo as cow
                if (count($x) == 5) {
                    //this has an alias
                    $this->meta['class']['uses']['functions'][] = array(
                        'use'   => $x[2],
                        'alias' => $x[4],
                    );
                } else {
                    //no alias
                    $this->meta['class']['uses']['functions'][] = array(
                        'use'   => $x[2],
                        'alias' => '',
                    );
                }
                break;

            case 'const':
                $this->meta['class']['uses']['constants'][] = array(
                    'use'   => $x[2],
                    'alias' => '',
                );
                break;

            default:
                if (count($x) == 4) {
                    //this has an alias
                    $this->meta['class']['uses']['classes'][] = array(
                        'use'   => $x[1],
                        'alias' => $x[3],
                    );
                } else {
                    //no alias
                    $this->meta['class']['uses']['classes'][] = array(
                        'use'   => $x[1],
                        'alias' => '',
                    );
                }

            }
        }

        $contents      = null;
        $contentsArray = null;
        $parser        = null;
    }

    public function build() {
        $this->classMeta();

        $this->build_class_classname();
        $this->build_class_extends();
        $this->build_class_implements();
        $this->build_class_uses();
        $this->build_class_docblock();

        return implode(PHP_EOL, $this->builder);
    }

    protected function build_class_docblock() {
        $this->build_class_docblock_shortDescription();
        $this->build_class_docblock_longDescription();
        $this->build_class_docblock_tags();
    }

    protected function build_class_docblock_shortDescription() {
        //we don't need to do anything here
    }

    protected function build_class_docblock_longDescription() {
        //we don't need to do anything here
    }

    protected function build_class_docblock_tags() {
        if (!empty($this->meta['class']['docblock']['tags'])) {
            foreach ($this->meta['class']['docblock']['tags'] as $tag) {
                $tagData = $this->extractTagAsGeneric($tag);
                $this->addToBuilderArray('$class->getDescriber()->genericTag(\'' . $tagData['name'] . '\',\'' . $tagData['content'] . '\');');
            }

            $this->addToBuilderArray('');
        }
    }

    protected function build_class_classname() {
        $this->addToBuilderArray('$class = new FightTheIce\Coding\ClassBuilder(\'' . $this->meta['class']['classname']['fullName'] . '\',\'' . $this->meta['class']['docblock']['shortDescription'] . '\',\'' . $this->meta['class']['docblock']['longDescription'] . '\')', true);
    }

    protected function build_class_extends() {
        if (!empty($this->meta['class']['extends'])) {
            $this->addToBuilderArray('$class->classExtends(\'' . $this->meta['class']['extends'] . '\')', true);
        }
    }

    protected function build_class_implements() {
        if (!empty($this->meta['class']['implements'])) {
            foreach ($this->meta['class']['implements'] as $interface) {
                $this->addToBuilderArray('$class->classImplements(\'' . $interface . '\')');
            }

            $this->addToBuilderArray('');
        }
    }

    protected function build_class_uses() {
        $this->build_class_uses_classes();
        $this->build_class_uses_functions();
        $this->build_class_uses_constants();
    }

    protected function build_class_uses_classes() {
        if (!empty($this->meta['class']['uses']['classes'])) {
            foreach ($this->meta['class']['uses']['classes'] as $class) {
                if (empty($class['alias'])) {
                    $this->addToBuilderArray('$class->uses(\'' . $class['use'] . '\')');
                } else {
                    $this->addToBuilderArray('$class->uses(\'' . $class['use'] . '\',\'' . $class['alias'] . '\')');
                }
            }

            $this->addToBuilderArray('');
        }
    }

    protected function build_class_uses_functions() {
        if (!empty($this->meta['class']['uses']['functions'])) {
            foreach ($this->meta['class']['uses']['functions'] as $function) {
                if (empty($function['alias'])) {
                    $this->addToBuilderArray('$class->usesFunction(\'' . $function['use'] . '\')');
                } else {
                    $this->addToBuilderArray('$class->usesFunction(\'' . $function['use'] . '\',\'' . $function['alias'] . '\')');
                }
            }

            $this->addToBuilderArray('');
        }
    }

    protected function build_class_uses_constants() {
        if (!empty($this->meta['class']['uses']['constants'])) {
            foreach ($this->meta['class']['uses']['constants'] as $constant) {
                if (empty($constant['alias'])) {
                    $this->addToBuilderArray('$class->usesFunction(\'' . $constant['use'] . '\')');
                } else {
                    $this->addToBuilderArray('$class->usesFunction(\'' . $constant['use'] . '\',\'' . $constant['alias'] . '\')');
                }
            }

            $this->addToBuilderArray('');
        }
    }

    protected function addToBuilderArray($data, $includeEmptyLine = false) {
        //is the line a comment?
        $isComment = false;
        if (substr(trim($data), 0, 2) == '//') {
            $isComment = true;
        } elseif (substr($data, 0, 1) == '#') {
            $isComment = true;
        }

        if ($isComment == false) {
            if (empty($data)) {
                $data = '';
            } else {
                $data = rtrim($data, ';') . ';';
            }
        }

        $this->builder[] = $data;
        if ($includeEmptyLine == true) {
            $this->builder[] = '';
        }
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