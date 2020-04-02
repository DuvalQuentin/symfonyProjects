<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Lieu;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Projet;


/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeRepository")
 */
class Employe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     * @Assert\NotBlank()
     * @Assert\Type(type="string", message="La valeur {{ value }} doit être de type {{ type }}")
     * @Assert\Range(
     *      min = 10000,
     *      minMessage = "Le salaire doit au moins être égal à 10 000"
     *      )
     */
    private $salaire;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    private $nom;
    
    /**
     * @ORM\ManyToOne(targetEntity="Lieu", inversedBy="lesEmployes")
     * @ORM\JoinColumn(name = "lieu_id" , nullable=false)
     */
    private $lieu;
    
    /**
     * @Assert\Type(type="App\Entity\Projet")
     * @Assert\Valid()
     */
    private $projet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalaire(): ?string
    {
        return $this->salaire;
    }

    public function setSalaire(string $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
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
    
    public function getLieu()
    {
        return $this->lieu;
    }
    
    public function getProjet()
    {
        return $this->projet;
    }
    
    public function setProjet(Projet $projet = null)
    {
        $this->projet = $projet;
    }
}
