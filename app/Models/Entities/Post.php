<?php

namespace Application\Models\Entities;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Application\Models\Repositories\PostRepository")
 * @ORM\Table(name="posts")
 */
class Post extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="El titulo no puede estar vacío")
     * @Assert\Length(min="10", minMessage="El titulo debe tener al menos 10 caracteres")
     */
    protected string $title;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="El contenido del post no puede estar vacío")
     */
    protected string $body;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     */
    protected $user;
}
