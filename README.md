PHP Telegram Bot Bundle
===================
[![Latest Stable Version](https://poser.pugx.org/m4n50n/telegram-bot-bundle/v/stable)](https://packagist.org/packages/m4n50n/telegram-bot-bundle)
[![License](https://poser.pugx.org/m4n50n/telegram-bot-bundle/license)](LICENSE.md)
[![Total Downloads](https://poser.pugx.org/m4n50n/telegram-bot-bundle/downloads)](https://packagist.org/packages/m4n50n/telegram-bot-bundle)

This bundle provides a wrapper for using [PHP Telegram Bot](https://github.com/php-telegram-bot) inside Symfony. Additional documentation can be found in the official repository.

## Installation

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

```
symfony composer require m4n50n/telegram-bot-bundle
```

### Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles in `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    M4n50n\TelegramBotBundle\TelegramBotBundle::class => ['all' => true],
];
```

## Configure the Bundle

```yaml
# config/packages/telegram_bot.yaml

telegram_bot:
  bots:
    first_bot:
      # Required #
      key: "%env(BOT_KEY)%"
      username: "%env(BOT_USERNAME)%"
      webhook:
        url: "%env(BOT_HOOK_URL)%"
        max_connections: "%env(BOT_MAX_CONNECTIONS)%"
      commands:
        paths:
          - "%env(BOT_COMMANDS_PATH)%"

      # Optional #
      admins:
        - 123456789 # Admin user id in Telegram
      mysql:
        enabled: true # false by default
        host: mysql
        user: "root"
        password: "%env(BOT_MYSQL_ROOT_PASSWORD)%"
        database: "%env(BOT_MYSQL_DB)%"
      log:
        enabled: true # false by default
        debug: "%env(LOG_DEBUG_FILE_PATH)%"
        error: "%env(LOG_ERROR_FILE_PATH)%"
        update: "%env(LOG_UPDATE_FILE_PATH)%"
      paths:
        download: "%env(DOWNLOADS_PATH)%"
        upload: "%env(UPLOADS_PATH)%"
      limiter:
        enabled: true # false by default

    second_bot:
      # ...

```

## Usage

Whenever you need to get a bot instance, use dependency injection for your service. The bot configuration is automatically loaded by providing the bot name, which should match the key in the configuration yaml file. For example:

```yaml
telegram_bot:
  bots:
    first_bot: # $botName
```

```php
use M4n50n\TelegramBotBundle\Factory\TelegramBotFactory;

final class TelegramBotService
{
    public function __construct(private TelegramBotFactory $factory)
    {
    }

    public function initialize(string $botName)
    {
        // ...
        return $this->factory->get($botName);        
    }
}
```

### Methods

This wrapper defines the basic bot configuration methods.

- `webhookHandler()` Method that will receive and handle incoming updates via an outgoing webhook.
- `setWebhook()` to register the webhook with Telegram. The endpoint to be configured as a webhook must be on a server with HTTPS support.
- `unsetWebhook()` to unregister the webhook.

If you create controllers for these methods, you will only have to do:

```php
namespace App\Controller;

// ...

final class PHPCodeTesterBotController extends AbstractController
{
  private readonly TelegramBot $bot;

  public function __construct(private TelegramBotService $telegramBotService)
  {
    $this->bot = $telegramBotService->initialize("bot_name");
  }

  #[Route('/endpoint', name: 'app_webhook_endpoint')]
  public function webhookEndpoint(): Response
  {
    // ...
    $webhookHandler = $this->bot->webhookHandler();
    // ... or
    $setWebhook = $this->bot->setWebhook();
    // ... or
    $unsetWebhook = $this->bot->unsetWebhook();
    // ...
  }
}
```

## Contributing

See [CONTRIBUTING](CONTRIBUTING.md) for more information.

## Security

See [SECURITY](SECURITY.md) for more information.

## License

Please see the [LICENSE](LICENSE) included in this repository for a full copy of the MIT license, which this project is licensed under.