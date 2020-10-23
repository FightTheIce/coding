<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\PropertyGenerator;

class AttributeBuilder {
    protected $describer = null;
    protected $generator = null;
    protected $generated = '';

    public function __construct(string $visibility, string $name, $defaultValue = null,  ? string $description = null) {
        $this->describer = new Describer($name, '');
        $this->describer->varTag($name, gettype($defaultValue), $description);

        $this->generator = new PropertyGenerator($name, $defaultValue);

        $visibility = trim(strtolower($visibility));
        switch ($visibility) {
        case 'public' :
            $this->generator->setFlags(PropertyGenerator::VISIBILITY_PUBLIC);
            break;

        case 'private':
            $this->generator->setFlags(PropertyGenerator::VISIBILITY_PUBLIC);
            break;

        case 'protected':
            $this->generator->setFlags(PropertyGenerator::VISIBILITY_PUBLIC);
            break;

        default:
            throw new \ErrorException('attribute visibility must be public, private, or protected.');
            break;
        }
    }

    public function getDescriber() {
        return $this->describer;
    }

    public function getGenerator() {
        return $this->generator;
    }

    public function generate() {
        if (!empty($this->generated)) {
            return $this->generated;
        }

        if ($this->getDescriber()->hasData() == true) {
            $this->getDescriber()->generate();

            $this->getGenerator()->setDocBlock($this->getDescriber()->getGenerator());
        }

        $this->generated = $this->getGenerator()->generate();

        return $this->generated;
    }
}