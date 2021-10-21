<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Dto\BlogPostInputPatch;
use App\Dto\BlogPostInputPost;
use App\Dto\BlogPostOutputCollection;
use App\Dto\BlogPostOutputItem;
use App\Repository\BlogPostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogPostRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'output' => BlogPostOutputCollection::class,
        ],
        'post' => [
            'input' => BlogPostInputPost::class,
            'output' => false,
        ]
    ],
    itemOperations: [
        'get' => [
            'output' => BlogPostOutputItem::class,
        ],
        'patch' => [
            'input' => BlogPostInputPatch::class,
            'output' => false,
        ], 
        'delete' => [
            'output' => false,
        ]
    ],
)]
class BlogPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $onReview;

    /**
     * @ORM\OneToMany(targetEntity=BlogPostComment::class, mappedBy="blogPost", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
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

    public function getOnReview(): ?bool
    {
        return $this->onReview;
    }

    public function setOnReview(bool $onReview): self
    {
        $this->onReview = $onReview;

        return $this;
    }

    /**
     * @return Collection|BlogPostComment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(BlogPostComment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setBlogPost($this);
        }

        return $this;
    }

    public function removeComment(BlogPostComment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getBlogPost() === $this) {
                $comment->setBlogPost(null);
            }
        }

        return $this;
    }
}
