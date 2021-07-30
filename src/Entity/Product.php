<?php


namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Persisters\Entity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank(message = "Number should not be blank.")
     */
    private $number;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message = "Type should not be blank.")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", length=1000, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $active;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type):self
    {
        $this->type = $type;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getActive(): ?string
    {
        return $this->active;
    }

    public function setActive(?string $active): self
    {
        $this->active = $active;
        return $this;
    }
}
