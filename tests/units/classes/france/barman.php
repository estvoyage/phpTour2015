<?php

namespace estvoyage\phpTour2015\tests\units\france;

require __DIR__ . '/../../runner.php';

use
	estvoyage\phpTour2015\tests\units,
	estvoyage\phpTour2015\alcohol,
	estvoyage\phpTour2015\barman\client,
	estvoyage\data,
	mock\estvoyage\data as mockOfData,
	mock\estvoyage\phpTour2015 as mockOfPhpTour2015
;

class barman extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\phpTour2015\barman')
		;
	}

	function testAlcoholDrinkIsAskedByClient()
	{
		$this
			->given(
				$client = new mockOfPhpTour2015\barman\client,
				$dataConsumer = new mockOfData\consumer,
				$this->newTestedInstance($dataConsumer)
			)
			->if(
				$this->calling($client)->ageIsRequiredByBarman->doesNothing
			)
			->then
				->object($this->testedInstance->alcoholDrinkIsAskedByClient($client))->isTestedInstance
				->mock($client)
					->receive('legalAgeToDrinkAlcoholIs')
						->withArguments(new client\age(18))
							->once
				->mock($dataConsumer)
					->receive('newData')
						->withArguments(new data\data('What is your age?'))
							->once
					->receive('newData')
						->withArguments(new data\data('I\'m sorry, the legal age to drink alcohol is 18 years old'))
							->once

			->if(
				$this->calling($client)->ageIsRequiredByBarman = function($barman) {
					$barman->clientAgeIs(new client\age(17));
				}
			)
			->then
				->object($this->testedInstance->alcoholDrinkIsAskedByClient($client))->isTestedInstance
				->mock($client)
					->receive('legalAgeToDrinkAlcoholIs')
						->withArguments(new client\age(18))
							->twice

			->if(
				$this->calling($client)->ageIsRequiredByBarman = function($barman) {
					$barman->clientAgeIs(new client\age(18));
				}
			)
			->then
				->object($this->testedInstance->alcoholDrinkIsAskedByClient($client))->isTestedInstance
				->mock($client)
					->receive('newAlcoholDrink')
						->withArguments(new alcohol\drink)
							->once
				->mock($dataConsumer)
					->receive('newData')
						->withArguments(new data\data('This is your drink!'))
							->once

			->if(
				$otherClient = new mockOfPhpTour2015\barman\client,
				$this->calling($otherClient)->ageIsRequiredByBarman = function($barman) {
					$barman->clientAgeIs(new client\age(17));
				},
				$this->calling($client)->ageIsRequiredByBarman = function($barman) use ($otherClient) {
					$barman->clientAgeIs(new client\age(18));
					$barman->alcoholDrinkIsAskedByClient($otherClient);
				}
			)
			->then
				->object($this->testedInstance->alcoholDrinkIsAskedByClient($client))->isTestedInstance
				->mock($client)
					->receive('newAlcoholDrink')
						->withArguments(new alcohol\drink)
							->twice
				->mock($otherClient)
					->receive('legalAgeToDrinkAlcoholIs')
						->withArguments(new client\age(18))
							->once
		;
	}
}
