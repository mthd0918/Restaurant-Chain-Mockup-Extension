<?php
namespace Models;

use Interfaces\FileConvertible;
use DateTime;

class Employee extends User implements FileConvertible
{
    public string $jobTitle;
    public float $salary;
    public DateTime $startDate;
    public array $awards; // string[]

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $phoneNumber,
        string $address,
        DateTime $birthDate,
        DateTime $membershipExpirationDate,
        string $role,
        string $jobTitle,
        float $salary,
        DateTime $startDate,
        array $awards
    ) {
        parent::__construct($id, $firstName, $lastName, $email, $password, $phoneNumber, $address, $birthDate, $membershipExpirationDate, $role);
        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;
    }

    // FileConvertible インターフェースのメソッドをオーバーライド
    public function toString(): string
    {
        $parentString = parent::toString();
        return $parentString . sprintf(
            "Job Title: %s, Salary: %.2f, Start Date: %s, Awards: %s\n",
            $this->jobTitle,
            $this->salary,
            $this->startDate->format('Y-m-d'),
            implode(', ', $this->awards)
        );
    }

    public function toHTML(): string
    {
        return sprintf("ID: %d, Name: %s %s, Salary: $%d",
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->salary
        );
    }

    public function toMarkDown(): string
    {
        $parentMarkdown = parent::toMarkdown();
        return $parentMarkdown . sprintf("
                - Job Title: %s
                - Salary: %.2f
                - Start Date: %s
                - Awards: %s",
            $this->jobTitle,
            $this->salary,
            $this->startDate->format('Y-m-d'),
            implode(', ', $this->awards)
        );
    }

    public function toArray(): array
    {
        $parentArray = parent::toArray();
        return array_merge($parentArray, [
            'jobTitle' => $this->jobTitle,
            'salary' => $this->salary,
            'startDate' => $this->startDate,
            'awards' => $this->awards
        ]);
    }
}