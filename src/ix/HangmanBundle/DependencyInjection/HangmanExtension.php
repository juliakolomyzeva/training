<?php
/**
 * Created by PhpStorm.
 * User: infolox
 * Date: 29.06.17
 * Time: 14:43
 */
namespace ix\HangmanBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class HangmanExtension extends Extension
{
 public function load(array $configs, ContainerBuilder $container)
 {
     $locator = new FileLocator(__DIR__.'/../Resources/config');
     $loader = new YamlFileLoader($container, $locator);

     $loader->load('services.yml');
 }
}