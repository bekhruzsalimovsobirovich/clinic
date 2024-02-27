<?php

namespace App\Domain\Patients\DTO;

use App\Domain\Patients\Models\Patient;
use Illuminate\Http\UploadedFile;

class UpdatePatientDTO
{
    private int $user_id;
    private int $agent_id;
    private string $full_name;
    private ?string $workplace = null;
    private string $birthday;
    private array $province_city;
    private string $address;
    private ?string $job = null;
    private ?string $phone = null;
    private ?UploadedFile $avatar = null;
    private ?string $description = null;
    private Patient $patient;

    public static function fromArray(array $data)
    {
        $dto = new self();
        $dto->setUserId($data['user_id']);
        $dto->setAgentId($data['agent_id']);
        $dto->setFullName($data['full_name']);
        $dto->setWorkplace($data['workplace'] ?? null);
        $dto->setBirthday($data['birthday']);
        $dto->setProvinceCity($data['province_city']);
        $dto->setAddress($data['address']);
        $dto->setJob($data['job'] ?? null);
        $dto->setPhone($data['phone'] ?? null);
        $dto->setAvatar($data['avatar'] ?? null);
        $dto->setDescription($data['description'] ?? null);
        $dto->setPatient($data['patient']);

        return $dto;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getAgentId(): int
    {
        return $this->agent_id;
    }

    /**
     * @param int $agent_id
     */
    public function setAgentId(int $agent_id): void
    {
        $this->agent_id = $agent_id;
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
     * @return string|null
     */
    public function getWorkplace(): ?string
    {
        return $this->workplace;
    }

    /**
     * @param string|null $workplace
     */
    public function setWorkplace(?string $workplace): void
    {
        $this->workplace = $workplace;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return array
     */
    public function getProvinceCity(): array
    {
        return $this->province_city;
    }

    /**
     * @param array $province_city
     */
    public function setProvinceCity(array $province_city): void
    {
        $this->province_city = $province_city;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getJob(): ?string
    {
        return $this->job;
    }

    /**
     * @param string|null $job
     */
    public function setJob(?string $job): void
    {
        $this->job = $job;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return UploadedFile|null
     */
    public function getAvatar(): ?UploadedFile
    {
        return $this->avatar;
    }

    /**
     * @param UploadedFile|null $avatar
     */
    public function setAvatar(?UploadedFile $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Patient
     */
    public function getPatient(): Patient
    {
        return $this->patient;
    }

    /**
     * @param Patient $patient
     */
    public function setPatient(Patient $patient): void
    {
        $this->patient = $patient;
    }
}
