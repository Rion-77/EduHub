<?php
if (!isset($_POST['topic'])) {
    header("Location: index.php");
    exit;
}

require_once '../vendor/autoload.php';
require_once '../config/api-keys.php';

header('Content-Type: application/json');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// ==================== USER INPUT ====================
$topic           = $_POST['topic'];
$question_number = (int) $_POST['question-number'];
$difficulty      = $_POST['difficulty'];

// ==================== SYSTEM PROMPT (defines JSON schema) ====================
$systemPrompt = "You are a quiz generator. Always respond with valid JSON only. "
    . "Follow this exact JSON structure:\n"
    . "{\n"
    . "  \"quiz_name\": \"string\",\n"
    . "  \"description\": \"string\",\n"
    . "  \"time_limit\": integer (minutes),\n"
    . "  \"score\": integer (total points),\n"
    . "  \"questions\": [\n"
    . "    {\n"
    . "      \"question\": \"string\",\n"
    . "      \"question_type_id\": integer (1 for multiple-choice),\n"
    . "      \"options\": [\n"
    . "        {\n"
    . "          \"option_text\": \"string\",\n"
    . "          \"is_correct\": integer (1 if correct, else 0)\n"
    . "        }\n"
    . "      ]\n"
    . "    }\n"
    . "  ]\n"
    . "}\n"
    . "Ensure all fields are present and valid. Provide exactly {$question_number} questions.";

// ==================== USER PROMPT ====================
$userPrompt = "Create {$question_number} multiple-choice questions on the topic: '{$topic}'. "
    . "The difficulty level is '{$difficulty}'. "
    . "For each question, provide 4 options with exactly one correct answer. "
    . "Generate a meaningful quiz name, description, a time limit (in minutes), and a total score.";

// ==================== GUZZLE CLIENT ====================
$httpClient = new Client([
    'base_uri' => 'https://api.deepseek.com/v1/',
    'timeout'  => 60.0,
    'headers'  => [
        'Authorization' => 'Bearer ' . DEEPSEEK_API_KEY,
        'Content-Type'  => 'application/json',
    ],
]);

try {
    // ==================== SEND REQUEST ====================
    $response = $httpClient->post('chat/completions', [
        'json' => [
            'model'       => 'deepseek-v4-flash',   // or 'deepseek-v4-pro'
            'messages'    => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user',   'content' => $userPrompt],
            ],
            'response_format' => ['type' => 'json_object'], // forces JSON
            'temperature'     => 0.7,
            'max_tokens'      => 4096,
        ],
    ]);

    // ==================== PARSE RESPONSE ====================
    $data   = json_decode($response->getBody(), true);
    $content = $data['choices'][0]['message']['content'] ?? null;
    if (!$content) {
        throw new Exception('Empty response from DeepSeek API');
    }

    $result = json_decode($content, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON from DeepSeek: ' . json_last_error_msg());
    }

    // ==================== OUTPUT (same as original) ====================
    echo json_encode($result);

} catch (RequestException $e) {
    echo json_encode(['error' => 'Request failed: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}