<?php

namespace App\Http\Controllers;

use App\Services\OpenAIChatService;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'pdf_file' => 'required|mimes:pdf|max:10240', // 10MB
            ]);

            // Obtendo o arquivo PDF e lendo o conteúdo como string
            $pdfFile = $request->file('pdf_file');
            $pdfContent = file_get_contents($pdfFile->getRealPath());

            // Usando o PDF Parser para extrair o conteúdo
            $parser = new Parser();
            $pdf = $parser->parseContent($pdfContent);
            $text = $pdf->getText();

            // Usando o serviço para consultar a OpenAI API
            $chatService = new OpenAIChatService(); // Passa a API key para o serviço
            $response = $chatService->analyzeText($text);
            return view('upload-pdf-fiscalizacao', compact('text', 'response'));  // compact possibilita passar varias variaveis

        } catch (\Illuminate\Validation\ValidationException $e) {
            $messageValidFile = "Arquivo não está no formato correto!";
            $validationErrors = $e->getMessage();
            return view('upload-pdf-fiscalizacao')->with([
                "messageValidFile" => $messageValidFile,
                "validationErrors" => $validationErrors
            ]);
        }
    }
}
