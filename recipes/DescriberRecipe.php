<?php

$path = 'src/Describer.php';

$obj = new FightTheIce\Coding\Describer();

$class = new FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\Describer', 'Describer', 'This class is responsible for interacting with the Laminas docblock generator.');
$class->addClassTag('author', 'William Knauss');
$class->uses('Laminas\Code\Generator\DocBlockGenerator')
    ->uses('Laminas\Code\Generator\DocBlock\Tag\GenericTag')
    ->uses('Laminas\Code\Generator\DocBlock\Tag\AuthorTag')
    ->uses('Laminas\Code\Generator\DocBlock\Tag\LicenseTag')
    ->uses('Laminas\Code\Generator\DocBlock\Tag\MethodTag')
    ->uses('Laminas\Code\Generator\DocBlock\Tag\ParamTag')
    ->uses('Laminas\Code\Generator\DocBlock\Tag\PropertyTag')
    ->uses('Laminas\Code\Generator\DocBlock\Tag\ReturnTag')
    ->uses('Laminas\Code\Generator\DocBlock\Tag\ThrowsTag')
    ->uses('Laminas\Code\Generator\DocBlock\Tag\VarTag');

$class->newProperty('generator', null, 'protected', 'The generator object - Laminas\Code\Generator\DocBlockGenerator', true);

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

$method = $class->newMethod('genericTag', 'public', 'DocBlock Tag Generator')
    ->newRequiredParameter('name', 'string', 'Tag Name')
    ->newRequiredParameter('value', 'string', 'Tag Value')
    ->setBody('return $this->tag($name,$value);');

$method = $class->newMethod('authorTag', 'public', 'Author Tag Generator')
    ->newOptionalParameter('name', null, '?string', 'A string containing the authors name')
    ->newOptionalParameter('email', null, '?string', 'A string containing the authors\'s email address')
    ->getBodyFromObj($obj, 'authorTag');

$method = $class->newMethod('licenseTag', 'public', 'License Tag Generator')
    ->newOptionalParameter('url', null, '?string', 'URL')
    ->newOptionalParameter('name', null, '?string', 'License Name')
    ->getBodyFromObj($obj, 'licenseTag');

$method = $class->newMethod('methodTag', 'public', 'Method Tag Generator')
    ->newOptionalParameter('name', null, '?string', 'Method Name')
    ->newOptionalParameterUnknown('types', array(), 'Method Types')
    ->newOptionalParameterUnknown('description', null, 'Method Description')
    ->newOptionalParameterUnknown('isStatic', false, 'Is Method Static?')
    ->getBodyFromObj($obj, 'methodTag');

$method = $class->newMethod('paramTag', 'public', 'Param Tag Generator')
    ->newRequiredParameter('name', 'string', 'Param Name')
    ->newOptionalParameterUnknown('types', array(), 'Param Types')
    ->newOptionalParameterUnknown('description', null, 'Param Description')
    ->getBodyFromObj($obj, 'paramTag');

$method = $class->newMethod('propertyTag', 'public', 'Property Tag Generator')
    ->newRequiredParameter('name', 'string', 'Property name')
    ->newOptionalParameterUnknown('types', array(), 'Property types')
    ->newOptionalParameterUnknown('description', null, 'Property description')
    ->getBodyFromObj($obj, 'propertyTag');

$method = $class->newMethod('returnTag', 'public', 'Return Tag Generator')
    ->newOptionalParameterUnknown('types', array(), 'Return Types')
    ->newOptionalParameterUnknown('description', null, 'Return Description')
    ->getBodyFromObj($obj, 'returnTag');

$method = $class->newMethod('throwsTag', 'public', 'Throws Tag Generator')
    ->newOptionalParameterUnknown('types', array(), 'Throws Types')
    ->newOptionalParameterUnknown('description', null, 'Throws Description')
    ->getBodyFromObj($obj, 'throwsTag');

$method = $class->newMethod('varTag', 'public', 'Var Tag Generator')
    ->newRequiredParameter('name', 'string', 'Var Name')
    ->newOptionalParameterUnknown('types', array(), 'Var Types')
    ->newOptionalParameterUnknown('description', null, 'Var Description')
    ->getBodyFromObj($obj, 'varTag');

file_put_contents($path, '<?php' . PHP_EOL . PHP_EOL . $class->generate());

$test = new FightTheIce\Coding\TestBuilder($class);
$test->buildSetup('$this->obj = new \FightTheIce\Coding\Describer("short","long");');
file_put_contents('tests/DescriberTest.php', '<?php' . PHP_EOL . PHP_EOL . $test->generate());