<?php

namespace estvoyage\phpTour2015\france;

use
	estvoyage\data,
	estvoyage\phpTour2015,
	estvoyage\phpTour2015\alcohol,
	estvoyage\phpTour2015\barman\client
;

class barman implements phpTour2015\barman
{
	private
		$dataConsumer,
		$serveClient
	;

	private static
		$legalAge
	;

	function __construct(data\consumer $dataConsumer)
	{
		$this->dataConsumer = $dataConsumer;
	}

	function alcoholDrinkIsAskedByClient(client $client)
	{
		(new self($this->dataConsumer))->serveClient($client);

		return $this;
	}

	function clientAgeIs(client\age $age)
	{
		$this->serveClient = $age->asInteger >= self::legalAge()->asInteger;

		return $this;
	}

	private function serveClient(client $client)
	{
		$this->dataConsumer->newData(new data\data('What is your age?'));

		$client->ageIsRequiredByBarman($this);

		! $this->serveClient
			?
			$this->giveLegalAgeToClient($client)
			:
			$this->giveDrinkToClient($client)
		;

		return $this;
	}

	private function giveLegalAgeToClient(client $client)
	{
		$this->dataConsumer->newData(new data\data('I\'m sorry, the legal age to drink alcohol is ' . self::legalAge() . ' years old'));

		$client->legalAgeToDrinkAlcoholIs(self::legalAge());

		return $this;
	}

	private function giveDrinkToClient(client $client)
	{
		$this->dataConsumer->newData(new data\data('This is your drink!'));

		$client->newAlcoholDrink(new alcohol\drink);

		return $this;
	}

	private static function legalAge()
	{
		return self::$legalAge ?: (self::$legalAge = new client\age(18));
	}
}
