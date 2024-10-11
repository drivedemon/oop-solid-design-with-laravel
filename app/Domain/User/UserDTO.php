<?php

namespace App\Domain\User;

use App\Domain\DTO;

class UserDTO extends DTO
{
    protected $email;
    protected $billingAddress;
    protected $phoneNumber;
    protected $lastName;
    protected $firstName;
    protected $dob;
    protected $gender;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBillingAddress(): string
    {
        return $this->billingAddress;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getDob(): string
    {
        return $this->dob;
    }

    public function getGender(): string
    {
        return $this->gender;
    }
}
