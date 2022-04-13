<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Action\NotFoundAction;
/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @UniqueEntity("uid")
 * @UniqueEntity(fields={"firstname","lastName"})
 * @ApiResource(formats="json",
 * itemOperations={"get"=
 * {"normalization_context"={"groups"={"read"}},
 * "read"=true,
 *  "openapi_context"={
 *                 "summary"="Get by path parameters"}},
 * "delete",
 * "check"={"normalization_context"={"groups"={"check"}},"path"="/Client/{uid}","method"="GET"}},
 * collectionOperations={"get"={"controller"=NotFoundAction::class,"read"=false,"output"=false},"post"={"normalization_context"= {"groups"="write"}} })
 */
class Client
{
    const TYPES = ['temporary','permanent'];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ApiProperty(identifier=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read","write"})
     * @Assert\NotBlank
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime_immutable",nullable=true)
     * 
     */
    private $createAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(identifier=true)
     */
    private $uid;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read","write"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read","write"})
     * @Assert\NotBlank
     * @Assert\Expression(expression="this.getType() in constant('\\App\\Entity\\Client::TYPES')", message= "unauthorized license type")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read","write"})
     */
    private $toto;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getToto(): ?string
    {
        return $this->toto;
    }

    public function setToto(?string $toto): self
    {
        $this->toto = $toto;

        return $this;
    }

}
