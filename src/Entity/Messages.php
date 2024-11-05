<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MessagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
#[ApiResource]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?array $message = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Discussions $id_discussion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?array
    {
        return $this->message;
    }

    public function setMessage(?array $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getIdDiscussion(): ?Discussions
    {
        return $this->id_discussion;
    }

    public function setIdDiscussion(?Discussions $id_discussion): static
    {
        $this->id_discussion = $id_discussion;

        return $this;
    }
}
