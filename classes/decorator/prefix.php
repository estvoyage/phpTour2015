<?php

namespace estvoyage\phpTour2015\decorator;

use
	estvoyage\data
;

class prefix implements data\consumer
{
	private
		$value,
		$dataConsumer
	;

	function __construct(data\data $value, data\consumer $dataConsumer)
	{
		$this->value = $value;
		$this->dataConsumer = $dataConsumer;
	}

	function dataProviderIs(data\provider $provider)
	{
		$provider->dataConsumerIs($this);

		return $this;
	}

	function dataConsumerControllerIs(data\consumer\controller $controller)
	{
	}

	function newData(data\data $data)
	{
		$this->dataConsumer->newData(new data\data($this->value . $data));

		return $this;
	}

	function noMoreData()
	{
	}
}
