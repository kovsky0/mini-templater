# MiniTemplater class
A simple helper class to process variables and alternative strings.
Based on Spintax by Jason Davis.

## Installation
Install via [Composer](https://getcomposer.org/)

```bash
composer require kovsky0/mini-templater
```

## Getting started
To get started you need to require mini-templater.php

```php
<?php
require_once('vendor/autoload.php');
```

## How to use it
Processing alternatives:
```php
<?php
$templater = new MiniTemplater;
$example = "This is an {{example.|exemplary usage of the class.}}";
echo $templater->process($example);
```
Processing alternatives recursively:
```php
<?php
$templater = new MiniTemplater;
$example = "This is an {{example.|exemplary usage of {{the|my}} class.}}";
echo $templater->process($example);
```
Processing variables:
```php
<?php
$templater = new MiniTemplater;
$example = "This is an [[example_text]]";
$variables = array("example_text" => "exemplary usage of the class.");
echo $templater->process($example, $variables);
```
Processing alternatives inside variables:
```php
<?php
$templater = new MiniTemplater;
$example = "This is an [[example_text]]";
$variables = array("example_text" => "{{example.|exemplary usage of the class.}}");
echo $templater->process($example, $variables);
```
