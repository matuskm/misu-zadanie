<?php

namespace App\Eshops\Handler;

use App\Eshops\EshopManager;
use App\Interfaces\EshopHanlderInterface;

class Eshop2Handler implements EshopHanlderInterface
{
    private $wwwDir;
    private $eshop_manager;

    private $eshop;

    public function __construct(string $wwwDir, EshopManager $eshop_manager)
    {
        $this->wwwDir = $wwwDir;
        $this->eshop_manager = $eshop_manager;
        
        /**
         * Variable parameters for current eshop. Please modify to your needs.
         */
        $this->eshop = [
            'name'  => 'Neexistujuci eshop',
            'url'   => 'https://neexistujuci-eshop.sk',
            'feed'  => $this->wwwDir .'/feeds/eshop_neexistujuci.json'
        ];

    }

    public function getData(): Array
    {
        $eshop_feed = file_get_contents( $this->eshop['feed'] );

        if ( !file_exists( $this->eshop['feed'] ) ) {
            throw new \Exception( 'Súbor neexistuje: '. $this->eshop['feed'] );
        }
        
        /**
         * Parshe data from feed to array
         */
        $data_feed = json_decode( $eshop_feed, true );

        $eshop_data = $this->eshop_manager->parsheDataToArray( $data_feed['products'], $this->eshop );
        $new_eshop_id = $this->eshop_manager->saveDataToDb( $eshop_data );
        $result_data = array_merge(['eshop_id' => $new_eshop_id], $eshop_data);
        
        return $result_data;
    }

}