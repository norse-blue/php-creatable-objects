---
layout: default
title: Usage
nav_order: 2
permalink: /usage
---

# Usage
{: .no_toc }

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}

---

There are different ways of using this package which will be outlined further down. Choose whatever suits your needs better.

## Using Inheritance

The most simple way to use the package is by extending the `CreatableObject` class:

```php
use NorseBlue\CreatableObjects\CreatableObject;

class MyObject extends CreatableObject
{
    private function __construct() { }
}
```

[See complete example]({{ site.baseurl }}{% link sections/examples.md %}#example-with-inheritance)

## Using Composition 

If you prefer composition over inheritance, you can use the provided trait and interface instead:

```php
use NorseBlue\CreatableObjects\Contracts\Creatable;
use NorseBlue\CreatableObjects\Traits\HandlesObjectCreation;

class MyObject implements Creatable
{
    use HandlesObjectCreation;
    
    private function __construct() { }
}
```

[See complete example]({{ site.baseurl }}{% link sections/examples.md %}#example-with-composition)
