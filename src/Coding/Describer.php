<?php

namespace FightTheIce\Coding;

use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\DocBlock\Tag\AuthorTag;
use Laminas\Code\Generator\DocBlock\Tag\GenericTag;
use Laminas\Code\Generator\DocBlock\Tag\LicenseTag;
use Laminas\Code\Generator\DocBlock\Tag\MethodTag;
use Laminas\Code\Generator\DocBlock\Tag\ParamTag;
use Laminas\Code\Generator\DocBlock\Tag\PropertyTag;
use Laminas\Code\Generator\DocBlock\Tag\ReturnTag;
use Laminas\Code\Generator\DocBlock\Tag\ThrowsTag;
use Laminas\Code\Generator\DocBlock\Tag\VarTag;

class Describer {
    protected $generator          = null;
    protected $allowDuplicateTags = false;
    protected $tags               = array();

    public function __construct( ? string $shortDescription = null,  ? string $longDescription = null, bool $allowDuplicateTags = false) {
        $this->generator          = new DocBlockGenerator();
        $this->allowDuplicateTags = $allowDuplicateTags;

        if (!empty($shortDescription)) {
            $this->setShortDescription($shortDescription);
        }

        if (!empty($longDescription)) {
            $this->setLongDescription($longDescription);
        }
    }

    public function getTags() {
        return $this->tags;
    }

    public function setShortDescription( ? string $shortDescription = null) {
        $this->generator->setShortDescription($shortDescription);

        return $this;
    }

    public function setLongDescription( ? string $longDescription = null) {
        $this->generator->setLongDescription($longDescription);

        return $this;
    }

    public function authorTag($authorName = null, $authorEmail = null) {
        $this->initTagArray('author');

        if ($this->allowDuplicateTags == false) {
            if (isset($this->tags['author'][0])) {
                throw new \ErrorException('Duplicate author tags are not allowed!');
            }
        }

        $this->tags['author'][] = new AuthorTag($authorName, $authorEmail);

        return $this;
    }

    public function genericTag($name = null, $content = null) {
        //genric tags may not be author,license,method,param,property,return,throws, or var
        switch (trim(strtolower($name))) {
        case 'author' :
        case 'license' :
        case 'method' :
        case 'param' :
        case 'property':
        case 'return':
        case 'throws':
        case 'var':
            throw new \ErrorException('Tag: ' . $name . ' must call the correct method');
            break;
        }

        $this->initTagArray('generic');

        if ($this->allowDuplicateTags == false) {
            if (isset($this->tags['generic'][$name])) {
                throw new \ErrorException('Duplicate generic tags are not allowed!');
            }
        }

        $this->tags['generic'][$name] = new GenericTag($name, $content);

        return $this;
    }

    public function licenseTag($url = null, $licenseName = null) {
        $this->initTagArray('license');

        if ($this->allowDuplicateTags == false) {
            if (isset($this->tags['license'][0])) {
                throw new \ErrorException('Duplicate license tags are not allowed!');
            }
        }

        $this->tags['license'][] = new LicenseTag($url, $licenseName);

        return $this;
    }

    public function methodTag($methodName = null, $types = [], $description = null, $isStatic = false) {
        $notAllowed = array('property', 'var');
        if ($this->tagMayNotBeUsedWith($notAllowed) == true) {
            throw new \ErrorException('Method tag may not be used with ' . implode(', ', $notAllowed) . ' tags');
        }

        $this->initTagArray('method');

        if ($this->allowDuplicateTags == false) {
            if (isset($this->tags['method'][0])) {
                throw new \ErrorException('Duplicate method tags are not allowed!');
            }
        }

        $this->tags['method'][] = new MethodTag($methodName, $types, $description, $isStatic);

        return $this;
    }

