<?php

$path = 'src/ClassBuilder.php';

$obj = new FightTheIce\Coding\ClassBuilder("fake", "fake", "fake");

$class = new FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\ClassBuilder', 'ClassBuilder', 'This class is responsible interacting with Laminas\Code\Generator\ClassGenerator');
$class->uses('Laminas\Code\Generator\ClassGenerator');
$class->newProperty('generator', null, 'protected', 'Generator Object', true)
    ->newProperty('describer', null, 'protected', 'Describer Object', true)
    ->newProperty('properties', array(), 'protected', 'Properties to generate', true)
    ->newProperty('methods', array(), 'protected', 'Methods to generate', true);

$method = $class->newMethod('__construct', 'public', 'Class Construct');
$method->newRequiredParameter('name', 'string', 'A string containg the class name')
    ->newRequiredParameter('short', 'string', 'A string containing the short description of the class')
    ->newRequiredParameter('long', 'string', 'A string containing the long description of the class')
    ->getBodyFromObj($obj, '__construct');

$method = $class->newMethod('addClassTag', 'public', 'Add a tag to the class docblock');
$method->newRequiredParameter('name', 'string', 'A string containing the name of the docblock tag')
    ->newRequiredParameter('value', 'string', 'A string containing the value of the docblock tag')
    ->getBodyFromObj($obj, 'addClassTag');

$method = $class->newMethod('newProperty', 'public', 'Add a new property to the class');
$method->newRequiredParameter('name', 'string', 'Name of property')
    ->newRequiredParameterUnknown('dv', 'default value of property')
    ->newRequiredParameter('access', 'string', 'access level')
    ->newRequiredParameter('long', 'string', 'Long Description of property')
    ->newOptionalParameter('getMethod', false, 'bool', 'Should we generate a getProperty method')
    ->getBodyFromObj($obj, 'newProperty');

$method = $class->newMethod('newMethod', 'public', 'Generate a new method');
$method->newRequiredParameter('name', 'string', 'Name of method')
    ->newRequiredParameter('access', 'string', 'access level')
    ->newRequiredParameter('long', 'string', 'long description')
    ->getBodyFromObj($obj, 'newMethod');

$method = $class->newMethod('uses', 'public', 'Add a use statement');
$method->newRequiredParameter('name', 'string', 'Name of class')
    ->newOptionalParameter('alias', null, '?string', 'Alias')
    ->getBodyFromObj($obj, 'uses');

$method = $class->newMethod('classExtends', 'public', 'Should this class extend an existing one')
    ->newRequiredParameter('name', 'string', 'Name of parent class')
    ->getBodyFromObj($obj, 'classExtends');

$method = $class->newMethod('generate', 'public', 'Generate the class data')
    ->getBodyFromObj($obj, 'generate');

$method = $class->newMethod('getMethod', 'public', 'Returns a method object by name');
$method->newRequiredParameter('name', 'string', 'Name of method');
$method->getBodyFromObj($obj, 'getMethod');

$method = $class->newMethod('getProperty', 'public', 'Returns a property object by name');
$method->newRequiredParameter('name', 'string', 'Name of method');
$method->getBodyFromObj($obj, 'getProperty');

file_put_contents($path, '<?php' . PHP_EOL . PHP_EOL . $class->generate());

$test = new FightTheIce\Coding\TestBuilder($class);
$test->buildSetup('$this->obj = new \FightTheIce\Coding\ClassBuilder("class","short","long");');
file_put_contents('tests/ClassBuilderTest.php', '<?php' . PHP_EOL . PHP_EOL . $test->generate());