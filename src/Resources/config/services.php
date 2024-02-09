<?php

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
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use M4n50n\TelegramBotBundle\Factory\TelegramBotFactory;
use Symfony\Component\DependencyInjection\Parameter;

return static function (ContainerConfigurator $container): void {
    $container
        ->services()
        ->set(TelegramBotFactory::class)
        ->args([
            new Parameter("telegram_bot_bundle.bots"),
        ]);
};
