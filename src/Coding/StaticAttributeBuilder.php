<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\PropertyGenerator;

class StaticAttributeBuilder extends AttributeBuilder {

    public function __construct(string $visibility, string $name, $defaultValue = null,  ? string $description = null) {
        parent::__construct($visibility, $name, $defaultValue, $description);

        $this->generator->setStatic(true);
    }
}