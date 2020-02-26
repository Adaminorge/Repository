<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Data
 * @package App\Entity
 * @ORM\Entity()
 */
class Data
{
    /**

     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\Raport")
     * @ORM\JoinColumn(name="raportId", referencedColumnName="id")
     *
     *
     */
    private $raportId;

    /**
     * @ORM\Column(type="string",nullable=true)
     * @var string
     */
    private $dane;


    public function __construct(Raport $id, string $dane)
    {
        $this->raportId=$id;
        $this->dane=$dane;
    }

    /**
     * @param string $dane
     */
    public function setDane(string $dane): void
    {
        $this->dane = $dane;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRaportId()
    {
        return $this->raportId;
    }

    /**
     * @return string
     */
    public function getDane(): string
    {
        return $this->dane;
    }




}