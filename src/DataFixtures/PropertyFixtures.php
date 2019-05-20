<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Property;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    
        // for($i=0;$i<10;$i++)
        // {
        //     $property = new Property();
        //     $property->setTitle("Titre $i")
        //             ->setDescription("Lorem ipsum dolor sit amet consectetur $i")
        //             ->setSurface($i+100)
        //             ->setRooms($i+100)
        //             ->setBedrooms($i+100)
        //             ->setFloor($i+100)
        //             ->setHeat($i+100)
        //             ->setCity("casablanca $i")
        //             ->setAddresse("dern sultan hay mohammadi")
        //             ->setPostalCode("27500")
        //             ->setPrice(4000)
        //             ->setCreatedAt(new \DateTime())
        //             ->setSlug("slug_$i");
        //             $manager->persist($property);

        // }

        // $manager->flush();
    }
}
