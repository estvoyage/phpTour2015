<?php

require __DIR__ . '/../vendor/autoload.php';

use
	estvoyage\data,
	estvoyage\phpTour2015\france,
	estvoyage\phpTour2015\decorator
;

$console = new data\consumer\console\cli;

(new france\barman(new decorator\prefix(new data\data('barman: '), $console)))
	->alcoholIsAskedByAlcoholConsumer(new france\teenager(new decorator\prefix(new data\data('teenager: '), $console)));
