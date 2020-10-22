<?php

$path = 'src/PropertyBuilder.php';

$obj = new FightTheIce\Coding\PropertyBuilder("fake", null, "public", "fake");

//kick off a new class builder
$class = new \FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\PropertyBuilder', 'PropertyBuilder', 'This class is responsible for generating properties');

//if we want to update the class docblock for any reason
//$class->getDescriber()->getGenerator();

//add the following class uses
$class->uses('Laminas\Code\Generator\PropertyGenerator');

//add some additional tags to the class docblock
$class->getDescriber()->tag('namespace', 'FightTheIce\Coding');

//lets generate some properties
$class->newProperty('generator', null, 'protected', 'Generator Object');
$property = $class->getProperty('generator');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->generatorTag()

$property = $class->getProperty('generator');
$property->getDescriber()->tag('property', 'NULL $generator Generator Object'); #in the future this should use $property->getDescriber()->generatorTag()

$class->newProperty('describer', null, 'protected', 'Describer Object');
$property = $class->getProperty('describer');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->describerTag()

$property = $class->getProperty('describer');
$property->getDescriber()->tag('property', 'NULL $describer Describer Object'); #in the future this should use $property->getDescriber()->describerTag()

$method = $class->newMethod('__construct', 'public', 'Class Construct');
$method->newRequiredParameter('name', 'string', 'A string containing the method name');
$method->newRequiredParameterUnknown('dv', 'The data type for this parameter');
$method->newRequiredParameter('access', 'string', 'Access level');
$method->newRequiredParameter('long', 'string', 'Long Description');
$method->getBodyFromObj($obj, '__construct');

$method = $class->newMethod('getDescriber', 'public', 'Get the property describer');
$method->getBodyFromObj($obj, 'getDescriber');

$method = $class->newMethod('getGenerator', 'public', 'Returns the class generator');
$method->getBodyFromObj($obj, 'getGenerator');

file_put_contents($path, '<?php' . PHP_EOL . PHP_EOL . $class->generate());

$test = new FightTheIce\Coding\TestBuilder($class);
$test->buildSetup('$this->obj = new \FightTheIce\Coding\PropertyBuilder("property","","protected","long");');
file_put_contents('tests/PropertyBuilderTest.php', '<?php' . PHP_EOL . PHP_EOL . $test->generate());
