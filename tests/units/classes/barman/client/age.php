<?php

namespace estvoyage\phpTour2015\tests\units\barman\client;

require __DIR__. '/../../../runner.php';

use
	estvoyage\phpTour2015\tests\units
;

class age extends units\test
{
	function testClass()
	{
		$this->testedClass
			->isFinal
			->extends('estvoyage\value\integer\unsigned')
		;
	}
}
