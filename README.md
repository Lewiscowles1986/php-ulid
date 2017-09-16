# php-ulid
Universally Unique Lexicographically Sortable Identifier ported to PHP

![travis ci build status](https://travis-ci.org/Lewiscowles1986/php-ulid.svg?branch=master)

Tests borrowed from [.NET port](https://github.com/fvilers/ulid.net)  
Original idea borrowed from [JS](https://github.com/alizain/ulid)  

License AGPL

## Requirements

PHP7

## Usage:

`composer require lewiscowles/ulid`

## Tests:

To generate the coverage report xdebug extension must be enabled for your PHP

### CLI

`php vendor/bin/phpunit --coverage-html ./reports/ --whitelist src`

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
