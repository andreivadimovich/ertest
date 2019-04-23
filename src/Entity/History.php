<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table(name="history", indexes={@ORM\Index(name="department_to_id", columns={"department_to"}), @ORM\Index(name="department_id", columns={"department_from"}), @ORM\Index(name="avto_id", columns={"auto_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\HistoryRepository")
 */
class History
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
     * @var \DateTime
     *
     * @ORM\Column(name="took", type="datetime", nullable=false)
     */
    private $took;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="gave", type="datetime", nullable=true)
     */
    private $gave;

    /**
     * @var \Auto
     *
     * @ORM\ManyToOne(targetEntity="Auto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="auto_id", referencedColumnName="id")
     * })
     */
    private $auto;

    /**
     * @var \Department
     *
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_from", referencedColumnName="id")
     * })
     */
    private $departmentFrom;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Department
     *
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_to", referencedColumnName="id", nullable=true)
     * })
     */
    private $departmentTo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTook(): ?\DateTimeInterface
    {
        return $this->took;
    }

    public function setTook(\DateTimeInterface $took): self
    {
        $this->took = $took;

        return $this;
    }

    public function getGave(): ?\DateTimeInterface
    {
        return $this->gave;
    }

    public function setGave(?\DateTimeInterface $gave): self
    {
        $this->gave = $gave;

        return $this;
    }

    public function getAuto(): ?Auto
    {
        return $this->auto;
    }

    public function setAuto(?Auto $auto): self
    {
        $this->auto = $auto;

        return $this;
    }

    public function getDepartmentFrom(): ?Department
    {
        return $this->departmentFrom;
    }

    public function setDepartmentFrom(?Department $departmentFrom): self
    {
        $this->departmentFrom = $departmentFrom;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDepartmentTo(): ?Department
    {
        return $this->departmentTo;
    }

    public function setDepartmentTo(?Department $departmentTo): self
    {
        $this->departmentTo = $departmentTo;

        return $this;
    }

    public function __toString() : string {
        return $this->name;
    }
}
