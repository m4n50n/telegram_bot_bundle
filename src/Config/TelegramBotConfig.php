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
 * Represents the configuration of a Telegram bot.
 * 
 * @link https://github.com/m4n50n
 */
class TelegramBotConfig implements TelegramBotConfigInterface
{
    private string $key;
    private string $username;
    private array $webhook = [];
    private array $commands = [];
    private array $admins = [];
    private array $mysql = [];
    private array $log = [];
    private array $paths = [];
    private array $limiter = [];

    /**
     * Constructor.
     *
     * @param array $config The bot config.
     */
    public function __construct(array $config)
    {
        $this->setConfig($config);
    }

    /**
     * {@inheritDoc}
     */
    public function setConfig(array $config): void
    {
        foreach ($config as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function key(): string
    {
        return $this->key;
    }

    /**
     * {@inheritDoc}
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * {@inheritDoc}
     */
    public function webhook(): array
    {
        return $this->webhook;
    }

    /**
     * {@inheritDoc}
     */
    public function commands(): array
    {
        return $this->commands;
    }

    /**
     * {@inheritDoc}
     */
    public function admins(): array
    {
        return $this->admins;
    }

    /**
     * {@inheritDoc}
     */
    public function mysql(): array
    {
        return $this->mysql;
    }

    /**
     * {@inheritDoc}
     */
    public function log(): array
    {
        return $this->log;
    }

    /**
     * {@inheritDoc}
     */
    public function paths(): array
    {
        return $this->paths;
    }

    /**
     * {@inheritDoc}
     */
    public function limiter(): array
    {
        return $this->limiter;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize(): array
    {
        return [
            'key'      => $this->key,
            'username' => $this->username,
            'webhook'  => $this->webhook,
            'commands' => $this->commands,
            'admins'   => $this->admins,
            'mysql'    => $this->mysql,
            'log'      => $this->log,
            'paths'    => $this->paths,
            'limiter'  => $this->limiter,
        ];
    }
}
