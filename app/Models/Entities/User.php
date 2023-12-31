<?php

namespace Application\Models\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="El nombre no puede estar vacío")
     * @Assert\Length(min="2", minMessage="El nombre debe tener al menos 2 caracteres")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="El correo electrónico es requerido")
     * @Assert\Email(message="El correo electrónico no es válido")
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="El password no puede estar vacío")
     * @Assert\Length(min="6", minMessage="El password debe tener al menos 6 caracteres")
     */
    protected $password;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    protected $posts;

    public function __construct()
    {
        $this->created_at = new \DateTime('now');
        $this->posts = new ArrayCollection;
    }

    public function getPosts() {
        return $this->posts->toArray();
    }
}