    public function paramTag($variableName = null, $types = [], $description = null) {
        $notAllowed = array('property', 'var');
        if ($this->tagMayNotBeUsedWith($notAllowed) == true) {
            throw new \ErrorException('Param tag may not be used with ' . implode(', ', $notAllowed) . ' tags');
        }

        //param tags may only be added if a method tag already exists
        if (!isset($this->tags['method'])) {
            throw new \ErrorException('A param tag may only exists after a method tag!');
        }

        $this->initTagArray('param');

        if ($this->allowDuplicateTags == false) {
            if (isset($this->tags['param'][$variableName])) {
                throw new \ErrorException('Duplicate param tags are not allowed!');
            }
        }

        //this will overwrite an existing param tag - which is sort of like not allowing duplicate tags
        //however if allowing duplicate tags is enabled this will completely overwrite the existing param
        //tag
        $this->tags['param'][$variableName] = new ParamTag($variableName, $types, $description);

        return $this;
    }

    public function propertyTag($propertyName = null, $types = [], $description = null) {
        $notAllowed = array('method', 'param', 'return', 'throws', 'var');
        if ($this->tagMayNotBeUsedWith($notAllowed) == true) {
            throw new \ErrorException('Property tag may not be used with ' . implode(', ', $notAllowed) . ' tags');
        }

        $this->initTagArray('property');

        if ($this->allowDuplicateTags == false) {
            if (isset($this->tags['property'][$propertyName])) {
                throw new \ErrorException('Duplicate property tags are not allowed!');
            }
        }

        //this will overwrite an existing property tag - which is sort of like not allowing duplicate tags
        //however if allowing duplicate tags is enabled this will completely overwrite the existing property
        //tag
        $this->tags['property'][$propertyName] = new PropertyTag($propertyName, $types, $description);

        return $this;
    }

    public function returnTag($types = [], $description = null) {
        $notAllowed = array('var');
        if ($this->tagMayNotBeUsedWith($notAllowed) == true) {
            throw new \ErrorException('Return tag may not be used with ' . implode(', ', $notAllowed) . ' tags');
        }

        //return tags may only be added if a method tag already exists
        if (!isset($this->tags['method'])) {
            throw new \ErrorException('A return tag may only exists after a method tag!');
        }

        $this->initTagArray('return');

        if ($this->allowDuplicateTags == false) {
            if (isset($this->tags['return'][0])) {
                throw new \ErrorException('Duplicate return tags are not allowed!');
            }
        }

        $this->tags['return'][] = new ReturnTag($types, $description);

        return $this;
    }

    public function throwsTag($types = [], $description = null) {
        $notAllowed = array('property', 'var');
        if ($this->tagMayNotBeUsedWith($notAllowed) == true) {
            throw new \ErrorException('Throws tag may not be used with ' . implode(', ', $notAllowed) . ' tags');
        }

        //throw tags may only be added if a method tag already exists
        if (!isset($this->tags['method'])) {
            throw new \ErrorException('A throw tag may only exists after a method tag!');
        }

        $this->initTagArray('throws');

        //to stop duplicate throw tags lets create a "fingerprint"
        $fingerprint = '';
        $print       = '';
        if (is_string($types)) {
            $print = $types . $description;
        } elseif (is_array($types)) {
            $print = implode('|', $types) . $description;
        } else {
            throw new \ErrorException('Parameter types must be a string or an array!');
        }

        $fingerprint = hash('sha512', $print);

        if ($this->allowDuplicateTags == false) {
            if (isset($this->tags['throws'][$fingerprint])) {
                throw new \ErrorException('Duplicate throw tags are not allowed!');
            }
        }

        $this->tags['throws'][$fingerprint] = new ThrowsTag($types, $description);

        return $this;
    }

    public function varTag( ? string $variableName = null, $types = [],  ? string $description = null) {
        $notAllowed = array('method', 'property');
        if ($this->tagMayNotBeUsedWith($notAllowed) == true) {
            throw new \ErrorException('Var tag may not be used with ' . implode(', ', $notAllowed) . ' tags');
        }

        $this->initTagArray('var');

        if ($this->allowDuplicateTags == false) {
            if (isset($this->tags['var'][$variableName])) {
                throw new \ErrorException('Duplicate var tags are not allowed!');
            }
        }

        $this->tags['var'][$variableName] = new VarTag($variableName, $types, $description);

        return $this;
    }

    protected function initTagArray($key) {
        if (!isset($this->tags[$key])) {
            $this->tags[$key] = array();
        }
    }

    public function getGenerator() {
        return $this->generator;
    }

