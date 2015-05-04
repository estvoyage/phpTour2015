<?php

namespace estvoyage\phpTour2015\tests\units;

class test extends \atoum
{
	function beforeTestMethod($method)
	{
		$this->mockGenerator->allIsInterface();
	}
}
