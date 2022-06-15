<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\AnnounceSearchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnounceSearchRepository::class)
 */
class AnnounceSearch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ArrayCollection
     * 
     */
    private $categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        return $this->categorie = new ArrayCollection() ; 
    }

    public function getCategorie(): ArrayCollection
    {
        return $this->categorie ;
    }

    public function setCategorie(array $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
