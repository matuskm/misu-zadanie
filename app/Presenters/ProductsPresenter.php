<?php

namespace App\Presenters;

use App\Eshops\EshopManager;
use App\Model\EshopModel;
use App\Model\ProductModel;
use Nette\Application\UI\Presenter;
use Nettrine\ORM\EntityManagerDecorator;

class ProductsPresenter extends Presenter
{
    private $eshop_manager;
    private $entityManager;

    public function __construct(EshopManager $eshop_manager, EntityManagerDecorator $entityManager)
    {
        $this->eshop_manager = $eshop_manager;
        $this->entityManager = $entityManager;
    }

    public function renderDefault()
    {
        $product = $this->entityManager->find(ProductModel::class, 1);

        if ($product) {

            $eshop = $product->getEshop();

            $eshop_data = (object) [
                'name'      => $eshop->getName(),
                'eshop_url' => $eshop->getEshopUrl(),
                'feed_url'  => $eshop->getFeedUrl()
            ];

            dd( $eshop_data->name );

        } else {

            $this->flashMessage('Produkt neexistuje', 'error');
            $this->redirect('default');

        }

        $eshops_data = $this->eshop_manager->getDataFromAllEshops();

        dd($eshops_data);

        $this->template->eshops_data = $eshops_data;
    }
}