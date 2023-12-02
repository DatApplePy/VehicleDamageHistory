<?php

namespace Database\Factories;

use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;
use Xvladqt\Faker\LoremFlickrProvider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake();
        $faker -> addProvider(new Fakecar($faker));
        $vehicle = $faker -> vehicleArray();

        $image_faker = \Faker\Factory::create();
        $image_faker -> addProvider(new LoremFlickrProvider($image_faker));

        return [
            'license_plate' => $faker -> vehicleRegistration(),
            'brand' => $vehicle['brand'],
            'model' => $vehicle['model'],
            'production_year' => $faker -> year(),
            'image' => 'images/' . $image_faker->image('public/storage/images', fullPath:false, keywords:['car'])
        ];
    }
}
