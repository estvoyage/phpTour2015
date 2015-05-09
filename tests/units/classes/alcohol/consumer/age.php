<?php

namespace estvoyage\phpTour2015\tests\units\alcohol\consumer;

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
		;
	}

	function testIsGreaterThanOrEqualTo()
	{
		$this
			->given(
				$age = $this->newTestedInstance(0)
			)
			->if(
				$this->newTestedInstance(0)
			)
			->then
				->boolean($this->testedInstance->isGreaterThanOrEqualTo($age))->isTrue

			->if(
				$this->newTestedInstance(1)
			)
			->then
				->boolean($this->testedInstance->isGreaterThanOrEqualTo($age))->isTrue

			->given(
				$age = $this->newTestedInstance(1)
			)
			->if(
				$this->newTestedInstance(0)
			)
			->then
				->boolean($this->testedInstance->isGreaterThanOrEqualTo($age))->isFalse
		;
	}

	function testCallableIsIfGreaterThanOrEqualTo()
	{
		$this
			->given(
				$age = $this->newTestedInstance(0),
				$callable = function() use (& $call) { $call = true; }
			)
			->if(
				$call = false,
				$this->newTestedInstance(0)
			)
			->then
				->object($this->testedInstance->callableIsIfGreaterThanOrEqualTo($callable, $age))->isTestedInstance
				->boolean($call)->isTrue

			->if(
				$call = false,
				$this->newTestedInstance(1)
			)
			->then
				->object($this->testedInstance->callableIsIfGreaterThanOrEqualTo($callable, $age))->isTestedInstance
				->boolean($call)->isTrue

			->given(
				$age = $this->newTestedInstance(1)
			)
			->if(
				$call = false,
				$this->newTestedInstance(0)
			)
			->then
				->object($this->testedInstance->callableIsIfGreaterThanOrEqualTo($callable, $age))->isTestedInstance
				->boolean($call)->isFalse
		;
	}
}
