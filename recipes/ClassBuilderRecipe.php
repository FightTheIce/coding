<?php

$path = 'src/ClassBuilder.php';

$obj = new FightTheIce\Coding\ClassBuilder("fake", "fake", "fake");

//kick off a new class builder
$class = new \FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\ClassBuilder', 'ClassBuilder', 'This class is responsible interacting with Laminas\Code\Generator\ClassGenerator');

//if we want to update the class docblock for any reason
//$class->getDescriber()->getGenerator();

//add the following class uses
$class->uses('Laminas\Code\Generator\ClassGenerator');

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

$class->newProperty('properties', null, 'protected', 'Properties to generate');
$property = $class->getProperty('properties');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->propertiesTag()

$property = $class->getProperty('properties');
$property->getDescriber()->tag('property', 'array $properties Properties to generate'); #in the future this should use $property->getDescriber()->propertiesTag()

$class->newProperty('methods', null, 'protected', 'Methods to generate');
$property = $class->getProperty('methods');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->methodsTag()

$property = $class->getProperty('methods');
$property->getDescriber()->tag('property', 'array $methods Methods to generate'); #in the future this should use $property->getDescriber()->methodsTag()

$method = $class->newMethod('__construct', 'public', 'Class Construct');
$method->newRequiredParameter('name', 'string', 'A string containg the class name');
$method->newRequiredParameter('short', 'string', 'A string containing the short description of the class');
$method->newRequiredParameter('long', 'string', 'A string containing the long description of the class');
$method->getBodyFromObj($obj, '__construct');

$method = $class->newMethod('getGenerator', 'public', 'Get the property generator');
$method->getBodyFromObj($obj, 'getGenerator');

$method = $class->newMethod('getDescriber', 'public', 'Get the property describer');
$method->getBodyFromObj($obj, 'getDescriber');

$method = $class->newMethod('getProperties', 'public', 'Get the property properties');
$method->getBodyFromObj($obj, 'getProperties');

$method = $class->newMethod('getMethods', 'public', 'Get the property methods');
$method->getBodyFromObj($obj, 'getMethods');

$method = $class->newMethod('addClassTag', 'public', 'Add a tag to the class docblock');
$method->newRequiredParameter('name', 'string', 'A string containing the name of the docblock tag');
$method->newRequiredParameter('value', 'string', 'A string containing the value of the docblock tag');
$method->getBodyFromObj($obj, 'addClassTag');

$method = $class->newMethod('newProperty', 'public', 'Add a new property to the class');
$method->newRequiredParameter('name', 'string', 'Name of property');
$method->newRequiredParameterUnknown('dv', 'default value of property');
$method->newRequiredParameter('access', 'string', 'access level');
$method->newRequiredParameter('long', 'string', 'Long Description of property');
$method->newOptionalParameter('getMethod', false, 'bool', 'Should we generate a getProperty method');
$method->getBodyFromObj($obj, 'newProperty');

$method = $class->newMethod('newMethod', 'public', 'Generate a new method');
$method->newRequiredParameter('name', 'string', 'Name of method');
$method->newRequiredParameter('access', 'string', 'access level');
$method->newRequiredParameter('long', 'string', 'long description');
$method->getBodyFromObj($obj, 'newMethod');

$method = $class->newMethod('uses', 'public', 'Add a use statement');
$method->newRequiredParameter('name', 'string', 'Name of class');
$method->newOptionalParameter('alias', null, 'string', 'Alias');
$method->getBodyFromObj($obj, 'uses');

$method = $class->newMethod('classExtends', 'public', 'Should this class extend an existing one');
$method->newRequiredParameter('name', 'string', 'Name of parent class');
$method->getBodyFromObj($obj, 'classExtends');

$method = $class->newMethod('generate', 'public', 'Generate the class data');
$method->getBodyFromObj($obj, 'generate');

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
