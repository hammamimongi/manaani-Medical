<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *     fields={"mail"},
 *     message="l'email que vous avez indiqué est déjà utislisé !"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     * message = "veuillez saisir vos coordonnées")
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Votre nom doit contenir au minimum {{ limit }} caractére !"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     * message = "veuillez saisir vos coordonnées")
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Votre nom doit contenir au minimum {{ limit }} caractére !"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pdp;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     * message = "veuillez saisir vos coordonnées")
     * @Assert\Email(
     *     message = "Votre email '{{ value }}' est incorrect."
     * )
     * @Assert\Email ()
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     * message = "veuillez saisir vos coordonnées")
     * @Assert\Length(
     *     min = 8,
     *     minMessage = "Votre mot de passe doit contenir au minimum {{ limit }} caractére !")
     * @Assert\EqualTo(propertyPath="confirmPassword",
     *     message="Vous n'avez pas tapé le meme mot de passe")
     */
    private $password;

    /**
     * @Assert\NotBlank(
     * message = "veuillez saisir vos coordonnées")
     *@Assert\EqualTo(propertyPath="password",
     *     message="Vous n'avez pas tapé le meme mot de passe")
     */
    public $confirmPassword;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     * message = "veuillez saisir vos coordonnées")
     *@Assert\Length(
     *     min = 8,
     *     max = 8,
     *     minMessage = "Votre Num tel doit contenir au minimum {{ limit }} chiffre !",
     *     maxMessage = "Votre Num tel doit contenir au minimum {{ limit }} chiffre !")
     * @Assert\Type(
     *     type="integer",
     *      message=" Votre numéro '{{ value }}'  est incorrect")
     */
    private $numTel;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPdp()
    {
        return $this->pdp;
    }

    public function setPdp($pdp)
    {
        $this->pdp = $pdp;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->numTel;
    }

    public function setNumTel(int $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    public  function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }
    private $username;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="idUser")
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setIdUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getIdUser() === $this) {
                $post->setIdUser(null);
            }
        }

        return $this;
    }
}
