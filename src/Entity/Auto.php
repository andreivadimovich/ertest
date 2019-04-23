<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auto
 *
 * @ORM\Table(name="auto")
 * @ORM\Entity(repositoryClass="App\Repository\AutoRepository")
 */
class Auto
{
    const STATE_RENT = 0;
    const STATE_FREE = 1;
    const STATE_REPAIR = 2;
    const STATE_MAINTENANCE = 3;

    const STATE_LIST = [
        self::STATE_RENT => 'rent',
        self::STATE_FREE => 'free',
        self::STATE_REPAIR => 'repair',
        self::STATE_MAINTENANCE => 'maintenance',
    ];

    public static function getTextState($id) {
        return self::STATE_LIST[$id];
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=10, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="mark", type="string", length=10, nullable=false)
     */
    private $mark;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=10, nullable=false)
     */
    private $number;

    /**
     * @var int|null
     *
     * @ORM\Column(name="state", type="integer", nullable=true, options={"comment"="статус (есть в наличии или кто-то взял)"})
     */
    private $state;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(?int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function __toString() : string {
        return $this->name;
    }
}
