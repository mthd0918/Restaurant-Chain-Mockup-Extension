<?php
namespace Models;

use DateTime;
use Interfaces\FileConvertible;

class User implements FileConvertible {
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $hashedPassword;
    public string $phoneNumber;
    public string $address;
    public DateTime $birthDate;
    public DateTime $membershipExpirationDate;
    public string $role;
    public bool $isActive;

    public function __construct(
        int $id, string $firstName, string $lastName, string $email,
        string $password, string $phoneNumber, string $address,
        DateTime $birthDate, DateTime $membershipExpirationDate, string $role
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->birthDate = $birthDate;
        $this->membershipExpirationDate = $membershipExpirationDate;
        $this->role = $role;
        $this->isActive = true;
    }

    public function login(string $password): bool {
        // Validate password with the hashed password
        return password_verify($password, $this->hashedPassword);
    }

    public function updateProfile(string $address, string $phoneNumber): void {
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }

    public function renewMembership(DateTime $expirationDate): void {
        $this->membershipExpirationDate = $expirationDate;
    }

    public function changePassword(string $newPassword): void {
        $this->hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    public function hasMembershipExpired(): bool {
        $currentDate = new DateTime();
        return $currentDate > $this->membershipExpirationDate;
    }

    public function toString(): string {
        return sprintf(
            "User ID: %d\nName: %s %s\nEmail: %s\nPhone Number: %s\nAddress: %s\nBirth Date: %s\nMembership Expiration Date: %s\nRole: %s\n",
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format('Y-m-d'),
            $this->membershipExpirationDate->format('Y-m-d'),
            $this->role
        );
    }

    public function toHTML(): string {
        return sprintf("
            <div>
                <p>user name: %s %s</p>
                <p>email: %s</p>
                <p>phoneNumber: %s</p>
                <p>address: %s</p>
                <p>birthDate: %s</p>
                <p>membershipExpirationDate: %s</p>
                <p>role: %s</p>
            </div>",
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format('Y-m-d'),
            $this->membershipExpirationDate->format('Y-m-d'),
            $this->role
        );
    }

    public function toMarkdown(): string {
        return "## User: {$this->firstName} {$this->lastName}
                - Email: {$this->email}
                - Phone Number: {$this->phoneNumber}
                - Address: {$this->address}
                - Birth Date: {$this->birthDate->format('Y-m-d')}
                - Is Active: {$this->isActive}
                - Role: {$this->role}";
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'password' => $this->hashedPassword,
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'birthDate' => $this->birthDate,
            'isActive' => $this->isActive,
            'role' => $this->role
        ];
    }
}