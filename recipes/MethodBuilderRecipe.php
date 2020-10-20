<?php

$path = 'src/MethodBuilder.php';

$obj = new FightTheIce\Coding\MethodBuilder("fake", "public", "fake");

$class = new FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\MethodBuilder', 'MethodBuilder', 'This class is responsible for generating methods');
$class->uses('Laminas\Code\Generator\MethodGenerator')
//->uses('Laminas\Code\Generator\ParameterGenerator')
    ->uses('FightTheIce\Coding\Generator\ParameterGenerator')
    ->uses('Laminas\Code\Generator\ValueGenerator')
    ->uses('Laminas\Code\Reflection\ClassReflection')
    ->newProperty('generator', null, 'protected', 'Generator Object')
    ->newProperty('describer', null, 'protected', 'Describer Object', true);

$method = $class->newMethod('__construct', 'public', 'Class Construct');
$method->newRequiredParameter('name', 'string', 'A string containing the method name')
    ->newRequiredParameter('access', 'string', 'The access level')
    ->newRequiredParameter('long', 'string', 'The long description')
    ->getBodyFromObj($obj, '__construct');

$method = $class->newMethod('newRequiredParameter', 'public', 'Add a required parameter')
    ->newRequiredParameter('name', 'string', 'Name of parameter')
    ->newRequiredParameterUnknown('type', 'The data type for this parameter')
    ->newRequiredParameter('desc', 'string', 'The description of the parameter')
    ->getBodyFromObj($obj, 'newRequiredParameter');

$method = $class->newMethod('newRequiredParameterUnknown', 'public', 'Add a new required parameter with unknown data type')
    ->newRequiredParameter('name', 'string', 'Name of parameter')
    ->newRequiredParameter('desc', 'string', 'Description of parameter')
    ->getBodyFromObj($obj, 'newRequiredParameterUnknown');

$method = $class->newMethod('newOptionalParameter', 'public', 'Add a new optional parameter')
    ->newRequiredParameter('name', 'string', 'Name of optional parameter')
    ->newRequiredParameterUnknown('dv', 'default value of property')
    ->newRequiredParameterUnknown('type', 'The data type for this parameter')
    ->newRequiredParameter('desc', 'string', 'Description of parameter')
    ->getBodyFromObj($obj, 'newOptionalParameter');

$method = $class->newMethod('newOptionalParameterUnknown', 'public', 'Add a new optional parameter')
    ->newRequiredParameter('name', 'string', 'Name of optional parameter')
    ->newRequiredParameterUnknown('dv', 'default value of property')
    ->newRequiredParameter('desc', 'string', 'Description of parameter')
    ->getBodyFromObj($obj, 'newOptionalParameterUnknown');

$method = $class->newMethod('setBody', 'public', 'Set the method body')
    ->newRequiredParameter('body', 'string', 'Body contents')
    ->getBodyFromObj($obj, 'setBody');

$method = $class->newMethod('getBodyFromObj', 'public', 'Get the contents of an existing method')
    ->newRequiredParameterUnknown('obj', 'Object that we can grab it from')
    ->newRequiredParameter('method', 'string', 'Method Name')
    ->getBodyFromObj($obj, 'getBodyFromObj');

$method = $class->newMethod('getGenerator', 'public', 'Returns the class generator');
$method->getBodyFromObj($obj, 'getGenerator');

file_put_contents($path, '<?php' . PHP_EOL . PHP_EOL . $class->generate());

$test = new FightTheIce\Coding\TestBuilder($class);
file_put_contents('tests/MethodBuilderTest.php', '<?php' . PHP_EOL . PHP_EOL . $test->generate());