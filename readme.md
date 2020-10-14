# Fight The Ice Coding

This allows a developer to code PHP by using PHP. This "framework" is very opinionated so don't use it.

It also contains minimal functionality again don't use it.

This project is built on top of "laminas/laminas-code".

## Installation
```bash
$ composer require fighttheice/coding
```

## Usage

To code a class use the following as a template (pysdo code)

```php
<?php
	//kick off a class generator
	$class_generator = new FightTheIce\Coding\ClassBuilder('My\Name\Space\AwesomeClass','My Awesome Class','This is a really long class description');

	//add a use statement to our class
	$class_generator->uses('Some\Other\Class');

	//you can also alias our use statement
	$class_generator->uses('Some\Other\Class","ShortName');

	//add a new property to our class
	$class_generator->newProperty('mypropertyname','defaultValue','protected','Long Description');
################################################################################################################
	//add a new method to our class
	$method = $class_generator->newMethod('methodName','public','Long Description of method');

	//add a required parameter 
	$method->newRequiredParameter('parametername','string','Description');

	//set the body of the method
	$method->setBody('return $this;');
################################################################################################################
	//compile our results
	$class_generator->compile();

	//generate the contents of your class
	$contents = $class_generator->getGenerator()->generate();
```

The above will result in 
```php
namespace My\Name\Space;

use Some\Other\Somewhere\Class;
use Some\Other\Class as ShortName;

/**
 * My Awesome Class
 *
 * This is a really long class description
 *
 * @namespace My\Name\Space
 */
class AwesomeClass
{

    /**
     * mypropertyname
     *
     * Long Description
     *
     * @access protected
     */
    public $mypropertyname = 'defaultValue';

    /**
     * methodName
     *
     * Long Description of method
     *
     * @access public
     * @param parametername - Description
     */
    public function methodName(string $parametername)
    {
        return $this;
    }


}
```