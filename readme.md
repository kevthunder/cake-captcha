# Captcha Plugin

for cakePHP 1.3

Form helper to add Captcha to cakePHP

## Installation

* put the content of this plugin in "app/plugins/" in a folder named "captcha".

## Getting started

In the model

```php
var $actsAs = array('Captcha.Captcha');
```

Load the helper

```php
var $helpers = array("Captcha.Captcha");
```

In the view

```php
echo $this->Captcha->captcha();
```