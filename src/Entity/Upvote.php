<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use SymfonyComponentValidatorConstraints as Assert;
use App\Entity\Post;


/**
 * Upvote
 *
 * @ORM\Table(name="upvote")
 * @ORM\Entity(repositoryClass="App\Repository\UpvoteRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Upvote
{

  /**
  * @ORM\ManyToOne(targetEntity="Post", inversedBy="upvotes")
  * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
  */
  private $post;

  /**
   * @ORM\ManyToOne(targetEntity="User", inversedBy="upvotes")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
   private $user;

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;


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
     * Set post
     *
     * @param \App\Entity\Post $post
     *
     * @return Upvote
     */
    public function setPost(\App\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \App\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set user
     *
     * @param \App\Entity\User $user
     *
     * @return Upvote
     */
    public function setUser(\App\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Increment upvote_count
     *
     * @param Post
     *
     * @return $this
     */
     public function incrUpvote(\App\Entity\Post $post = null)
     {
       $post->incrUpvote();
       return $this;
     }

     /**
      * Decrement upvote_count
      *
      * @param Post
      *
      * @return $this
      */
     public function decrUpvote(\App\Entity\Post $post = null)
     {
       $post->decrUpvote();
       return $this;
     }
}
