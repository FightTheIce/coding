<?php

$path = 'src/Describer.php';

$obj = new FightTheIce\Coding\Describer();

$class = new FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\Describer', 'Describer', 'This class is responsible for interacting with the Laminas docblock generator.');
$class->addClassTag('author', 'William Knauss');
$class->uses('Laminas\Code\Generator\DocBlockGenerator')
    ->uses('Laminas\Code\Generator\DocBlock\Tag\GenericTag');
$class->newProperty('generator', null, 'protected', 'The generator object - Laminas\Code\Generator\DocBlockGenerator');

$method = $class->newMethod("__construct", "public", "Class Construct")
    ->newOptionalParameter("short", "", "string", "A string containing the short description")
    ->newOptionalParameter("long", "", "string", "A string containing the long description")
    ->getBodyFromObj($obj, '__construct');

$method = $class->newMethod("short", "public", "DocBlock short description")
    ->newRequiredParameter('desc', 'string', 'A string containg the short description')
    ->getBodyFromObj($obj, 'short');

$method = $class->newMethod('long', 'public', "DocBlock long description")
    ->newRequiredParameter('desc', 'string', 'A string containing the long description')
    ->getBodyFromObj($obj, 'long');

$method = $class->newMethod('tag', 'public', 'DocBlock Tag Generator')
    ->newRequiredParameter('name', 'string', 'Tag Name')
    ->newRequiredParameter('value', 'string', 'Tag Value')
    ->getBodyFromObj($obj, 'tag');

$method = $class->newMethod('getGenerator', 'public', 'Returns the generator object')
    ->getBodyFromObj($obj, 'getGenerator');

file_put_contents($path, '<?php' . PHP_EOL . PHP_EOL . $class->compile()->getGenerator()->generate());