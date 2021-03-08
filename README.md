ExpertSender API PHP
====================

![CI](https://github.com/encreinformatique/expertsender-api-php/workflows/CI/badge.svg)

This project is a PHP wrapper for the ExpertSender API

This is a fork from [expertsenderfr/expertsender-api-php](https://github.com/expertsenderfr/expertsender-api-php)
While the original codebase supported PHP 5.6 and 7.0, I decided to drop it.
They ended their life and I do not use them either. The `symfony/serializer` changes for XmlEncoder constructor made it
difficult to maintain Symfony versions prior to 4.2. They have ended their life anyway.

For those versions of PHP or Symfony 3.4, please refer to the original codebase.

The name into the composer has now changed to `encreinformatique/expertsender-api-php`.
The namespace has not changed and remains the same.

Installation instruction
------------------------
1. Add the repository to your composer.json
```json
 "repositories": [
   {
     "type": "git",
     "url": "git@github.com:encreinformatique/expertsender-api-php.git"
   }
 ],
```

2. Add the package to your dependencies by running
`composer require encreinformatique/expertsender-api-php`

Services documentation
----------------------

- [Subscribers](docs/services/subscribers.md): Service used to add, update or remove subscribers to a list
