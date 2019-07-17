# PHPStan Shopware rules

* [PHPStan](https://github.com/phpstan/phpstan)

This extension provides following features:

* Provides rules for checking debug functions
* Provides rules for deprecated functions
* Provides rules for bad practise code usages


## Installation

To use this extension, require it in [Composer](https://getcomposer.org/):

```
composer require --dev shyim/phpstan-shopware
```

<details>
  <summary>Manual installation</summary>

Include extension.neon in your project's PHPStan config:

```
includes:
    - vendor/shyim/phpstan-shopware/extension.neon
```
</details>