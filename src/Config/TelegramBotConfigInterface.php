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

namespace M4n50n\TelegramBotBundle\Config;

/**
 * Interface for the configuration of Telegram bots.
 * 
 * Defines the methods that all bot configuration objects must implement.
 */
interface TelegramBotConfigInterface
{
    /**
     * Assigns the configuration parameters of the specified bot to the object.
     *
     * @param array $config
     * @return void
     */
    public function setConfig(array $config): void;

    /**
     * Get the Telegram API key for the bot.
     *
     * @return string The API key.
     */
    public function key(): string;

    /**
     * Get the username of the bot.
     *
     * @return string The bot's username.
     */
    public function username(): string;

    /**
     * Get webhook config params.
     *
     * @return array
     */
    public function webhook(): array;

    /**
     * Get commands config params.
     *
     * @return array
     */
    public function commands(): array;

    /**
     * Get admins config params.
     *
     * @return array
     */
    public function admins(): array;

    /**
     * Get mysql config params.
     *
     * @return array
     */
    public function mysql(): array;

    /**
     * Get log config params.
     *
     * @return array
     */
    public function log(): array;

    /**
     * Get paths config params.
     *
     * @return array
     */
    public function paths(): array;

    /**
     * Get limiter config params.
     *
     * @return array
     */
    public function limiter(): array;
}
