<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Persisters\Entity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductCategoryRepository::class)
 */
class ProductCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank(message = "Product number should not be blank.")
     */
    private $categoryId;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank(message = "Gross price should not be blank.")
     */
    private $productNumber;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $orderId;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $visible;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function getProductNumber(): int
    {
        return $this->productNumber;
    }

    public function setProductNumber(int $productNumber): self
    {
        $this->productNumber = $productNumber;
        return $this;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrderId(?string $orderId):self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function seVisible(?bool $visible): self
    {
        $this->visible = $visible;
        return $this;
    }
}
