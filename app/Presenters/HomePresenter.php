<?php

declare(strict_types=1);

namespace App\Presenters;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Nette\Application\UI\Presenter;

final class HomePresenter extends Presenter
{
    private EntityManager $entityManager;

    public function __construct()
    {
        parent::__construct();

        $metadataConfig = Setup::createAnnotationMetadataConfiguration(
            [__DIR__ . '/app'],
            true,
            null,
            null,
            false
        );

        $connectionOptions = [
            'driver'   => 'pdo_mysql',
            'host'     => 'db',
            'port'     => 3306,
            'dbname'   => 'misuzadanie',
            'user'     => 'user',
            'password' => 'rootpassword',
            'charset'  => 'utf8',
        ];

        $this->entityManager = EntityManager::create($connectionOptions, $metadataConfig);
    }

    public function renderDefault(): void 
    {
        $connection = $this->entityManager->getConnection();
        
        try {

            $connection->connect();
            $this->flashMessage('Connection OK');

        } catch (\Exception $e) {

            $this->flashMessage('Connection FAIL');

        }

        $this->template->message = $this->getTemplate()->getParameters()['flashes'];
    }
}
