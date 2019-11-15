<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $company;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Staff", mappedBy="departments")
     */
    private $staffs;

    public function __construct()
    {
        $this->staffs = new ArrayCollection();
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
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
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
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
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
     * @return $this
     */
    public function setTeamLead(string $teamLead): self
    {
        $this->teamLead = $teamLead;
        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return Department
     */
    public function setCompany(Company $company): Department
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return Collection|Staff[]
     */
    public function getStaffs(): Collection
    {
        return $this->staffs;
    }

    /**
     * @param Staff $staff
     * @return Department
     */
    public function addStaff(Staff $staff): self
    {
        if (!$this->staffs->contains($staff)) {
            $this->staffs[] = $staff;
            $staff->addDepartment($this);
        }

        return $this;
    }

    /**
     * @param Staff $staff
     * @return Department
     */
    public function removeStaff(Staff $staff): self
    {
        if ($this->staffs->contains($staff)) {
            $this->staffs->removeElement($staff);
            $staff->removeDepartment($this);
        }

        return $this;
    }
}
