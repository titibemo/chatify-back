<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DiscussionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiscussionsRepository::class)]
#[ApiResource]
class Discussions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name_discussion = null;

    #[ORM\Column(length: 100)]
    private ?string $description_discussion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture_description = null;

    #[ORM\ManyToOne(inversedBy: 'discussions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    /**
     * @var Collection<int, Messages>
     */
    #[ORM\OneToMany(targetEntity: Messages::class, mappedBy: 'id_discussion')]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameDiscussion(): ?string
    {
        return $this->name_discussion;
    }

    public function setNameDiscussion(string $name_discussion): static
    {
        $this->name_discussion = $name_discussion;

        return $this;
    }

    public function getDescriptionDiscussion(): ?string
    {
        return $this->description_discussion;
    }

    public function setDescriptionDiscussion(string $description_discussion): static
    {
        $this->description_discussion = $description_discussion;

        return $this;
    }

    public function getPictureDescription(): ?string
    {
        return $this->picture_description;
    }

    public function setPictureDescription(?string $picture_description): static
    {
        $this->picture_description = $picture_description;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messages $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setIdDiscussion($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getIdDiscussion() === $this) {
                $message->setIdDiscussion(null);
            }
        }

        return $this;
    }
}
