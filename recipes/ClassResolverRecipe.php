<?php

$path = 'src/ClassResolver.php';

$obj = new FightTheIce\Coding\ClassResolver('FightTheIce\Coding\ClassResolver');

//kick off a new class builder
$class = new \FightTheIce\Coding\ClassBuilder('FightTheIce\Coding\ClassResolver', '', '');

//if we want to update the class docblock for any reason
//$class->getDescriber()->getGenerator();

//add the following class uses
$class->uses('Laminas\Code\Generator\DocBlock\TagManager');
$class->uses('Laminas\Code\Reflection\ClassReflection');
$class->uses('Laminas\Code\Reflection\DocBlock\Tag\TagInterface');

//add some additional tags to the class docblock
$class->getDescriber()->tag('namespace', 'FightTheIce\Coding');

//lets generate some properties
$class->newProperty('reflection', null, 'protected', '');
$property = $class->getProperty('reflection');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->reflectionTag()

$property = $class->getProperty('reflection');
$property->getDescriber()->tag('property', 'NULL $reflection'); #in the future this should use $property->getDescriber()->reflectionTag()

$class->newProperty('objNonConstruct', null, 'protected', '');
$property = $class->getProperty('objNonConstruct');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->objnonconstructTag()

$property = $class->getProperty('objNonConstruct');
$property->getDescriber()->tag('property', 'NULL $objNonConstruct'); #in the future this should use $property->getDescriber()->objnonconstructTag()

$class->newProperty('builder', null, 'protected', '');
$property = $class->getProperty('builder');
$property->getDescriber()->tag('access', 'protected'); #in the future this should use $property->getDescriber()->builderTag()

$property = $class->getProperty('builder');
$property->getDescriber()->tag('property', 'NULL $builder'); #in the future this should use $property->getDescriber()->builderTag()

$method = $class->newMethod('__construct', 'public', '');
$method->newRequiredParameterUnknown('classObjOrName', '');
$method->getBodyFromObj($obj, '__construct');

$method = $class->newMethod('classMeta', 'public', '');
$method->getBodyFromObj($obj, 'classMeta');

$method = $class->newMethod('propertiesMeta', 'public', '');
$method->getBodyFromObj($obj, 'propertiesMeta');

$method = $class->newMethod('methodsMeta', 'public', '');
$method->getBodyFromObj($obj, 'methodsMeta');

$method = $class->newMethod('build', 'public', '');
$method->getBodyFromObj($obj, 'build');

$method = $class->newMethod('buildClassMeta', 'protected', '');
$method->getBodyFromObj($obj, 'buildClassMeta');

$method = $class->newMethod('buildPropertiesMeta', 'protected', '');
$method->getBodyFromObj($obj, 'buildPropertiesMeta');

$method = $class->newMethod('buildMethodsMeta', 'protected', '');
$method->getBodyFromObj($obj, 'buildMethodsMeta');

$method = $class->newMethod('addToBuilder', 'protected', '');
$method->newRequiredParameter('str', 'string', '');
$method->newOptionalParameter('includeEmptyLine', false, 'bool', '');
$method->getBodyFromObj($obj, 'addToBuilder');

$method = $class->newMethod('gcm', 'protected', '');
$method->newRequiredParameterUnknown('obj', '');
$method->getBodyFromObj($obj, 'gcm');

$method = $class->newMethod('pexit', 'protected', '');
$method->newRequiredParameterUnknown('obj', '');
$method->getBodyFromObj($obj, 'pexit');

$method = $class->newMethod('extractTagAsGeneric', 'protected', '');
$method->newRequiredParameter('tag', 'Laminas\Code\Reflection\DocBlock\Tag\TagInterface', '');
$method->getBodyFromObj($obj, 'extractTagAsGeneric');

$method = $class->newMethod('exportArray', 'protected', '');
$method->newRequiredParameter('arr', 'array', '');
$method->getBodyFromObj($obj, 'exportArray');

$method = $class->newMethod('exportDataTypeAsString', 'protected', '');
$method->newRequiredParameterUnknown('data', '');
$method->getBodyFromObj($obj, 'exportDataTypeAsString');

file_put_contents($path, '<?php' . PHP_EOL . PHP_EOL . $class->generate());

$test = new FightTheIce\Coding\TestBuilder($class);
$test->buildSetup('$this->obj = new \FightTheIce\Coding\ClassResolver("FightTheIce\Coding\ClassResolver");');
file_put_contents('tests/ClassBuilderTest.php', '<?php' . PHP_EOL . PHP_EOL . $test->generate());
