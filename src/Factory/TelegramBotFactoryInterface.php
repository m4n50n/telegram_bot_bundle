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
 */

namespace M4n50n\TelegramBotBundle\Factory;

use M4n50n\TelegramBotBundle\Core\TelegramBot;

interface TelegramBotFactoryInterface
{
    /**
     * Get an instance of the specified bot.
     *
     * @param string $botName The name of the bot to initialize 
     */
    public function get(string $botName): TelegramBot;
}
