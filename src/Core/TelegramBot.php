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
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Exception\TelegramLogException;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;
use M4n50n\TelegramBotBundle\Config\TelegramBotConfig;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

final class TelegramBot implements TelegramBotInterface
{
    private Telegram $bot;

    /**
     * Constructor.
     * 
     * @param TelegramBotConfig $config The bot config.
     */
    public function __construct(private TelegramBotConfig $config)
    {
        $this->initialize();
    }

    /**
     * {@inheritDoc}
     */
    public function initialize(): Telegram
    {
        try {
            $this->initializeBot();
            $this->enableAdmins();
            $this->configureLogging();
            $this->enableMySql();
            $this->configurePaths();

            return $this->bot;
        } catch (TelegramException | TelegramLogException | \Exception $exception) {
            throw new \Exception(sprintf("'%s'", $exception->getMessage()));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function initializeBot(): void
    {
        $this->bot = new Telegram($this->config->key(), $this->config->username());

        $this->bot->addCommandsPaths($this->config->commands()["paths"]);
        $this->bot->enableLimiter($this->config->limiter());
    }

    /**
     * {@inheritDoc}
     */
    public function enableAdmins(): void
    {
        $adminsConfig = $this->config->admins();

        if ($adminsConfig) {
            $this->bot->enableAdmins($adminsConfig);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function configureLogging(): void
    {
        try {
            $username = $this->config->username();

            TelegramLog::initialize(
                new Logger($username, [
                    $this->createStreamHandler($this->config->log()["debug"], Level::Debug),
                    $this->createStreamHandler($this->config->log()["error"], Level::Error),
                ]),
                new Logger($username . "updates", [
                    $this->createStreamHandler($this->config->log()["update"], Level::Info),
                ])
            );

            TelegramLog::$always_log_request_and_response = true;
            TelegramLog::$remove_bot_token = false;
        } catch (TelegramException | TelegramLogException | \Exception $exception) {
            throw $exception;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function createStreamHandler(string $path, Level $level): StreamHandler
    {
        return (new StreamHandler($path, $level))->setFormatter(new LineFormatter(null, null, true));
    }

    /**
     * {@inheritDoc}
     */
    public function enableMySql(): void
    {
        $mysqlConfig = $this->config->mysql();

        if ($mysqlConfig && $mysqlConfig["enabled"]) {
            $this->bot->enableMySql($mysqlConfig);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function configurePaths(): void
    {
        $pathsConfig = $this->config->paths();

        if ($pathsConfig) {
            if ($this->config->paths()["upload"]) {
                $this->bot->setUploadPath($this->config->paths()["upload"]);
            }

            if ($this->config->paths()["download"]) {
                $this->bot->setDownloadPath($this->config->paths()["download"]);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function webhookHandler(): void
    {
        try {
            $this->bot->handle();
        } catch (TelegramException | \Exception $exception) {
            throw new \Exception(sprintf("'%s'", $exception->getMessage()));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setWebhook(): ServerResponse
    {
        try {
            return $this->bot->setWebhook($this->config->webhook()["url"]);
        } catch (TelegramException | \Exception $exception) {
            throw new \Exception(sprintf("'%s'", $exception->getMessage()));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function unsetWebhook(): ServerResponse
    {
        try {
            return $this->bot->deleteWebhook();
        } catch (TelegramException | \Exception $exception) {
            throw new \Exception(sprintf("'%s'", $exception->getMessage()));
        }
    }
}
