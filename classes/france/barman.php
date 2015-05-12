<?php

namespace estvoyage\phpTour2015\france;

use
	estvoyage\data,
	estvoyage\phpTour2015\alcohol
;

class barman implements alcohol\provider
{
	private
		$dataConsumer,
		$serveAlcoholConsumer
	;

	private static
		$legalAge
	;

	function __construct(data\consumer $dataConsumer)
	{
		$this->dataConsumer = $dataConsumer;
	}

	function alcoholIsAskedByAlcoholConsumer(alcohol\consumer $alcoholConsumer)
	{
		(new self($this->dataConsumer))->serveAlcoholConsumer($alcoholConsumer);

		return $this;
	}

	function ageOfAlcoholConsumerIs(alcohol\consumer\age $age)
	{
		$age->executeIfGreaterOrEqualTo(
			function() { $this->serveAlcoholConsumer = true; },
			self::legalAge()
		);

		return $this;
	}

	private function serveAlcoholConsumer(alcohol\consumer $alcoholConsumer)
	{
		$this->dataConsumer->newData(new data\data('What is your age?'));

		$alcoholConsumer->ageIsRequiredByAlcoholProvider($this);

		! $this->serveAlcoholConsumer
			?
			$this->giveLegalAgeToAlcoholConsumer($alcoholConsumer)
			:
			$this->giveDrinkToAlcoholConsumer($alcoholConsumer)
		;

		return $this;
	}

	private function giveLegalAgeToAlcoholConsumer(alcohol\consumer $alcoholConsumer)
	{
		$this->dataConsumer->newData(new data\data('I\'m sorry, the legal age to drink alcohol is ' . self::legalAge() . ' years old'));

		$alcoholConsumer->legalAgeToConsumeAlcoholIs(self::legalAge());

		return $this;
	}

	private function giveDrinkToAlcoholConsumer(alcohol\consumer $alcoholConsumer)
	{
		$this->dataConsumer->newData(new data\data('This is your drink!'));

		$alcoholConsumer->newAlcoholContainer(new barman\drink);

		return $this;
	}

	private static function legalAge()
	{
		return self::$legalAge ?: (self::$legalAge = new alcohol\consumer\age(18));
	}
}
