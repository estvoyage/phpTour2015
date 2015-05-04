<?php

namespace estvoyage\phpTour2015\barman;

use
	estvoyage\phpTour2015
;

interface client
{
	function ageIsRequiredByBarman(phpTour2015\barman $barman);
	function legalAgeToDrinkAlcoholIs(phpTour2015\barman\client\age $age);
	function newAlcoholDrink(phpTour2015\alcohol\drink $drink);
}
