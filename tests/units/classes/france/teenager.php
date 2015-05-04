<?php

namespace estvoyage\phpTour2015\tests\units\france;

require __DIR__ . '/../../runner.php';

use
	estvoyage\phpTour2015\tests\units,
	estvoyage\data,
	estvoyage\phpTour2015,
	mock\estvoyage\data as mockOfData,
	mock\estvoyage\phpTour2015 as mockOfPhpTour2015
;

class teenager extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\phpTour2015\barman\client')
		;
	}

	function testAgeIsRequiredByBarman()
	{
		$this
			->given(
				$dataConsumer = new mockOfData\consumer,
				$barman = new mockOfPhpTour2015\barman
			)
			->if(
				$this->newTestedInstance($dataConsumer)
			)
			->then
				->object($this->testedInstance->ageIsRequiredByBarman($barman))->isTestedInstance
				->mock($barman)
					->receive('clientAgeIs')
						->withArguments(new phpTour2015\barman\client\age(18))
							->once
				->mock($dataConsumer)
					->receive('newData')
						->withArguments(new data\data('My age is 18 years old'))
							->once
		;
	}

	function testLegalAgeToDrinkAlcoholIs()
	{
		$this
			->given(
				$dataConsumer = new mockOfData\consumer
			)
			->if(
				$this->newTestedInstance($dataConsumer)
			)
			->then
				->object($this->testedInstance->legalAgeToDrinkAlcoholIs(new phpTour2015\barman\client\age(18)))->isTestedInstance
				->mock($dataConsumer)
					->receive('newData')
						->withArguments(new data\data('Oh… really?'))
							->once
		;
	}

	function testNewAlcoholDrink()
	{
		$this
			->given(
				$dataConsumer = new mockOfData\consumer
			)
			->if(
				$this->newTestedInstance($dataConsumer)
			)
			->then
				->object($this->testedInstance->newAlcoholDrink(new phpTour2015\alcohol\drink))->isTestedInstance
				->mock($dataConsumer)
					->receive('newData')
						->withArguments(new data\data('Thanks!'))
							->once
		;
	}
}
