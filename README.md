# 0 crie um conta na openai gere o token e implemente o código

# 1 composer require guzzlehttp/guzzle

# 2 composer require smalot/pdfparser

# 3 Modifique o UploadController para Usar o PDF Parser

\***\*\*\*\*\***\_\***\*\*\*\*\***onfigure token-openai em várivel de ambiente**\*\***\_\_\_**\*\***

# 1 - config\services.php

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
    ],

# 2 - .env

OPENAI_API_KEY=seu_token_qui

# 3 - no seu codigo:

$this->apiKey = config('services.openai.api_key');
