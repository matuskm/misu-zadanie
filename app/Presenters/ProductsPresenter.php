<?php

namespace App\Presenters;

use App\Eshops\EshopManager;
use Nette\Application\UI\Presenter;

class ProductsPresenter extends Presenter
{
    private $eshop_manager;

    public function __construct(EshopManager $eshop_manager)
    {
        $this->eshop_manager = $eshop_manager;
    }

    public function renderDefault()
    {
        $eshops_data = $this->eshop_manager->getDataFromAllEshops();

        // $eshop_feed = file_get_contents( 'http://localhost/feeds/eshop_neexistujuci.json' );

        dd($eshops_data);

        $this->template->eshops_data = $eshops_data;
    }
}