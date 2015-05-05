<?php

namespace estvoyage\phpTour2015\tests\units\france;

require __DIR__ . '/../../runner.php';

use
	estvoyage\phpTour2015\tests\units,
	estvoyage\data,
	estvoyage\phpTour2015,
	estvoyage\phpTour2015\alcohol,
	mock\estvoyage\data as mockOfData,
	mock\estvoyage\phpTour2015 as mockOfPhpTour2015
;

class teenager extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\phpTour2015\alcohol\consumer')
		;
	}

	function testAgeIsRequiredByAlcoholProvider()
	{
		$this
			->given(
				$dataConsumer = new mockOfData\consumer,
				$alcoholProvider = new mockOfPhpTour2015\alcohol\provider
			)
			->if(
				$this->newTestedInstance($dataConsumer)
			)
			->then
				->object($this->testedInstance->ageIsRequiredByAlcoholProvider($alcoholProvider))->isTestedInstance
				->mock($alcoholProvider)
					->receive('ageOfAlcoholConsumerIs')
						->withArguments(new alcohol\consumer\age(18))
							->once
				->mock($dataConsumer)
					->receive('newData')
						->withArguments(new data\data('My age is 18 years old'))
							->once
		;
	}

	function testLegalAgeToConsumeAlcoholIs()
	{
		$this
			->given(
				$dataConsumer = new mockOfData\consumer
			)
			->if(
				$this->newTestedInstance($dataConsumer)
			)
			->then
				->object($this->testedInstance->legalAgeToConsumeAlcoholIs(new alcohol\consumer\age(18)))->isTestedInstance
				->mock($dataConsumer)
					->receive('newData')
						->withArguments(new data\data('Oh… really?'))
							->once
		;
	}

	function testNewAlcoholContainer()
	{
		$this
			->given(
				$dataConsumer = new mockOfData\consumer
			)
			->if(
				$this->newTestedInstance($dataConsumer)
			)
			->then
				->object($this->testedInstance->newAlcoholContainer(new mockOfPhpTour2015\alcohol\container))->isTestedInstance
				->mock($dataConsumer)
					->receive('newData')
						->withArguments(new data\data('Thanks!'))
							->once
		;
	}
}
