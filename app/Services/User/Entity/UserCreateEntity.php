<?php

declare(strict_types=1);

namespace App\Services\User\Entity;

final class UserCreateEntity
{
    private string $email;
    private string $password;
    private string $first_name = '';
    private string $last_name = '';
    private string $phone = '';
    private string $api_token = '';

    public function __construct(
        string $email,
        string $password
    ) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Wrong email format');
        }

        if (strlen($password) < 8) {
            throw new \InvalidArgumentException('Password is so easy');
        }

        $this->email = $email;
        $this->password = $password;
    }

    public function setFirstName(string $firstName): UserCreateEntity
    {
        $this->first_name = $firstName;
        return $this;
    }

    public function setLastName(string $last_name): UserCreateEntity
    {
        $this->last_name = $last_name;
        return $this;
    }

    public function setPhone(string $phone): UserCreateEntity
    {
        $this->phone = $phone;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'api_token' => $this->api_token,
        ];
    }
}
