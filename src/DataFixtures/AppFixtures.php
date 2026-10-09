<?php

namespace App\DataFixtures;

use App\Entity\Materiel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $materials = [
            [
                'name' => 'Dell Latitude 5540',
                'category' => 'PC',
                'status' => 'disponible',
                'price' => '950.00',
            ],
            [
                'name' => 'Lenovo ThinkPad T14',
                'category' => 'PC',
                'status' => 'attribué',
                'price' => '1250.00',
            ],
            [
                'name' => 'Apple iPhone 14',
                'category' => 'Téléphone',
                'status' => 'maintenance',
                'price' => '750.00',
            ],
            [
                'name' => 'Samsung Galaxy Tab S9',
                'category' => 'Tablette',
                'status' => 'disponible',
                'price' => '680.00',
            ],
            [
                'name' => 'Apple iPad Air',
                'category' => 'Tablette',
                'status' => 'attribué',
                'price' => '820.00',
            ],
        ];

        foreach ($materials as $data) {
            $material = new Materiel();

            $material->setName($data['name']);
            $material->setCategory($data['category']);
            $material->setStatus($data['status']);
            $material->setPurchasePrice($data['price']);
            $material->setDateCreated(new \DateTimeImmutable());

            $manager->persist($material);
        }

        $manager->flush();
    }
}
