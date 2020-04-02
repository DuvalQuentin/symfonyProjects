<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Employe;
/**
 * @ORM\Entity(repositoryClass="App\Repository\LieuRepository")
 */
class Lieu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $ville;
    
    /**
     * @ORM\OneToMany(targetEntity="Employe", mappedBy = "lieu")
     */
    private $lesEmployes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
    
    public function getLesEmployes()
    {
        return $this->lesEmployes;
    }
}
