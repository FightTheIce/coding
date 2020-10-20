<?php

namespace FightTheIce\Coding\Generator;

use Laminas\Code\Generator\ParameterGenerator as LPG;

class ParameterGenerator extends LPG
{
    /**
     * @var bool
     */
    private $omitDefaultValue = false;

    public function hasDefaultValue()
    {
        return $this->omitDefaultValue;
    }

    /**
     * @param bool $omit
     * @return ParameterGenerator
     */
    public function omitDefaultValue(bool $omit = true)
    {
        $this->omitDefaultValue = $omit;

        return $this;
    }
}
