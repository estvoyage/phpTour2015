<?php

namespace estvoyage\phpTour2015\tests\units\france;

require __DIR__ . '/../../runner.php';

use
	estvoyage\phpTour2015\tests\units,
	estvoyage\phpTour2015\france,
	estvoyage\phpTour2015\alcohol,
	estvoyage\data,
	mock\estvoyage\data as mockOfData,
	mock\estvoyage\phpTour2015 as mockOfPhpTour2015
;

class barman extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\phpTour2015\alcohol\provider')
		;
	}

	function testAlcoholIsAskedByAlcoholConsumer()
	{
		$this
			->given(
				$alcoholConsumer = new mockOfPhpTour2015\alcohol\consumer,
				$dataConsumer = new mockOfData\consumer,
				$this->newTestedInstance($dataConsumer)
			)
			->if(
				$this->calling($alcoholConsumer)->ageIsRequiredByAlcoholProvider->doesNothing
			)
			->then
				->object($this->testedInstance->alcoholIsAskedByAlcoholConsumer($alcoholConsumer))->isTestedInstance
				->mock($alcoholConsumer)
					->receive('legalAgeToConsumeAlcoholIs')
						->withArguments(new alcohol\consumer\age(18))
							->once
				->mock($dataConsumer)
					->receive('newData')
						->withArguments(new data\data('What is your age?'))
							->once
					->receive('newData')
						->withArguments(new data\data('I\'m sorry, the legal age to drink alcohol is 18 years old'))
							->once

			->if(
				$this->calling($alcoholConsumer)->ageIsRequiredByAlcoholProvider = function($alcoholProvider) {
					$alcoholProvider->ageOfAlcoholConsumerIs(new alcohol\consumer\age(17));
				}
			)
			->then
				->object($this->testedInstance->alcoholIsAskedByAlcoholConsumer($alcoholConsumer))->isTestedInstance
				->mock($alcoholConsumer)
					->receive('legalAgeToConsumeAlcoholIs')
						->withArguments(new alcohol\consumer\age(18))
							->twice

			->if(
				$this->calling($alcoholConsumer)->ageIsRequiredByAlcoholProvider = function($alcoholProvider) {
					$alcoholProvider->ageOfAlcoholConsumerIs(new alcohol\consumer\age(18));
				}
			)
			->then
				->object($this->testedInstance->alcoholIsAskedByAlcoholConsumer($alcoholConsumer))->isTestedInstance
				->mock($alcoholConsumer)
					->receive('newAlcoholContainer')
						->withArguments(new france\barman\drink)
							->once
				->mock($dataConsumer)
					->receive('newData')
						->withArguments(new data\data('This is your drink!'))
							->once

			->if(
				$otherAlcoholConsumer = new mockOfPhpTour2015\alcohol\consumer,
				$this->calling($otherAlcoholConsumer)->ageIsRequiredByAlcoholProvider = function($alcoholProvider) {
					$alcoholProvider->ageOfAlcoholConsumerIs(new alcohol\consumer\age(17));
				},
				$this->calling($alcoholConsumer)->ageIsRequiredByAlcoholProvider = function($alcoholProvider) use ($otherAlcoholConsumer) {
					$alcoholProvider->ageOfAlcoholConsumerIs(new alcohol\consumer\age(18));
					$alcoholProvider->alcoholIsAskedByAlcoholConsumer($otherAlcoholConsumer);
				}
			)
			->then
				->object($this->testedInstance->alcoholIsAskedByAlcoholConsumer($alcoholConsumer))->isTestedInstance
				->mock($alcoholConsumer)
					->receive('newAlcoholContainer')
						->withArguments(new france\barman\drink)
							->twice
				->mock($otherAlcoholConsumer)
					->receive('legalAgeToConsumeAlcoholIs')
						->withArguments(new alcohol\consumer\age(18))
							->once
		;
	}
}
