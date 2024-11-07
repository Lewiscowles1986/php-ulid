# php-ulid
Universally Unique Lexicographically Sortable Identifier ported to PHP

[![PHP Composer](https://github.com/Lewiscowles1986/php-ulid/actions/workflows/php.yml/badge.svg?branch=main)](https://github.com/Lewiscowles1986/php-ulid/actions/workflows/php.yml)

Tests borrowed from [.NET port](https://github.com/fvilers/ulid.net)  
Original idea borrowed from [JS](https://github.com/alizain/ulid)  

License AGPL

## Requirements

PHP7.4+

## Usage:

`composer require lewiscowles/ulid`

## Tests:

To generate the coverage report xdebug extension must be enabled for your PHP

### Unit-test CLI

`php vendor/bin/phpunit --coverage-html ./reports/ --whitelist src`

### Mutation testing with infection

`php vendor/bin/infection`

### PHPStan

`php vendor/bin/phpstan analyse src -l max`

### Jenkins pipeline step for testing

```Groovy
    stage('Run Unit Tests in PHP') {
        dir('ulid') {
            sh 'php vendor/bin/phpunit --coverage-html ./reports/ --whitelist src'
        }
        publishHTML([allowMissing: true, alwaysLinkToLastBuild: false, keepAll: true, reportDir: 'ulid/reports', reportFiles: 'index.html', reportName: 'PHPUnit Coverage'])
    }
```

## Got an idea?

Create an issue, a PR, both (if possible) :smile_cat:
