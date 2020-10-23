<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\ClassGenerator;

class ClassBuilder {
    protected $describer  = null;
    protected $generator  = null;
    protected $properties = array();
    protected $implements = array();

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
}