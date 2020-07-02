Toy Robot simulator
Edward Murrell
edward.murrell@codefoundation.com.au, edward@murrell.co.nz
July, 2020

Requirements: PHP 7.4, composer

# Requirements
- PHP 7.4
- Composer (https://getcomposer.org)

# Installation
This program has dependencies installed by composer.
The following command needs to be run before to install dependencies.

```shell script
composer install -n
```

# Running
The program can be run by calling the file `robot.php` with a single argument of the text file to run through.

There are sample output files in the `examples/` directory. The functional tests also make use of these files.

Results will be sent to stdout.

```shell script
./bin/robot.php examples/exampleA.txt
# This should print 0,1,NORTH
# OR
php bin/robot.php examples/complex.txt
# This should print
# 0,1,NORTH
# 2,2,EAST
# 3,4,NORTH
```

# Testing
Toy Robot has good set of Unit Tests, and a functional tests of all files in `examples/`. Static analysis should also
 be run using `phpstan`.

Once the requirements have been installed using composer indicated in the Installation section, run the following to
 test the program.

```shell script
vendor/bin/phpunit
vendor/bin/phpstan analyse --level=8 src tests
```

# Implementation Notes

## Principles
- *Test Driven Development (TDD)* Red tests for desired functionality are written before implementing the code.
- *Atomic commits* Commits are well written and define a single change.

## Design considerations
The application was built to be as type safe as possible in a PHP application, and uses iterators to keep memory usage
 as low as possible.

The single file in `bin/` acts as combination Controller/Dependency Injection container. This is acceptable for a
 project of this size, but should be replaced with a library solution if more complex configuration, or alternative
 inputs are used.

The Board object deliberately contains logic to allow the future possibility of allowing non-rectangular boards. The
 Robot object is a self-contained state object, and in a multi-robot context would be built in a factory class.

## Future work

Future work options:

- Docker - Create a Docker container for development/running this application.
- Error handling - Errors for missing the file argument could be better.
- Coverage tests - Add coverage reporting and requirements to the codebase.
- Code style testing - PHP Code Sniffer, etc.
- Continuous Integration - Add CircleCI for running tests, phpstan, code style testers.
- Improve input parser - `FileInterpreter` could handle whitespace more liberally.
- Alternative input formats - Allow passing instructions in as JSON, or XML.
- Allow multiple input files - Allow passing in multiple input files as a set of sequential instructions.
- Configurable board sizes - Allow setting the board size at run time.
- Non square boards - Boards could have a varying geometries.
- Multiple robots
- Shore up the terminology differences between `Instruct` and `Command`
