<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;
use Doctrine\ORM\EntityRepository;

/**
 * @ORM\Table("oauth2_access_tokens")
 * @ORM\Entity(repositoryClass="App\Repository\AccessTokenRepository")
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="token",
 *         column=@ORM\Column(
 *             name   = "token",
 *             type   = "string",
 *             length = 128
 *         )
 *     )
 * })
 */
class AccessToken extends BaseAccessToken
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    protected $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getClient(): ?Client
    // {
    //     return $this->client;
    // }

    // public function setClient(?Client $client): self
    // {
    //     $this->client = $client;

    //     return $this;
    // }

    // public function getUser(): ?User
    // {
    //     return $this->user;
    // }

    // public function setUser(?User $user): self
    // {
    //     $this->user = $user;

    //     return $this;
    // }
    
}

