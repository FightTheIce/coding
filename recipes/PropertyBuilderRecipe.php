<?php

$path = 'src/PropertyBuilder.php';

$obj = new FightTheIce\Coding\PropertyBuilder("fake", null, "public", "fake");

$class = new FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\PropertyBuilder', 'PropertyBuilder', 'This class is responsible for generating properties');
$class->uses('Laminas\Code\Generator\PropertyGenerator')
    ->newProperty('generator', null, 'protected', 'Generator Object')
    ->newProperty('describer', null, 'protected', 'Describer Object', true);

$method = $class->newMethod('__construct', 'public', 'Class Construct');
$method->newRequiredParameter('name', 'string', 'A string containing the method name')
    ->newRequiredParameterUnknown('dv', 'The data type for this parameter')
    ->newRequiredParameter('access', 'string', 'Access level')
    ->newRequiredParameter('long', 'string', 'Long Description')
    ->getBodyFromObj($obj, '__construct');

$method = $class->newMethod('getGenerator', 'public', 'Returns the class generator');
$method->getBodyFromObj($obj, 'getGenerator');

file_put_contents($path, '<?php' . PHP_EOL . PHP_EOL . $class->generate());