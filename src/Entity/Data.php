<?php

namespace App\Entity;

use Doctrine\DBAL\Types\IntegerType;
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
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\Chart", inversedBy="id")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     *
     */
    private $chart_id;

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

    /**
     * @return Chart
     */
    public function getChart_id()
    {
        return $this->chart_id;
    }

    /**
     *
     * @param Chart $chart
     * @return $this
     */
    public function setChart(Chart $chart): self //-----------------------------------------------------
        {
        $this->chart_id= $chart;

        return $this;
    }
}
