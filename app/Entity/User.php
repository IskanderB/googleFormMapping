<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use LaravelDoctrine\ORM\Auth\Authenticatable;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`users`')]
class User implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable, HasApiTokens, HasFactory;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    protected ?string $name = null;

    #[ORM\Column(length: 255, nullable: false)]
    protected ?string $email = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $emailVerifiedAt;

    #[ORM\Column(length: 255, nullable: false)]
    protected $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    protected $rememberToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->setEmailVerifiedAt(new DateTime());
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return User
     */
    public function setName(?string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return User
     */
    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEmailVerifiedAt(): ?DateTimeInterface
    {
        return $this->emailVerifiedAt;
    }

    /**
     * @param DateTimeInterface|null $emailVerifiedAt
     * @return User
     */
    public function setEmailVerifiedAt(?DateTimeInterface $emailVerifiedAt): User
    {
        $this->emailVerifiedAt = $emailVerifiedAt;
        return $this;
    }

    /**
     * @return null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param null $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return null
     */
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * @param null $rememberToken
     * @return User
     */
    public function setRememberToken($rememberToken)
    {
        $this->rememberToken = $rememberToken;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface|null $createdAt
     * @return User
     */
    public function setCreatedAt(?DateTimeInterface $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface|null $updatedAt
     * @return User
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): User
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}

