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