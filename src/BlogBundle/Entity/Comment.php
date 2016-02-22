<?php

namespace BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\CommentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Comment
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
   * @ORM\Column(name="user", type="string", length=255)
   */
  private $user;
  /**
   * @var string
   *
   * @ORM\Column(name="comment", type="text")
   */
  private $comment;
  /**
   * @var bool
   *
   * @ORM\Column(name="approved", type="boolean")
   */
  private $approved;
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
   * @ORM\ManyToOne(targetEntity="Blog", inversedBy="comments")
   * @ORM\JoinColumn(name="blog_id", referencedColumnName="id")
   */
  private $blog;
  public function __construct() {
    $this->setCreated(new \DateTime);
    $this->setUpdated(new \DateTime);

    $this->setApproved(true);
  }

  /**
   * @ORM\PreUpdate
   */
  public function setUpdatedValue(){
    $this->setUpdated(new \DateTime);
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
   * Set user
   *
   * @param string $user
   * @return Comment
   */
  public function setUser($user)
  {
    $this->user = $user;
    return $this;
  }
  /**
   * Get user
   *
   * @return string 
   */
  public function getUser()
  {
    return $this->user;
  }
  /**
   * Set comment
   *
   * @param string $comment
   * @return Comment
   */
  public function setComment($comment)
  {
    $this->comment = $comment;
    return $this;
  }
  /**
   * Get comment
   *
   * @return string 
   */
  public function getComment()
  {
    return $this->comment;
  }
  /**
   * Set approved
   *
   * @param boolean $approved
   * @return Comment
   */
  public function setApproved($approved)
  {
    $this->approved = $approved;
    return $this;
  }
  /**
   * Get approved
   *
   * @return boolean 
   */
  public function getApproved()
  {
    return $this->approved;
  }
  /**
   * Set created
   *
   * @param \DateTime $created
   * @return Comment
   */
  public function setCreated($created)
  {
    $this->created = $created;
    return $this;
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
   * Set updated
   *
   * @param \DateTime $updated
   * @return Comment
   */
  public function setUpdated($updated)
  {
    $this->updated = $updated;
    return $this;
  }
  /**
   * Set blog
   *
   * @param \BlogBundle\Entity\Blog $blog
   * @return Comment
   */
  public function setBlog(\BlogBundle\Entity\Blog $blog = null)
  {
    $this->blog = $blog;
    return $this;
  }
  /**
   * Get blog
   *
   * @return \BlogBundle\Entity\Blog 
   */
  public function getBlog()
  {
    return $this->blog;
  }
}