<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChartRepository")
 */
class Chart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $display;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $position;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $fontSize;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $fontColor;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $borderWidth;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $legend;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $legendPos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Data", mappedBy="chart")
     */
    private $data;

    public function __construct()
    {





        $this->data = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title=""): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDisplay(): ?bool
    {
        return $this->display;
    }

    public function setDisplay(?bool $display): self
    {
        $this->display = $display;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getFontSize(): ?int
    {
        return $this->fontSize;
    }

    public function setFontSize(?int $fontSize): self
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    public function getFontColor(): ?string
    {
        return $this->fontColor;
    }

    public function setFontColor(?string $fontColor): self
    {
        $this->fontColor = $fontColor;

        return $this;
    }

    public function getBorderWidth(): ?int
    {
        return $this->borderWidth;
    }

    public function setBorderWidth(?int $borderWidth): self
    {
        $this->borderWidth = $borderWidth;

        return $this;
    }

    public function getLegend(): ?bool
    {
        return $this->legend;
    }

    public function setLegend(?bool $legend): self
    {
        $this->legend = $legend;

        return $this;
    }

    public function getLegendPos(): ?string
    {
        return $this->legendPos;
    }

    public function setLegendPos(string $legendPos): self
    {
        $this->legendPos = $legendPos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate(): void
    {
        $today=date('Y.m.d');
        $this->date = $today;
    }

    /**
     * @return Collection|Data[]
     */
    public function getData(): Collection
    {
        return $this->data;
    }

    public function addData(Data $data): self //-----------------------
    {
        if (!$this->data->contains($data)) {
            $this->data[] = $data;
            $data->setChart($this);
        }

        return $this;
    }

    public function removeData(Data $data): self
    {
        if ($this->data->contains($data)) {
            $this->data->removeElement($data);
            // set the owning side to null (unless already changed)
            if ($data->getChart() === $this) {
                $data->setChart(null);
            }
        }

        return $this;
    }
}
