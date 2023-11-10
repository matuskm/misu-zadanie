<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="eshops")
 */
class EshopModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eshop_url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $feed_url;

    /**
     * Getters
     */
    public function getId() {
		return $this->id;
	}

    public function getName() {
		return $this->name;
	}

    public function getEshopUrl() {
		return $this->eshop_url;
	}

    public function getFeedUrl() {
		return $this->feed_url;
	}

    /**
     * Setters
     */
    public function setEshopData( array $data )
    {
        $this->setName( $data['eshop_name'] );
        $this->setEshopUrl( $data['eshop_url'] );
        $this->setFeedUrl( $data['feed_url'] );
    }

    public function setName( string $name )
    {
        $this->name = $name;
    }

    public function setEshopUrl( string $eshop_url )
    {
        $this->eshop_url = $eshop_url;
    }

    public function setFeedUrl( string $feed_url )
    {
        $this->feed_url = $feed_url;
    }
}