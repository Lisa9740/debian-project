<?php

namespace App\Entity;

use App\Repository\LoginAttemptRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=LoginAttemptRepository::class)
 * @ORM\Table(name="`loginattempt`")
 */
class LoginAttempt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ipAddress;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $email;


    public function __construct(?string $ipAddress, ?string $email)
{
    $this->ipAddress = $ipAddress;
    $this->email = $email;
    $this->date = new \DateTimeImmutable('now');
}

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
}
