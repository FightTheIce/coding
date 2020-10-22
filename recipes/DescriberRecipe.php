<?php

$path = 'src/Describer.php';

$obj = new FightTheIce\Coding\Describer("short", "long");

//kick off a new class builder
$class = new \FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\Describer', 'Describer', 'This class is responsible for interacting with the Laminas docblock generator.');

//if we want to update the class docblock for any reason
//$class->getDescriber()->getGenerator();

//add the following class uses
$class->uses('Laminas\Code\Generator\DocBlockGenerator');
$class->uses('Laminas\Code\Generator\DocBlock\Tag\AuthorTag');
$class->uses('Laminas\Code\Generator\DocBlock\Tag\GenericTag');
$class->uses('Laminas\Code\Generator\DocBlock\Tag\LicenseTag');
$class->uses('Laminas\Code\Generator\DocBlock\Tag\MethodTag');
$class->uses('Laminas\Code\Generator\DocBlock\Tag\ParamTag');
$class->uses('Laminas\Code\Generator\DocBlock\Tag\PropertyTag');
$class->uses('Laminas\Code\Generator\DocBlock\Tag\ReturnTag');
$class->uses('Laminas\Code\Generator\DocBlock\Tag\ThrowsTag');
$class->uses('Laminas\Code\Generator\DocBlock\Tag\VarTag');

//add some additional tags to the class docblock
$class->getDescriber()->tag('namespace', 'FightTheIce\Coding');
$class->getDescriber()->tag('author', 'William Knauss');

//lets generate some properties
$class->newProperty('generator', null, 'protected', 'The generator object - Laminas\Code\Generator\DocBlockGenerator');
$property = $class->getProperty('generator');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->generatorTag()

$property = $class->getProperty('generator');
$property->getDescriber()->tag('property', 'NULL $generator The generator object -   Laminas\Code\Generator\DocBlockGenerator'); #in the future this should use $property->getDescriber()->generatorTag()

$method = $class->newMethod('__construct', 'public', 'Class Construct');
$method->newOptionalParameter('short', '', 'string', 'A string containing the short description');
$method->newOptionalParameter('long', '', 'string', 'A string containing the long description');
$method->getBodyFromObj($obj, '__construct');

$method = $class->newMethod('getGenerator', 'public', 'Get the property generator');
$method->getBodyFromObj($obj, 'getGenerator');

$method = $class->newMethod('short', 'public', 'DocBlock short description');
$method->newRequiredParameter('desc', 'string', 'A string containg the short description');
$method->getBodyFromObj($obj, 'short');

$method = $class->newMethod('long', 'public', 'DocBlock long description');
$method->newRequiredParameter('desc', 'string', 'A string containing the long description');
$method->getBodyFromObj($obj, 'long');

$method = $class->newMethod('tag', 'public', 'DocBlock Tag Generator');
$method->newRequiredParameter('name', 'string', 'Tag Name');
$method->newRequiredParameter('value', 'string', 'Tag Value');
$method->getBodyFromObj($obj, 'tag');

$method = $class->newMethod('genericTag', 'public', 'DocBlock Tag Generator');
$method->newRequiredParameter('name', 'string', 'Tag Name');
$method->newRequiredParameter('value', 'string', 'Tag Value');
$method->getBodyFromObj($obj, 'genericTag');

$method = $class->newMethod('authorTag', 'public', 'Author Tag Generator');
$method->newOptionalParameter('name', null, 'string', 'A string containing the authors name');
$method->newOptionalParameter('email', null, 'string', 'A string containing the authors\'s email address');
$method->getBodyFromObj($obj, 'authorTag');

$method = $class->newMethod('licenseTag', 'public', 'License Tag Generator');
$method->newOptionalParameter('url', null, 'string', 'URL');
$method->newOptionalParameter('licenseName', null, 'string', '');
$method->getBodyFromObj($obj, 'licenseTag');

$method = $class->newMethod('methodTag', 'public', 'Method Tag Generator');
$method->newOptionalParameter('name', null, 'string', 'Method Name');
$method->newOptionalParameterUnknown('types', array(), '');
$method->newOptionalParameterUnknown('description', null, '');
$method->newOptionalParameterUnknown('isStatic', false, '');
$method->getBodyFromObj($obj, 'methodTag');

$method = $class->newMethod('paramTag', 'public', 'Param Tag Generator');
$method->newRequiredParameter('name', 'string', 'Param Name');
$method->newOptionalParameterUnknown('types', array(), '');
$method->newOptionalParameterUnknown('description', null, '');
$method->getBodyFromObj($obj, 'paramTag');

$method = $class->newMethod('propertyTag', 'public', 'Property Tag Generator');
$method->newRequiredParameter('name', 'string', 'Property name');
$method->newOptionalParameterUnknown('types', array(), '');
$method->newOptionalParameterUnknown('description', null, '');
$method->getBodyFromObj($obj, 'propertyTag');

$method = $class->newMethod('returnTag', 'public', 'Return Tag Generator');
$method->newOptionalParameterUnknown('types', array(), '');
$method->newOptionalParameterUnknown('description', null, '');
$method->getBodyFromObj($obj, 'returnTag');

$method = $class->newMethod('throwsTag', 'public', 'Throws Tag Generator');
$method->newOptionalParameterUnknown('types', array(), '');
$method->newOptionalParameterUnknown('description', null, '');
$method->getBodyFromObj($obj, 'throwsTag');

$method = $class->newMethod('varTag', 'public', 'Var Tag Generator');
$method->newRequiredParameter('name', 'string', 'Var Name');
$method->newOptionalParameterUnknown('types', array(), '');
$method->newOptionalParameterUnknown('description', null, '');
$method->getBodyFromObj($obj, 'varTag');

file_put_contents($path, '<?php' . PHP_EOL . PHP_EOL . $class->generate());

$test = new FightTheIce\Coding\TestBuilder($class);
$test->buildSetup('$this->obj = new \FightTheIce\Coding\Describer("short","long");');
file_put_contents('tests/DescriberTest.php', '<?php' . PHP_EOL . PHP_EOL . $test->generate());
