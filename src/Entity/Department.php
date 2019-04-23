<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="department")
 * @ORM\Entity
 */
class Department
{
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
     * @ORM\Column(name="addr", type="string", length=255, nullable=false)
     */
    private $addr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddr(): ?string
    {
        return $this->addr;
    }

    public function setAddr(string $addr): self
    {
        $this->addr = $addr;

        return $this;
    }


    public function __toString() : string {
        return $this->addr;
    }
}
