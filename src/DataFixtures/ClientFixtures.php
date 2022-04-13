<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Service\DataHasher;
use Faker\Factory;
use App\Entity\Client;

class ClientFixtures extends Fixture
{
    private $faker;
    private $hasher;

    public function __construct(DataHasher $hasher)
    {
        $this->faker = Factory::create();
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {

        $this->createClient($manager);
        $manager->flush();
    }
    private function createClient(ObjectManager $manager)
    {
        $date =new \DatetimeImmutable();

        for ($i=0; $i < 100; $i++) { 
        $TestClient = new Client();
        $TestClient->setFirstname($this->faker->firstName());
        $TestClient->setLastname($this->faker->lastName());
        $TestClient->setType($this->faker->randomElement(['temporary','permanent']));
        $TestClient->setCreateAt($date);
        $hash = $this->hasher->getHashFromObject($TestClient); 
        $TestClient->setUid($hash);    
        $manager->persist($TestClient);
        }
    }
}
