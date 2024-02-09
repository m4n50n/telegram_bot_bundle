<?php

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
