<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\ClassGenerator;

class ClassBuilder {
    protected $describer  = null;
    protected $generator  = null;
    protected $properties = array();
    protected $implements = array();
    protected $attributes = array(
        'standard'  => array(),
        'static'    => array(),
        'constants' => array(),

        'names'     => array(),
    );

    public function __construct(string $classname,  ? string $shortDescription = null,  ? string $longDescription = null) {
        $this->describer = new Describer($shortDescription, $longDescription);
        $this->generator = new ClassGenerator();
        $this->generator->setName($classname);
    }

    public function getDescriber() {
        return $this->describer;
    }

    public function getGenerator() {
        return $this->generator;
    }

    public function generate() {
        $this->describer->generate();

        if (!empty($this->implements)) {
            $this->generator->setImplementedInterfaces($this->implements);
        }

        if ($this->describer->hasData() == true) {
            $this->generator->setDocBlock($this->describer->getGenerator());
        }

        if (!empty($this->attributes['standard'])) {
            foreach ($this->attributes['standard'] as $name => $builder) {
                $builder->generate();
                $this->generator->addPropertyFromGenerator($builder->getGenerator());
            }
        }

        if (!empty($this->attributes['static'])) {
            foreach ($this->attributes['static'] as $name => $builder) {
                $builder->generate();
                $this->generator->addPropertyFromGenerator($builder->getGenerator());
            }
        }

        if (!empty($this->attributes['constants'])) {
            foreach ($this->attributes['constants'] as $name => $builder) {
                $builder->generate();
                $this->generator->addPropertyFromGenerator($builder->getGenerator());
            }
        }

        return $this->generator->generate();
    }

    public function uses(string $use,  ? string $useAlias = null) {
        $this->generator->addUse($use, $useAlias);

        return $this;
    }

    public function usesFunction(string $name) {
        return $this->uses('function ' . $name);
    }

    public function usesConstant(string $name) {
        return $this->uses('const ' . $name);
    }

    public function getProperties() {
        return $this->properties;
    }

    public function classExtends(string $parentClass) {
        $this->generator->setExtendedClass($parentClass);

        return $this;
    }

    public function classImplements(string $interfaceName) {
        $this->implements[] = $interfaceName;

        return $this;
    }

    public function attribute(string $visibility, string $name, $defaultValue = null,  ? string $description = null) {
        if (isset($this->attributes['names'][$name])) {
            throw new \ErrorException('Attribute: [' . $name . '] already exists!');
        }
        $this->attributes['names'][$name];

        $this->attributes['standard'][$name] = new AttributeBuilder($visibility, $name, $defaultValue, $description);

        return $this->attributes['standard'][$name];
    }

    public function staticattribute(string $visibility, string $name, $defaultValue = null,  ? string $description = null) {
        if (isset($this->attributes['names'][$name])) {
            throw new \ErrorException('Attribute: [' . $name . '] already exists!');
        }
        $this->attributes['names'][$name];

        $this->attributes['static'][$name] = new StaticAttributeBuilder($visibility, $name, $defaultValue, $description);

        return $this->attributes['static'][$name];
    }

    public function constantattribute(string $visibility, string $name, $defaultValue = null,  ? string $description = null) {
        if (isset($this->attributes['names'][$name])) {
            throw new \ErrorException('Attribute: [' . $name . '] already exists!');
        }
        $this->attributes['names'][$name];

        $this->attributes['constants'][$name] = new ConstantAttributeBuilder($visibility, $name, $defaultValue, $description);

        return $this->attributes['constants'][$name];
    }
}