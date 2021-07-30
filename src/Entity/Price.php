<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Persisters\Entity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PriceRepository::class)
 */
class Price
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
    private $productNumber;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank(message = "Gross price should not be blank.")
     */
    private $grossPrice;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank(message = "Net price should not be blank.")
     */
    private $priceNet;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amount;

    public function getId(): int
    {
        return $this->id;
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

    public function getGrossPrice(): int
    {
        return $this->grossPrice;
    }

    public function setGrossPrice(int $grossPrice): self
    {
        $this->grossPrice = $grossPrice;
        return $this;
    }

    public function getPriceNet(): int
    {
        return $this->priceNet;
    }

    public function setPriceNet($priceNet): self
    {
        $this->priceNet = $priceNet;
        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;
        return $this;
    }
}
