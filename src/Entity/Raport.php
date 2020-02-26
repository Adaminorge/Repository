<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Raport
 * @package App\Entity
 * @ORM\Entity()
 */
class Raport
{
    /**
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var Data[]
     */
    private $id;
     /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $titleDisp;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $titleFontSize;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $legendDisp;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $legendPos;



    public function __construct(string $title)
    {

        $this->title=$title;

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return bool
     */
    public function isTitleDisp(): bool
    {
        return $this->titleDisp;
    }

    /**
     * @return int
     */
    public function getTitleFontSize(): int
    {
        return $this->titleFontSize;
    }

    /**
     * @return bool
     */
    public function isLegendDisp(): bool
    {
        return $this->legendDisp;
    }

    /**
     * @return string
     */
    public function getLegendPos(): string
    {
        return $this->legendPos;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param bool $titleDisp
     */
    public function setTitleDisp(bool $titleDisp): void
    {
        $this->titleDisp = $titleDisp;
    }

    /**
     * @param int $titleFontSize
     */
    public function setTitleFontSize(int $titleFontSize): void
    {
        $this->titleFontSize = $titleFontSize;
    }

    /**
     * @param bool $legendDisp
     */
    public function setLegendDisp(bool $legendDisp): void
    {
        $this->legendDisp = $legendDisp;
    }

    /**
     * @param string $legendPos
     */
    public function setLegendPos(string $legendPos): void
    {
        $this->legendPos = $legendPos;
    }






}