<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     * message = "veuillez remplir les champs ")
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     * message = "veuillez remplir les champs ")
     * @Assert\Type(
     *     type="integer",
     *      message=" Votre numéro '{{ value }}'  est incorrect")
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     * message = "veuillez remplir les champs ")
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     */
    private $idUser;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     * message = "veuillez remplir les champs ")
     * @Assert\Type(
     *     type="integer",
     *      message=" '{{ value }}'  est incorrect exemple veuillez ajouter des chiffres [1..9]")
     */
    private $prix;

    /**
     * @return mixed
     */
    public function getPrix(): ?int
    {
        return $this->prix;
    }
    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
