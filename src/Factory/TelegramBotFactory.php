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

use M4n50n\TelegramBotBundle\Config\TelegramBotConfig;
use M4n50n\TelegramBotBundle\Core\TelegramBot;

final class TelegramBotFactory implements TelegramBotFactoryInterface
{
    /**
     * @param array $botsConfig
     */
    public function __construct(private array $botsConfig = [])
    {
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $botName): TelegramBot
    {
        if (!isset($this->botsConfig[$botName])) {
            throw new \InvalidArgumentException(sprintf('Bot "%s" not configured', $botName));
        }

        return new TelegramBot(new TelegramBotConfig($this->botsConfig[$botName]));
    }
}
