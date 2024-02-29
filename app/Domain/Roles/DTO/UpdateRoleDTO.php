<?php

namespace App\Domain\Roles\DTO;

use App\Domain\Roles\Models\Role;

class UpdateRoleDTO
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var Role
     */
    private Role $role;

    /**
     * @param array $data
     * @return UpdateRoleDTO
     */
    public static function fromArray(array $data): UpdateRoleDTO
    {
        $dto = new self();
        $dto->setTitle($data['title']);
        $dto->setRole($data['role']);

        return $dto;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }
}
