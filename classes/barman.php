<?php

namespace estvoyage\phpTour2015;

interface barman
{
	function alcoholDrinkIsAskedByClient(barman\client $client);
	function clientAgeIs(barman\client\age $age);
}
