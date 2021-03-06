<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;


class LoadBonusData implements OrderedFixtureInterface, FixtureInterface
{
    public function getOrder() 
    {
        return 6;
    }

    public function load(ObjectManager $objectManager)
    {
    	$bonuses = array(
            array(
                "name" => "First deposit bonus", 
                "reward" => 10, 
                "unit" => \Application\Entity\Bonus::UNIT_PERCENTAGE, 
                "event_trigger" => \Application\Entity\Bonus::TRIGGER_DEPOSIT,
                "description" => "We are offering all our new customers a welcome bonus of €10. The welcome bonus is only available on your first deposit to CherryCasino.",
                "multiplier" => 25,
                ),
            array(
                "name" => "First login bonus",   
                "reward" => 20, 
                "unit" => \Application\Entity\Bonus::UNIT_CURRENCY,
                "event_trigger" => \Application\Entity\Bonus::TRIGGER_LOGIN,
                "description" => "We are offering all our new customers a first login bonus of €20.",
                "multiplier" => 5,
            ),
        );

    	foreach ($bonuses as $key => $value) 
    	{
    		$bonus = new \Application\Entity\Bonus(); 
    		$bonus->setName($value['name']);
            $bonus->setReward($value['reward']);
            $bonus->setUnit($value['unit']);
            $bonus->setEventTrigger($value['event_trigger']);
            $bonus->setMultiplier($value['multiplier']);
            $bonus->setDescription($value['description']);
            $bonus->setStatus(\Application\Entity\Bonus::STATUS_ACTIVE);

    		$objectManager->persist($bonus);
    		$objectManager->flush();
    	}
    }
    
}