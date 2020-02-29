<?php


namespace Framework\Command;


class RegisterRoutesCommand implements ICommandInterface
{

    /**
     * @var RouteCollection
     */
    private $routeCollection;

    /**
     * @var ContainerBuilder
     */
    private $containerBuilder;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }


    public function execute(): void
    {
        $this->routeCollection = require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routing.php';
        $this->containerBuilder->set('route_collection', $this->routeCollection);
    }
}