<?php

namespace estvoyage\phpTour2015\tests\units\decorator;

require __DIR__ . '/../../runner.php';

use
	estvoyage\phpTour2015\tests\units,
	estvoyage\data,
	mock\estvoyage\data as mockOfData
;

class prefix extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\data\consumer')
		;
	}

	function testDataProviderIs()
	{
		$this
			->given(
				$dataProvider = new mockOfData\provider
			)
			->if(
				$this->newTestedInstance(new data\data, new mockOfData\consumer)
			)
			->then
				->object($this->testedInstance->dataProviderIs($dataProvider))->isTestedInstance
				->mock($dataProvider)
					->receive('dataConsumerIs')
						->withArguments($this->testedInstance)
							->once
		;
	}

	function testNewData()
	{
		$this
			->given(
				$dataConsumer = new mockOfData\consumer,
				$prefixValue = new data\data(uniqid()),
				$data = new data\data(uniqid())
			)
			->if(
				$this->newTestedInstance($prefixValue, $dataConsumer)
			)
			->then
				->object($this->testedInstance->newData($data))->isTestedInstance
				->mock($dataConsumer)
					->receive('newData')
						->withArguments($prefixValue . $data)
							->once
		;
	}
}