    public function generate() {
        //lets add all our tags in now
        foreach ($this->tags as $tagType => $tags) {
            foreach ($tags as $tag) {
                $this->getGenerator()->setTag($tag);
            }
        }
        return $this->getGenerator()->generate();
    }

    protected function tagMayNotBeUsedWith($otherTags = []) {
        if (!empty($otherTags)) {
            foreach ($otherTags as $tagName) {
                if (isset($this->tags[$tagName])) {
                    //do we have at least one element in
                    if (count($this->tags[$tagName]) > 0) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function abstractTag() {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);

        return $this->genericTag('@abstract');
    }

    public function accessTag(string $visibility) {
        $visibility = trim(strtolower($visibility));
        switch ($visibility) {
        case 'public' :
        case 'private' :
        case 'protected':
            break;

        default:
            throw new \ErrorException('Visibility must be public, private, or protected');
            break;
        }

        return $this->genericTag('@access', $visibility);
    }

    public function categoryTag(string $categoryName) {
        return $this->genericTag('category', $categoryName);
    }

    public function copyrightTag(string $information) {
        return $this->genericTag('copyright', $information);
    }

    public function deprecatedTag( ? string $info = null) {
        return $this->genericTag('deprecated', $info);
    }

    public function exampleTag(string $path,  ? string $description = null) {
        $content = '';
        if (!empty($path)) {
            $content = $path;
        }

        if (!empty($description)) {
            if (empty($content)) {
                $content = $description;
            } else {
                $content = $content . ' ' . $description;
            }
        }

        return $this->genericTag('example', $content);
    }

    public function finalTag() {
        return $this->genericTag('final');
    }

    public function filesourceTag() {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);

        return $this->genericTag('@filesource');
    }

    public function globalTag($types = [], string $globalvariablename) {
        $content = array();
        if (is_string($types)) {
            $content[] = $types;
        } elseif (is_array($types)) {
            $content[] = implode('|', $types);
        } else {
            throw new \ErrorException('types parameter is expected to be data type string or array');
        }
        $content[] = $globalvariablename;

        return $this->genericTag('global', implode(' ', $content));
    }

    public function ignoreTag() {
        return $this->genericTag('ignore');
    }

    public function internalTag(string $info) {
        return $this->genericTag('internal', $info);
    }

    public function linkTag(string $url,  ? string $text = null) {
        return $this->genericTag('link', implode(' ', array($url, $text)));
    }

    public function nameTag(string $globalvariablename) {
        return $this->genericTag('name', $globalvariablename);
    }

    public function packageTag(string $packagename) {
        return $this->genericTag('package', $packagename);
    }

    public function seeTag(string $data) {
        return $this->genericTag('see', $data);
    }

    public function sinceTag(string $info) {
        return $this->genericTag('since', $info);
    }

    public function staticTag() {
        return $this->genericTag('static');
    }

    public function staticvarTag($types = [],  ? string $description = null) {
        $content = array();
        if (is_string($types)) {
            $content[] = $types;
        } elseif (is_array($types)) {
            $content[] = implode('|', $types);
        } else {
            throw new \ErrorException('types parameter must be of type string or array.');
        }

        if (!empty($description)) {
            $content[] = $description;
        }

        return $this->genericTag('staticvar', implode(' ', $content));
    }

    public function subpackageTag($subpackagename) {
        return $this->genericTag('subpackage', $subpackagename);
    }

    public function todoTag(string $info) {
        return $this->genericTag('todo', $info);
    }

    public function tutorialTag(string $info) {
        return $this->genericTag('tutorial', $info);
    }

    public function usesTag(string $info) {
        return $this->genericTag('uses', $info);
    }

    public function versionTag(string $versionstring) {
        return $this->genericTag('version', $versionstring);
    }

    public function hasData() {
        //does a shortDescription exists?
        if (!empty($this->getGenerator()->getShortDescription())) {
            return true;
        }

        //does a longDescription exists?
        if (!empty($this->getGenerator()->getLongDescription())) {
            return true;
        }

        //do we have any tags?
        if (!empty($this->tags)) {
            return true;
        }

        //this means we have no have docblock data
        return false;
    }
}