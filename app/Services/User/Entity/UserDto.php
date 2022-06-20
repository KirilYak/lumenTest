<?php

declare(strict_types=1);

namespace App\Services\User\Entity;

use Carbon\Carbon;

final class UserDto
{
    private int $id;
    private string $email;
    private string $password;
    private ?string $first_name;
    private ?string $last_name;
    private ?string $phone;
    private Carbon $created_at;
    private Carbon $updated_at;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function setEmail(string $email): UserDto
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(string $password): UserDto
    {
        $this->password = $password;
        return $this;
    }

    public function setFirstName(string $firstName): UserDto
    {
        $this->first_name = $firstName;
        return $this;
    }

    public function setLastName(string $last_name): UserDto
    {
        $this->last_name = $last_name;
        return $this;
    }

    public function setPhone(string $phone): UserDto
    {
        $this->phone = $phone;
        return $this;
    }

    public function setCreatedAt(Carbon $createdAt): UserDto
    {
        $this->created_at = $createdAt;
        return $this;
    }

    public function setUpdatedAt(Carbon $updated_at): UserDto
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
