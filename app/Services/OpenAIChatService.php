<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIChatService
{
    protected $apiKey;
    protected $client;

    public function __construct()

    {
        $this->apiKey = config('services.openai.api_key');
        $this->client = new Client(['base_uri' => 'https://api.openai.com']);
    }

    public function analyzeText($text)
    {
        if (empty($text)) {
            return "O texto está vazio.";
        }
        $message = "";
        $message .= "Sobre esse conteúdo: " . $text . "\n";
        $message .= "Faça uma análise contábil verificando se o texto está em comformidade com os items abaixo:\n";
        $message .= "1 - Promova uma análise quanto a estrutura de apresentação das demonstrações contábeis de acordo com a NBCTG 1000.\n";
        $message .= "Analisar os seguintes elementos:\n";
        $message .= "1 - Existência do conjunto completo das demonstrações contábeis de acordo com o item 3.17 da NBC TG 1000 Item 3.17 e seguintes da NBC TG 1000 3.17\n";
        $message .= "O conjunto completo de demonstrações contábeis da entidade deve incluir todas as seguintes demonstrações:\n";
        $message .= "a - balanço patrimonial ao final do período;\n";
        $message .= "b - demonstração do resultado do período de divulgação;\n";
        $message .= "c - demonstração do resultado abrangente do período de divulgação. A demonstração do resultado abrangente pode ser apresentada em quadro demonstrativo próprio ou dentro das mutações do patrimônio líquido. A demonstração do resultado abrangente, quando apresentada separadamente, começa com o resultado do período e se completa com os itens dos outros resultados abrangentes;\n";
        $message .= "d - demonstração das mutações do patrimônio líquido para o período de divulgação";

        // Faz a chamada à OpenAI API
        $response = $this->sendChatRequest($message);
        return $response;
    }
    public function sendChatRequest($message)
    {
        $response = $this->client->post('/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                // 'organization' => 'org-FwGyFAEEwWg5stp4IuCVgibP',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo', // ou o modelo que você está utilizando
                'messages' => [
                    ['role' => 'user', 'content' => $message],
                ],
            ],
        ]);

        // Decodificar o JSON de resposta
        $result = json_decode($response->getBody()->getContents(), true);
        // Retornar o conteúdo gerado pela IA
        return $result['choices'][0]['message']['content'] ?? 'Erro ao gerar resposta';
    }
}
