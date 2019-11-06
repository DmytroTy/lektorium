<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="department")
 */
class Department
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $teamLead;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="departments")
     */
    private $company;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Staff", mappedBy="departments")
     */
    private $staffs;

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
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTeamLead(): string
    {
        return $this->teamLead;
    }

    /**
     * @param string $teamLead
     */
    public function setTeamLead(string $teamLead): void
    {
        $this->teamLead = $teamLead;
    }


}