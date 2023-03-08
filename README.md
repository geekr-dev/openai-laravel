# openai-laravel

Laravel OpenAI Wrapper with support for proxy

Install:

```bash
composer require geekr/openai-laravel
```

Publish config file:

```bash
php artisan vendor:publish --provider="GeekrOpenAI\Laravel\ServiceProvider"
```

Edit `OPENAI_*` setting in `.env`:

```
OPENAI_API_KEY={your openai api key}
OPENAI_BASE_URI=open.aiproxy.xyz/v1
```

Usage:

```php
use GeekrOpenAI\Laravel\Facades\OpenAI;

$response = OpenAI::chat()->create([
    'model' => 'gpt-3.5-turbo',
    'messages' => $messages
]);

$content = $response->choices[0]->message->content
```

Sample Project: 

<https://github.com/geekr-dev/geekchat>

<img width="615" alt="image" src="https://user-images.githubusercontent.com/114386672/223631698-849855fa-76b9-4015-a61f-39cb7942be97.png">


