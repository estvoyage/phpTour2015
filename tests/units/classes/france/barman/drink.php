<?php

namespace estvoyage\phpTour2015\tests\units\france\barman;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\phpTour2015\tests\units
;

class drink extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\phpTour2015\alcohol\container')
			->isFinal
		;
	}
}
