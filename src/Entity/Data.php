<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DataRepository")
 */
class Data
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $dane;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chart", inversedBy="data")
     */
    private $chart;

    /**
     * @ORM\Column(type="boolean")
     */
    private $menuId;

    /**
     * @return mixed
     */
    public function getMenuId()
    {
        return $this->menuId;
    }

    /**
     * @param mixed $menuId
     */
    public function setMenuId($menuId): void
    {
        $this->menuId = $menuId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDane(): ?string
    {
        return $this->dane;
    }

    public function setDane(string $dane): self
    {
        $this->dane = $dane;

        return $this;
    }

    public function getChart(): ?Chart
    {
        return $this->chart;
    }

    public function setChart(?Chart $chart): self
    {
        $this->chart = $chart;

        return $this;
    }
}
