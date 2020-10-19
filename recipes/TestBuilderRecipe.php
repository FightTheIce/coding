<?php

class_alias(FightTheIce\Coding\ClassBuilder::class, 'ClassBuilder');

$objClass = new FightTheIce\Coding\ClassBuilder("classname", "short", "long");
$obj      = new FightTheIce\Coding\TestBuilder($objClass);

$class = new FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\TestBuilder', 'TestBuilder', 'This class is responsible interacting with Laminas\Code\Generator\ClassGenerator');

$class->newProperty('class', '', 'protected', 'ClassBuilder Object', true)
    ->newProperty('name', '', 'protected', 'Fully Qualified Class Name', true)
    ->newProperty('shortName', '', 'protected', 'Short Name', true)
    ->newProperty('test', null, 'protected', 'Test Generator', true);

$method = $class->newMethod('__construct', 'public', 'Class Construct', 'The class construct');
$method->newRequiredParameter('builder', '\ClassBuilder', 'The generated class builder')
    ->getBodyFromObj($obj, '__construct');

$method = $class->newMethod('generate', 'public', 'Generate', 'Generate the test suite');
$method->getBodyFromObj($obj, 'generate');

file_put_contents('src/TestBuilder.php', '<?php' . PHP_EOL . PHP_EOL . $class->generate());

$test = new FightTheIce\Coding\TestBuilder($class);
file_put_contents('tests/TestBuilderTest.php', '<?php' . PHP_EOL . PHP_EOL . $test->generate());