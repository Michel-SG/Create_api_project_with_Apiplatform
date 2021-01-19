<?php

namespace App\Entity;

//use App\Entity\Traits\Timestampable;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 

//use Symfony\Component\Serializer\Annotation\Groups;



/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * 
 */
class Article
{
    //use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="le titre est obligatoire")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *@Assert\NotBlank
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

   

   

  
}
