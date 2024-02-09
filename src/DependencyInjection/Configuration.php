<?php

declare(strict_types=1);

/**
 * This file is part of the TelegramBotBundle package.
 *
 * (c) Jose Clemente García Rodríguez aka m4n50n <josegarciarodriguez89@hotmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @author Jose Clemente García Rodríguez <josegarciarodriguez89@hotmail.com>
 * @link https://github.com/m4n50n/telegram_bot_bundle
 * 
 * @see https://symfony.com/doc/current/components/config/definition.html
 */

namespace M4n50n\TelegramBotBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder("telegram_bot_bundle");

        $rootNode = $treeBuilder->getRootNode();        
        $rootNode
            ->children()
                ->arrayNode("bots")
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey("bot_name")
                    ->prototype("array")
                        ->children()
                            ->scalarNode("key")->isRequired()->end()
                            ->scalarNode("username")->isRequired()->end()                            
                            ->arrayNode("webhook")
                                ->isRequired()
                                ->children()
                                    ->scalarNode("url")->isRequired()->end()
                                    ->scalarNode("max_connections")->isRequired()->end()
                                ->end()
                            ->end()
                            ->arrayNode("commands")
                                ->isRequired()
                                ->children()
                                    ->arrayNode("paths")
                                        ->isRequired()
                                        ->prototype("scalar")->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode("admins")
                                ->prototype("scalar")->end()
                                ->defaultValue([])
                            ->end()
                            ->arrayNode("mysql")
                                ->canBeUnset()
                                ->children()
                                    ->booleanNode("enabled")->defaultValue(false)->end()
                                    ->scalarNode("host")->defaultNull()->end()
                                    ->scalarNode("user")->defaultNull()->end()
                                    ->scalarNode("password")->defaultNull()->end()
                                    ->scalarNode("database")->defaultNull()->end()
                                ->end()
                            ->end()                            
                            ->arrayNode("log")
                                ->canBeUnset()
                                ->children()
                                    ->booleanNode("enabled")->defaultValue(false)->end()
                                    ->scalarNode("debug")->defaultNull()->end()
                                    ->scalarNode("error")->defaultNull()->end()
                                    ->scalarNode("update")->defaultNull()->end()
                                ->end()
                            ->end()
                            ->arrayNode("paths")
                                ->canBeUnset()
                                ->children()
                                    ->scalarNode("download")->defaultNull()->end()
                                    ->scalarNode("upload")->defaultNull()->end()
                                ->end()
                            ->end()
                            ->arrayNode("limiter")
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->booleanNode("enabled")->defaultValue(false)->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
