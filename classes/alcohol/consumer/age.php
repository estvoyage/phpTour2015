<?php

namespace estvoyage\phpTour2015\alcohol\consumer;

use
	estvoyage\value\integer
;

final class age
{
	private
		$value
	;

	function __construct($value)
	{
		if (! is_integer($value))
		{
			throw new \domainException('Age of alcohol consumer should be construct from an integer');
		}

		if ($value < 0)
		{
			throw new \domainException('Age of alcohol consumer should be greater than 0');
		}

		$this->value = $value;
	}

	function __toString()
	{
		return (string) $this->value;
	}

	function isGreaterThanOrEqualTo(self $age)
	{
		return $this->value >= $age->value;
	}
}
