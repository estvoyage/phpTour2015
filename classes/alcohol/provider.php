<?php

namespace estvoyage\phpTour2015\alcohol;

interface provider
{
	function alcoholIsAskedByAlcoholConsumer(consumer $consumer);
	function ageOfAlcoholConsumerIs(consumer\age $age);
}
