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

namespace M4n50n\TelegramBotBundle\Resources\Service;

use M4n50n\TelegramBotBundle\Factory\TelegramBotFactory;

final class TelegramBotService
{
    public function __construct(private TelegramBotFactory $factory)
    {
    }

    public function initialize(string $botName)
    {
        return $this->factory->get($botName);
    }
}
