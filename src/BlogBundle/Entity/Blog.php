<?php

namespace BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Blog
 *
 * @ORM\Table(name="blog")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\BlogRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Blog
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
  /**
   * @var string
   *
   * @ORM\Column(name="title", type="string", length=255)
   */
  private $title;
  /**
   * @var string
   *
   * @ORM\Column(name="author", type="string", length=255)
   */
  private $author;
  /**
   * @var string
   *
   * @ORM\Column(name="blog", type="text")
   */
  private $blog;
  /**
   * @var string
   *
   * @ORM\Column(name="image", type="string", length=255)
   */
  private $image;
  /**
   * @var string
   *
   * @ORM\Column(name="tags", type="text")
   */
  private $tags;
  
  /**
   * @ORM\OneToMany(targetEntity="Comment", mappedBy="blog")
   */
  private $comments;

  public function getComments(){
    return $this->comments;
  }
  /**
   * @var \DateTime
   *
   * @ORM\Column(name="created", type="datetime")
   */
  private $created;
  /**
   * @var \DateTime
   *
   * @ORM\Column(name="updated", type="datetime")
   */
  private $updated;
  
  
  /**
   * @var string
   *
   * @ORM\Column(name="slug", type="string", length=255)
   */
  private $slug;
  
  
  public function __construct(){
    $this->setCreated(new \DateTime());
    $this->setUpdated(new \DateTime());
    
    $this->comments = new ArrayCollection();
  }

  /**
   * @ORM\PreUpdate
   */
  public function setUpdatedValue() {
    $this->setUpdated(new \DateTime());
  }

  /**
   * Get id
   *
   * @return integer 
   */
  public function getId()
  {
    return $this->id;
  }
  /**
   * Set title
   *
   * @param string $title
   * @return Blog
   */
  public function setTitle($title)
  {
    $this->title = $title;
    $this->setSlug($this->title);
    
    return $this;
  }
  /**
   * Get title
   *
   * @return string 
   */
  public function getTitle()
  {
    return $this->title;
  }
  /**
   * Set author
   *
   * @param string $author
   * @return Blog
   */
  public function setAuthor($author)
  {
    $this->author = $author;
    return $this;
  }
  /**
   * Get author
   *
   * @return string 
   */
  public function getAuthor()
  {
    return $this->author;
  }
  /**
   * Set blog
   *
   * @param string $blog
   * @return Blog
   */
  public function setBlog($blog)
  {
    $this->blog = $blog;
    return $this;
  }
  /**
   * Get blog
   *
   * @return string 
   */
  public function getBlog($length = null)
  {
    if (false === is_null($length) && $length > 0)
      return substr($this->blog, 0, $length);
    else
      return $this->blog;
  }
  /**
   * Set image
   *
   * @param string $image
   * @return Blog
   */
  public function setImage($image)
  {
    $this->image = $image;
    return $this;
  }
  /**
   * Get image
   *
   * @return string 
   */
  public function getImage()
  {
    return $this->image;
  }
  /**
   * Set tags
   *
   * @param string $tags
   * @return Blog
   */
  public function setTags($tags)
  {
    $this->tags = $tags;
    return $this;
  }
  /**
   * Get tags
   *
   * @return string 
   */
  public function getTags()
  {
    return $this->tags;
  }

  /**
   * Get created
   *
   * @return \DateTime 
   */
  public function getCreated()
  {
    return $this->created;
  }

  /**
   * Set created
   *
   * @param \DateTime $created
   * @return Blog
   */
  public function setCreated($created)
  {
    $this->created = $created;
    return $this;
  }

  /**
   * Set updated
   *
   * @param \DateTime $updated
   * @return Blog
   */
  public function setUpdated($updated)
  {
    $this->updated = $updated;
    return $this;
  }
  
  /**
   * Set slug
   *
   * @param string $slug
   * @return Blog
   */
  public function setSlug($slug){
    $this->slug = $this->slugify($slug);
    
    return $this;
  }
  
  /**
   * Get slug
   *
   * @return string 
   */
  public function getSlug(){
    return $this->slug;
  }
  
  /**
   * Add comment
   *
   * @param \BlogBundle\Entity\Comment $comment
   * @return Blog
   */
  public function addComment(\BlogBundle\Entity\Comment $comment){
    $this->comments[] = $comment;
    
    return $this;
  }
  
  /**
   * Remove comments
   *
   * @param \BlogBundle\Entity\Comment $comment
   */
  public function removeComment(\BlogBundle\Entity\Comment $comment){
    $this->comments->removeElement($comment);
  }
  
  private function slugify($text){
    //replace non letter or digits by -
    $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

    // trim
    $text = trim($text, '-');

    // transliterate
    if (function_exists('iconv')){
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }

    //lowercase
    $text = strtolower($text);

    //remove unwanted characters
    $text = preg_replace('#[^-\w]+#', '', $text);

    if (empty($text)){
      return 'n-a';
    }

    return $text;
  }
}