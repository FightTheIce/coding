<?php

$path = 'src/MethodBuilder.php';

$obj = new FightTheIce\Coding\MethodBuilder("fake", "public", "fake");

//kick off a new class builder
$class = new \FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\MethodBuilder', 'MethodBuilder', 'This class is responsible for generating methods');

//if we want to update the class docblock for any reason
//$class->getDescriber()->getGenerator();

//add the following class uses
$class->uses('FightTheIce\Coding\Generator\ParameterGenerator');
$class->uses('Laminas\Code\Generator\MethodGenerator');
$class->uses('Laminas\Code\Generator\ValueGenerator');
$class->uses('Laminas\Code\Reflection\ClassReflection');

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
$method->newRequiredParameter('access', 'string', 'The access level');
$method->newRequiredParameter('long', 'string', 'The long description');
$method->getBodyFromObj($obj, '__construct');

$method = $class->newMethod('getDescriber', 'public', 'Get the property describer');
$method->getBodyFromObj($obj, 'getDescriber');

$method = $class->newMethod('newRequiredParameter', 'public', 'Add a required parameter');
$method->newRequiredParameter('name', 'string', 'Name of parameter');
$method->newRequiredParameterUnknown('type', 'The data type for this parameter');
$method->newRequiredParameter('desc', 'string', 'The description of the parameter');
$method->getBodyFromObj($obj, 'newRequiredParameter');

$method = $class->newMethod('newRequiredParameterUnknown', 'public', 'Add a new required parameter with unknown data type');
$method->newRequiredParameter('name', 'string', 'Name of parameter');
$method->newRequiredParameter('desc', 'string', 'Description of parameter');
$method->getBodyFromObj($obj, 'newRequiredParameterUnknown');

$method = $class->newMethod('newOptionalParameter', 'public', 'Add a new optional parameter');
$method->newRequiredParameter('name', 'string', 'Name of optional parameter');
$method->newRequiredParameterUnknown('dv', 'default value of property');
$method->newRequiredParameterUnknown('type', 'The data type for this parameter');
$method->newRequiredParameter('desc', 'string', 'Description of parameter');
$method->getBodyFromObj($obj, 'newOptionalParameter');

$method = $class->newMethod('newOptionalParameterUnknown', 'public', 'Add a new optional parameter');
$method->newRequiredParameter('name', 'string', 'Name of optional parameter');
$method->newRequiredParameterUnknown('dv', 'default value of property');
$method->newRequiredParameter('desc', 'string', 'Description of parameter');
$method->getBodyFromObj($obj, 'newOptionalParameterUnknown');

$method = $class->newMethod('setBody', 'public', 'Set the method body');
$method->newRequiredParameter('body', 'string', 'Body contents');
$method->getBodyFromObj($obj, 'setBody');

$method = $class->newMethod('getBodyFromObj', 'public', 'Get the contents of an existing method');
$method->newRequiredParameterUnknown('obj', 'Object that we can grab it from');
$method->newRequiredParameter('method', 'string', 'Method Name');
$method->getBodyFromObj($obj, 'getBodyFromObj');

$method = $class->newMethod('getGenerator', 'public', 'Returns the class generator');
$method->getBodyFromObj($obj, 'getGenerator');

file_put_contents($path, '<?php' . PHP_EOL . PHP_EOL . $class->generate());

$test = new FightTheIce\Coding\TestBuilder($class);
$test->buildSetup('$this->obj = new \FightTheIce\Coding\MethodBuilder("method","public","long");');
file_put_contents('tests/MethodBuilderTest.php', '<?php' . PHP_EOL . PHP_EOL . $test->generate());
