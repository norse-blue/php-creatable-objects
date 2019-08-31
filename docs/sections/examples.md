---
layout: default
title: Examples
nav_order: 3
permalink: /examples
---

# Examples
{: .no_toc }

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}

---

The following examples are equivalent, each having its caveats.

## Example with inheritance

```php
<?php

declare(strict_type=1);

namespace NorseBlue\CreatableObjects\Examples;

use NorseBlue\CreatableObjects\CreatableObject;

class Path extends CreatableObject
{
    private $path;
    
    private function __construct(string $path)
    {
        $this->path = $path;
    }

    public function __toString()
    {
        return $this->path;
    }
}

```

## Example with composition

```php
<?php

declare(strict_type=1);

namespace NorseBlue\CreatableObjects\Examples;

use NorseBlue\CreatableObjects\Contracts\Creatable;
use NorseBlue\CreatableObjects\Traits\HandlesObjectCreation;

class Path implements Creatable
{
    use HandlesObjectCreation;

    private $path;
    
    private function __construct(string $path)
    {
        $this->path = $path;
    }

    public function __toString()
    {
        return $this->path;
    }
}

```
