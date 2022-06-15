<?php

namespace App\Entity;

use App\Repository\AnnouncesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AnnouncesRepository::class)
 */
class Announces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * 
     * 
     */
    private $createdAt;

    

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */


    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Assert\Url 
     */
    private $originalLink;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $nameCompany;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $adressCompany;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressAdditional;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\NotBlank
     * @Assert\Length(max=5)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

<<<<<<< HEAD
    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="announces")
     */
    private $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }
=======

>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOriginalLink(): ?string
    {
        return $this->originalLink;
    }

    public function setOriginalLink(?string $originalLink): self
    {
        $this->originalLink = $originalLink;

        return $this;
    }

    public function getNameCompany(): ?string
    {
        return $this->nameCompany;
    }

    public function setNameCompany(string $nameCompany): self
    {
        $this->nameCompany = $nameCompany;

        return $this;
    }

    public function getAdressCompany(): ?string
    {
        return $this->adressCompany;
    }

    public function setAdressCompany(string $adressCompany): self
    {
        $this->adressCompany = $adressCompany;

        return $this;
    }

    public function getAdressAdditional(): ?string
    {
        return $this->adressAdditional;
    }

    public function setAdressAdditional(?string $adressAdditional): self
    {
        $this->adressAdditional = $adressAdditional;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
            $category->addAnnounce($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->category->removeElement($category)) {
            $category->removeAnnounce($this);
        }

        return $this;
    }
}
