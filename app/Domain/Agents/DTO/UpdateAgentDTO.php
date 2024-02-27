<?php

namespace App\Domain\Agents\DTO;

use App\Domain\Agents\Models\Agent;

class UpdateAgentDTO
{
    /**
     * @var string
     */
    private string $full_name;

    /**
     * @var string
     */
    private string $phone;

    /**
     * @var Agent
     */
    private Agent $agent;

    /**
     * @param array $data
     * @return UpdateAgentDTO
     */
    public static function fromArray(array $data): UpdateAgentDTO
    {
        $dto = new self();
        $dto->setFullName($data['full_name']);
        $dto->setPhone($data['phone']);
        $dto->setAgent($data['agent']);

        return $dto;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @param string $full_name
     */
    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return Agent
     */
    public function getAgent(): Agent
    {
        return $this->agent;
    }

    /**
     * @param Agent $agent
     */
    public function setAgent(Agent $agent): void
    {
        $this->agent = $agent;
    }
}
