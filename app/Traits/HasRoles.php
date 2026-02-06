<?php

namespace App\Traits;

trait HasRoles
{
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isKasir(): bool
    {
        return $this->role === 'kasir';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }
    
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}