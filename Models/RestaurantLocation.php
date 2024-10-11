<?php
namespace Models;

use Interfaces\FileConvertible;

class RestaurantLocation implements FileConvertible
{
    public string $name;
    public string $address;
    public string $city;
    public string $state;
    public string $zipCode;
    public array $employees; // Employee[]
    public bool $isOpen;

    public function __construct(
        string $name,
        string $address,
        string $city,
        string $state,
        string $zipCode,
        array $employees,
        bool $isOpen,
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->employees = $employees;
        $this->isOpen = $isOpen;
    }

    public function toString(): string
    {
        return sprintf(
            "Location Name: %s Address: %s City: %s State: %s Zip Code: %d Employees: %s isOpen: %s",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            implode(', ', $this->employees),
            $this->isOpen ? 'Yes' : 'No'
        );
    }

    public function toHTML(): string
    {

        // int $id,
        // string $firstName,
        // string $lastName,
        // string $email,
        // string $password,
        // string $phoneNumber,
        // string $address,
        // DateTime $birthDate,
        // DateTime $membershipExpirationDate,
        // string $role,
        // string $jobTitle,
        // float $salary,
        // DateTime $startDate,
        // array $awards

        $employeeInfo = "<table class='table table-bordered'>";
        $employeeInfo .= implode('', array_map(function($employee) {
            return sprintf(
                "<tr><td>ID: %d, Name: %s %s, Job Title: %s, Start Date: %s</td></tr>",
                $employee->id,
                $employee->firstName,
                $employee->lastName,
                $employee->jobTitle,
                $employee->startDate->format('Y-m-d')
            );
        }, $this->employees));

        $employeeInfo .= "</table>";

        // "<p>Company Name: %s, Address: %s, %s, %s ZipCode: %d</p>
        // <h4>Employees: </h4>
        // %s"

        return sprintf(
            "<div class='card'>
                <div class='card-body'>
                    <p>Company Name: %s, Address: %s, %s, %s ZipCode: %d</p>
                    <h6>Employees:</h6>
                    %s
                </div>
            </div>",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $employeeInfo
        );
    }

    public function toMarkDown(): string
    {
        $employeesMarkdown = array_map(function($employee) {
            return $employee->toMarkDown();
        }, $this->employees);

        return sprintf("
                ## Location: %s
                - Address: %s
                - City: %s
                - State: %s
                - Zip Code: %s
                ### Employees:
                %s
                - Is Open: %s
                ",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            implode("\n", $employeesMarkdown),
            $this->isOpen ? 'Yes' : 'No'
        );
    }

    public function toArray(): array
    {
        return [
            'locationName' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'employees' => $this->employees,
            'isOpen' => $this->isOpen
        ];
    }
}