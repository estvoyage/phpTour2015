<?php

namespace estvoyage\phpTour2015\alcohol;

use
	estvoyage\phpTour2015\age
;

interface consumer
{
	function ageIsRequiredByAlcoholProvider(provider $provider);
	function legalAgeToConsumeAlcoholIs(consumer\age $age);
	function newAlcoholContainer(container $container);
}
