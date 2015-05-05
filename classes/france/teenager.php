<?php

namespace estvoyage\phpTour2015\france;

use
	estvoyage\data,
	estvoyage\phpTour2015\alcohol
;

class teenager implements alcohol\consumer
{
	private
		$dataConsumer
	;

	function __construct(data\consumer $dataConsumer)
	{
		$this->dataConsumer = $dataConsumer;
	}

	function ageIsRequiredByAlcoholProvider(alcohol\provider $alcoholProvider)
	{
		$this->dataConsumer->newData(new data\data('My age is 18 years old'));

		$alcoholProvider->ageOfAlcoholConsumerIs(new alcohol\consumer\age(18));

		return $this;
	}

	function legalAgeToConsumeAlcoholIs(alcohol\consumer\age $age)
	{
		$this->dataConsumer->newData(new data\data('Oh… really?'));

		return $this;
	}

	function newAlcoholContainer(alcohol\container $alcoholContainer)
	{
		$this->dataConsumer->newData(new data\data('Thanks!'));

		return $this;
	}
}
