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

namespace M4n50n\TelegramBotBundle\Core;

use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Telegram;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

/**
 * Interface for Telegram bots.
 * 
 * Defines the methods that all bots must implement.
 */
interface TelegramBotInterface
{
    /**
     * Start of the process of creating a new bot instance.
     *
     * @return Telegram The longman/telegram-bot bot object.
     * @throws Exception If any error occurs while creating the bot.
     */
    public function initialize(): Telegram;

    /**
     * Initializes a new instance of the specified bot.     
     * 
     * @return void
     */
    public function initializeBot(): void;

    /**
     * Enable bot admin users if configured.
     * 
     * @return void
     */
    public function enableAdmins(): void;

    /**
     * Initialize the bot log to capture errors, debug and raw updates.
     * it is mandatory to assign read permission to folders.
     *
     * @link https://github.com/php-telegram-bot/core/blob/master/doc/01-utils.md#logging
     * @return void
     * @throws Exception If any error occurs when enabling the log.
     */
    public function configureLogging(): void;

    /**
     * Create an StreamHandler object
     * 
     * @param string $path
     * @param Level $level
     * @return StreamHandler     
     */
    public function createStreamHandler(string $path, Level $level): StreamHandler;

    /**
     * Enable MySQL database.
     * 
     * @return void
     */
    public function enableMySql(): void;

    /**
     * Configure file download and upload paths.
     * 
     * @return void
     */
    public function configurePaths(): void;

    /**
     * Current webhook handler.
     *
     * @return void
     * @throws Exception If any error occurs when handling the webhook.
     */
    public function webhookHandler(): void;

    /**
     * Set the webhook for the bot.
     *
     * @return ServerResponse
     * @throws Exception If any error occurs when setting the webhook.
     */
    public function setWebhook(): ServerResponse;

    /**
     * Unset (remove) the webhook for the bot.
     *
     * @return ServerResponse
     * @throws Exception If any error occurs when unsetting the webhook.
     */
    public function unsetWebhook(): ServerResponse;
}
