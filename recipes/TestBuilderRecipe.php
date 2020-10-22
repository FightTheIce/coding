<?php

class_alias(FightTheIce\Coding\ClassBuilder::class, 'ClassBuilder');

$objClass = new FightTheIce\Coding\ClassBuilder("classname", "short", "long");
$obj      = new FightTheIce\Coding\TestBuilder($objClass);

//kick off a new class builder
$class = new \FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\TestBuilder', 'TestBuilder', 'This class is responsible interacting with Laminas\Code\Generator\ClassGenerator');

//if we want to update the class docblock for any reason
//$class->getDescriber()->getGenerator();

//add some additional tags to the class docblock
$class->getDescriber()->tag('namespace', 'FightTheIce\Coding');

//lets generate some properties
$class->newProperty('class', null, 'protected', 'ClassBuilder Object');
$property = $class->getProperty('class');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->classTag()

$property = $class->getProperty('class');
$property->getDescriber()->tag('property', 'string $class ClassBuilder Object'); #in the future this should use $property->getDescriber()->classTag()

$class->newProperty('name', null, 'protected', 'Fully Qualified Class Name');
$property = $class->getProperty('name');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->nameTag()

$property = $class->getProperty('name');
$property->getDescriber()->tag('property', 'string $name Fully Qualified Class Name'); #in the future this should use $property->getDescriber()->nameTag()

$class->newProperty('shortName', null, 'protected', 'Short Name');
$property = $class->getProperty('shortName');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->shortnameTag()

$property = $class->getProperty('shortName');
$property->getDescriber()->tag('property', 'string $shortName Short Name'); #in the future this should use $property->getDescriber()->shortnameTag()

$class->newProperty('test', null, 'protected', 'Test Generator');
$property = $class->getProperty('test');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->testTag()

$property = $class->getProperty('test');
$property->getDescriber()->tag('property', 'NULL $test Test Generator'); #in the future this should use $property->getDescriber()->testTag()

$method = $class->newMethod('__construct', 'public', 'Class Construct');
$method->newRequiredParameter('builder', 'FightTheIce\Coding\ClassBuilder', 'The generated class builder');
$method->getBodyFromObj($obj, '__construct');

$method = $class->newMethod('getClass', 'public', 'Get the property class');
$method->getBodyFromObj($obj, 'getClass');

$method = $class->newMethod('getName', 'public', 'Get the property name');
$method->getBodyFromObj($obj, 'getName');

$method = $class->newMethod('getShortname', 'public', 'Get the property shortName');
$method->getBodyFromObj($obj, 'getShortname');

$method = $class->newMethod('getTest', 'public', 'Get the property test');
$method->getBodyFromObj($obj, 'getTest');

$method = $class->newMethod('generate', 'public', 'Generate the test suite');
$method->getBodyFromObj($obj, 'generate');

$method = $class->newMethod('buildSetup', 'public', 'Builds the Test setUp method');
$method->newRequiredParameter('setup', 'string', 'Setup methodlogy');
$method->getBodyFromObj($obj, 'buildSetup');

file_put_contents('src/TestBuilder.php', '<?php' . PHP_EOL . PHP_EOL . $class->generate());

$test = new FightTheIce\Coding\TestBuilder($class);
$test->buildSetup('$this->obj = new \FightTheIce\Coding\TestBuilder((new \FightTheIce\Coding\ClassBuilder("class","short","long")));');
file_put_contents('tests/TestBuilderTest.php', '<?php' . PHP_EOL . PHP_EOL . $test->generate());
