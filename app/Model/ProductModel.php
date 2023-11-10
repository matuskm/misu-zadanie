<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class ProductModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $eshop_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=18)
     */
    protected $ean;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    protected $old_price;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    protected $new_price;

    /**
     * @ORM\ManyToOne(targetEntity="Eshop", inversedBy="products")
     * @ORM\JoinColumn(name="eshop_id", referencedColumnName="id")
     */
    protected $eshop;

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

    public function getOldPrice() {
		return $this->old_price;
	}

    public function getNewPrice() {
		return $this->new_price;
	}

    public function getEshop()
    {
        return $this->eshop;
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