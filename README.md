# *estvoyage\phpTour2015*

This repository contains the code used during a talk about east-oriented code given during PHP Tour 2015, in Luxembourg.  
It's a very basic but fully working code, with unit tests, to illustrate the east concept and its advantages.  

## Installation

Minimal PHP version to use *estvoyage\phpTour2015* is 5.6.  
The recommended way to install it through [Composer](http://getcomposer.org/), just clone the repository and execute `php composer.phar install`.

## Usage

A working script is available in the bundled `examples` directory, just do `php examples/nutshell.php` to execute it.

## Unit Tests

Setup the test suite using Composer:

    $ composer install --dev

Run it using **atoum**:

    $ vendor/bin/atoum

## I want more information about east-oriented code!

Feel free to join the IRC channel `##east` on Freenode !

## License

*estvoyage\phpTour2015* is released under the FreeBSD License, see the bundled `COPYING` file for details.
