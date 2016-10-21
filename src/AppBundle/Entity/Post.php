<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Gallery;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * Class Post
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="PostRepository")
 * @ORM\Table(
 *   name="post",
 *   indexes={
 *      @ORM\Index(
 *        name="publication_date_idx",
 *        columns="publication_date"
 *      )
 *   }
 * )
 * @ORM\HasLifecycleCallbacks
 */
class Post {

  /**
   * @var int
   *
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  protected $id;

  /**
   * @var string
   *
   * @ORM\Column(type="string")
   */
  protected $title;

  /**
   * @var string
   *
   * @ORM\Column(type="string")
   */
  protected $slug;

  /**
   * @var Media
   * http://stackoverflow.com/questions/6328535/on-delete-cascade-with-doctrine2
   *
   * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
   * @ORM\JoinColumns({
   *     @ORM\JoinColumn(name="poster", referencedColumnName="id", onDelete="CASCADE")
   *     })
   */
  protected $poster;

  /**
   * @var Gallery
   *
   * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery", fetch="LAZY", cascade={"remove","persist"})
   * @ORM\JoinColumns({
   *     @ORM\JoinColumn(name="gallery", referencedColumnName="id", onDelete="CASCADE")
   * })
   */
  private $gallery;

  /**
   * @var string
   *
   * @ORM\Column(type="text")
   */
  protected $body;

  /**
   * @var \DateTime
   *
   * @ORM\Column(type="datetime")
   */
  protected $publicationDate;

  /**
   * @var ArrayCollection $comments
   *
   * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
   *
   */
  protected $comments;

  /**
   * @var ArrayCollection $tags
   *
   * @ORM\ManyToMany(
   *   targetEntity="Tag",
   *   inversedBy="posts",
   *   fetch="EAGER",
   *   cascade={"persist"}
   * )
   */
  // orphanRemoval=true cancella il record del Tag ma anche tutti i record
  // nella tabella di associazione correlati a quel Tag!
  protected $tags;

  /**
   * @var PostAuthor $author ;
   *
   * @ORM\ManyToOne(targetEntity="PostAuthor", inversedBy="posts")
   */
  protected $author;

  public function __construct() {
    $this->comments = new ArrayCollection();
    $this->tags = new ArrayCollection();
  }


  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get title
   *
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Set title
   *
   * @param string $title
   *
   * @return Post
   */
  public function setTitle($title) {
    $this->title = $title;

    return $this;
  }

  /**
   * Get body
   *
   * @return string
   */
  public function getBody() {
    return $this->body;
  }

  /**
   * Set body
   *
   * @param string $body
   *
   * @return Post
   */
  public function setBody($body) {
    $this->body = $body;

    return $this;
  }

  /**
   * Get publicationDate
   *
   * @return \DateTime
   */
  public function getPublicationDate() {
    return $this->publicationDate;
  }

  /**
   * Set publicationDate
   *
   * @param \DateTime $publicationDate
   *
   * @return Post
   */
  public function setPublicationDate($publicationDate) {
    $this->publicationDate = $publicationDate;

    return $this;
  }

  /**
   * Add comment
   *
   * @param \AppBundle\Entity\Comment $comment
   *
   * @return Post
   */
  public function addComment(\AppBundle\Entity\Comment $comment) {
    $this->comments[] = $comment;
    $comment->setPost($this);

    return $this;
  }

  /**
   * Remove comment
   *
   * @param \AppBundle\Entity\Comment $comment
   */
  public function removeComment(\AppBundle\Entity\Comment $comment) {
    $this->comments->removeElement($comment);
  }

  /**
   * Get comments
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getComments() {
    return $this->comments;
  }

  /**
   * Add tag
   *
   * @param \AppBundle\Entity\Tag $tag
   *
   * @return Post
   */
  public function addTag(\AppBundle\Entity\Tag $tag) {
    if (!$this->tags->contains($tag)) {
      $this->tags->add($tag);
    }

    return $this;
  }

  /**
   * Remove tag
   *
   * @param \AppBundle\Entity\Tag $tag
   */
  public function removeTag(\AppBundle\Entity\Tag $tag) {
    $this->tags->removeElement($tag);
  }

  /**
   * Get tags
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getTags() {
    return $this->tags;
  }

  /**
   * Get author
   *
   * @return \AppBundle\Entity\PostAuthor
   */
  public function getAuthor() {
    return $this->author;
  }

  /**
   * Set author
   *
   * @param \AppBundle\Entity\PostAuthor $author
   *
   * @return Post
   */
  public function setAuthor(\AppBundle\Entity\PostAuthor $author = NULL) {
    $this->author = $author;

    return $this;
  }

  /**
   * @ORM\PrePersist
   */
  public function setPublicationDateOnPrePersist() {
    $this->setPublicationDate(new \DateTime());
  }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set poster
     *
     * @param MediaInterface $poster
     *
     * @return Post
     */
    public function setPoster(MediaInterface $poster = null)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return MediaInterface
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set gallery
     *
     * @param \Application\Sonata\MediaBundle\Entity\Gallery $gallery
     *
     * @return Post
     */
    public function setGallery(\Application\Sonata\MediaBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Application\Sonata\MediaBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
