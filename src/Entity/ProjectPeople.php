<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="project_people")
 */
class ProjectPeople
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
     * @ORM\Column(type="string", length=15)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $responsibility;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="people")
     */
    private $project;

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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getResponsibility(): string
    {
        return $this->responsibility;
    }

    /**
     * @param string $responsibility
     */
    public function setResponsibility(string $responsibility): void
    {
        $this->responsibility = $responsibility;
    }


}