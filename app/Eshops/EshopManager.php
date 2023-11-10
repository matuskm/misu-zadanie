<?php

namespace App\Eshops;

use App\Interfaces\EshopHanlderInterface;
use App\Model\EshopModel;
use Nette\DI\Container;
use Nettrine\ORM\EntityManagerDecorator;

class EshopManager 
{
    private $container;
    protected $eshop_model;
    protected $entityManager;

    public function __construct( Container $container, EshopModel $eshop_model, EntityManagerDecorator $entityManager )
    {
        $this->container = $container;
        $this->eshop_model = $eshop_model;
        $this->entityManager = $entityManager;
    }

    /**
     * Shop existence checker in the database
     */
    private function checkExistsEshop( array $eshop_data )
    {
        $repository = $this->entityManager->getRepository( EshopModel::class );
        $eshop = $repository->findOneBy([
            'name'      => $eshop_data['eshop_name'],
            'eshop_url' => $eshop_data['eshop_url'],
        ]);

        return $eshop;
        
    }

    /**
     * Get data eshop
     */
    public function getDataFromAllEshops(): Array 
    {
        $data = [];

        $eshop_handlers = $this->container->findByType( EshopHanlderInterface::class );

        foreach ( $eshop_handlers as $eshop_handler ) {

            $eshop = $this->container->getService( $eshop_handler );
            $data[] = $eshop->getData();

        }

        return $data;
    }

    /**
     * Save data eshop to database
     * @return ID
     */
    public function saveDataToDb( array $eshop_data ): int 
    {
        $eshop = $this->checkExistsEshop( $eshop_data );

        if ( $eshop ) {
            return $eshop->getId();
        }

        $eshop = new EshopModel();
        $eshop->setEshopData( $eshop_data );
        $this->entityManager->persist( $eshop );
        $this->entityManager->flush();

        return $eshop->getId();
    }

    /**
     * Parshe data from feed to array
     */
    public function parsheDataToArray( $products, $eshop ): Array
    {
        $eshop_data = [
            'eshop_name'    => $eshop['name'],
            'eshop_url'     => $eshop['url'],
            'feed_url'      => $eshop['feed'],
            'items' => []
        ];

        foreach ( $products as $product ) {

            $eshop_data['items'][] = [
                'eshop_product_id'  => $product['id'],
                'name'              => $product['name'],
                'description'       => $product['description'],
                'price'             => $product['price'],
                'ean'               => $product['ean'],
            ];
            
        }

        return $eshop_data;
    }
}