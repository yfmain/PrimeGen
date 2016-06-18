<?php
namespace DevSpace\DI;

use DevSpace\DI\Interfaces\IContainer;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

const DEVSPECE_APPLICATION_MODE = "Development";

class Container implements IContainer
{
    /** @var ContainerBuilder */
    private $containerBuilder;

    public function __construct()
    {
        $this->containerBuilder = new ContainerBuilder();
        $this->loadConfiguration();
    }

    public function get($serviceName)
    {
        return $this->containerBuilder->get($serviceName);
    }
    
    public function getContainer()
    {
        return $this->containerBuilder;
    }

    /**
     * @return ContainerBuilder
     */
    private function loadConfiguration()
    {
        $loader = new YamlFileLoader($this->containerBuilder, new FileLocator($this->getConfigurationPath()));
        $loader->load('container.yml');
    }

    private function getConfigurationPath()
    {
        return __DIR__ . "/../Configuration/DI/" . DEVSPECE_APPLICATION_MODE . "/";
    }
}