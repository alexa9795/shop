<?php


namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Persisters\Entity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(options={"auto_increment": 1})
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank(message = "Parent id should not be blank.")
     */
    private $parentId;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\NotBlank(message = "Name should not be blank.")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $orderId;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $image;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function setParentId(int $parentId): self
    {
        $this->parentId = $parentId;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrder(?string $orderId):self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }
}
