<?php

namespace Wearejust\GrumPHPExtra\Extension;

use GrumPHP\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Wearejust\GrumPHPExtra\Task\PhpCsAutoFixer;
use Wearejust\GrumPHPExtra\Task\Phpdoc;

class Loader implements ExtensionInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function load(ContainerBuilder $container)
    {
        $container->register('task.php_cs_auto_fixer', PhpCsAutoFixer::class)
            ->addArgument($container->get('config'))
            ->addArgument($container->get('process_builder'))
            ->addArgument($container->get('async_process_runner'))
            ->addArgument($container->get('formatter.php_cs_fixer'))
            ->addTag('grumphp.task', ['config' => 'php_cs_auto_fixer']);

        $container->register('task.phpdoc', Phpdoc::class)
            ->addArgument($container->get('config'))
            ->addArgument($container->get('process_builder'))
            ->addArgument($container->get('formatter.raw_process'))
            ->addTag('grumphp.task', ['config' => 'phpdoc']);
    }
}
