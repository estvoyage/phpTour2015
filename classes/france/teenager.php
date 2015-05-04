<?php

namespace estvoyage\phpTour2015\france;

use
	estvoyage\data,
	estvoyage\phpTour2015
;

class teenager implements phpTour2015\barman\client
{
	private
		$dataConsumer
	;

	function __construct(data\consumer $dataConsumer)
	{
		$this->dataConsumer = $dataConsumer;
	}

	function ageIsRequiredByBarman(phpTour2015\barman $barman)
	{
		$this->dataConsumer->newData(new data\data('My age is 18 years old'));

		$barman->clientAgeIs(new phpTour2015\barman\client\age(18));

		return $this;
	}

	function legalAgeToDrinkAlcoholIs(phpTour2015\barman\client\age $age)
	{
		$this->dataConsumer->newData(new data\data('Oh… really?'));

		return $this;
	}

	function newAlcoholDrink(phpTour2015\alcohol\drink $drink)
	{
		$this->dataConsumer->newData(new data\data('Thanks!'));

		return $this;
	}
}
