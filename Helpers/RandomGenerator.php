<?php
namespace Helpers;

use Faker\Factory;
use Models\Company;
use Models\Employee;
use Models\RestaurantChain;
use Models\RestaurantLocation;

class RandomGenerator {
    public static function company(int $numberOfEmployee): Company {
        $faker = Factory::create();

        return new Company(
            $faker->company,
            $faker->year,
            $faker->sentence(10),
            $faker->url,
            $faker->phoneNumber,
            $faker->bs,
            $faker->name,
            $faker->boolean(70),
            $faker->country,
            $faker->name,
            $numberOfEmployee
        );
    }

    public static function companies(
            int $numberOfEmployee,
            int $minNumberOfCompany,
            int $maxNumberOfCompany
        ): array {
        $faker = Factory::create();
        $companies = [];
        $numberOfCompany = $faker->numberBetween($minNumberOfCompany, $maxNumberOfCompany);

        for ($i = 0; $i < $numberOfCompany; $i++) {
            $companies[] = self::company($numberOfEmployee);
        }

        return $companies;
    }

    public static function employee(
        int $minSalary,
        int $maxSalary,
    ): Employee {
        $faker = Factory::create();

        return new Employee(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email,
            $faker->password,
            $faker->phoneNumber,
            $faker->address,
            $faker->dateTimeThisCentury,
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor']),
            $faker->jobTitle,
            $faker->numberBetween($minSalary, $maxSalary),
            $faker->dateTimeBetween('-10 years', 'now'),
            $faker->words($faker->numberBetween(0, 5))
        );
    }

    public static function employees($numberOfEmployee, $minSalary, $maxSalary): array {
        $employees = [];

        for ($i = 0; $i < $numberOfEmployee; $i++) {
            $employees[] = self::employee(
                $minSalary,
                $maxSalary
            );
        }

        return $employees;
    }

    public static function createPostalCode($minPostalCode, $maxPostalCode): string {
        $faker = Factory::create();

        $postalCode = $faker->numberBetween($minPostalCode, $maxPostalCode);
        $formattedPostalCode = (string)substr($postalCode, 0, 3) . '-' . substr($postalCode, 3);

        return $formattedPostalCode;
    }

    public static function restaurantLocation(
            int $numberOfEmployee,
            int $minSalary,
            int $maxSalary,
            int $minPostalCode,
            int $maxPostalCode
        ): RestaurantLocation {
        $faker = Factory::create();

        return new RestaurantLocation(
            $faker->city,
            $faker->streetAddress,
            $faker->city,
            $faker->state,
            self::createPostalCode($minPostalCode, $maxPostalCode),
            self::employees($numberOfEmployee, $minSalary, $maxSalary),
            $faker->boolean(80)
        );
    }

    public static function restaurantLocations(
        int $numberOfLocation,
        int $minSalary,
        int $maxSalary,
        int $minPostalCode,
        int $maxPostalCode
    ): array {
        $restaurantLocations = [];

        for ($i = 0; $i < $numberOfLocation; $i++) {
            $restaurantLocations[] = self::restaurantLocation(
                $numberOfLocation, 
                $minSalary, 
                $maxSalary,
                $minPostalCode,
                $maxPostalCode
            );
        }

        return $restaurantLocations;
    }

    public static function RestaurantChain(
        int $numberOfEmployee,
        int $minSalary,
        int $maxSalary,
        int $numberOfLocation,
        int $minPostalCode,
        int $maxPostalCode
    ): RestaurantChain {
        $faker = Factory::create();
        $parentCompany = self::company($numberOfEmployee);

        return new RestaurantChain(
            $faker->numberBetween(100000, 999999),
            self::restaurantLocations(
                $numberOfLocation, 
                $minSalary, 
                $maxSalary,
                $minPostalCode,
                $maxPostalCode
            ),
            $faker->word,
            $faker->numberBetween(3, 100),
            $parentCompany->name,
            $faker->company,
            $faker->year,
            $faker->sentence(10),
            $faker->url,
            $faker->phoneNumber,
            $faker->bs,
            $faker->name,
            $faker->boolean(70),
            $faker->country,
            $faker->name,
            $numberOfEmployee
        );
    }

    public static function restaurantChains(
        int $numberOfEmployee,
        int $minSalary,
        int $maxSalary,
        int $numberOfLocation,
        int $minPostalCode,
        int $maxPostalCode
    ): array {
        $chains = [];

        for ($i = 0; $i < $numberOfLocation; $i++) {
            $chains[] = self::restaurantChain(
                $numberOfEmployee,
                $minSalary,
                $maxSalary,
                $numberOfLocation,
                $minPostalCode,
                $maxPostalCode
            );
        }

        return $chains;
    }
}