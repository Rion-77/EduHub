<?php
if (!isset($_POST['topic'])) {
    header("Location: index.php");
    exit;
}

require_once '../vendor/autoload.php';
require_once '../config/api-keys.php';

// User Request
$topic = $_POST['topic'];
$question_number = $_POST['question-number'];
$difficulty = $_POST['difficulty'];

// OpenRouter Endpoint and API Key
$endpoint = 'https://openrouter.ai/api/v1/chat/completions';
$apiKey = OPENROUTER_API_KEY; 

// We provide the structural layout template directly inside the prompt for openrouter/auto
$jsonStructurePrompt = '
{
  "quiz_name": "string",
  "description": "string",
  "time_limit": 10,
  "score": 100,
  "questions": [
    {
      "question": "string",
      "question_type_id": 1,
      "options": [
        {
          "option_text": "string",
          "is_correct": 1
        }
      ]
    }
  ]
}';

// OpenRouter Payload with default model and generic JSON object constraint
$data = [
    'model' => 'openrouter/auto', 
    'messages' => [
        [
            'role' => 'user',
            'content' => "create mcq questions on the {$topic}. number of questions is {$question_number}. questions difficulty is {$difficulty}. You must output your response matching this exact JSON schema structure: " . $jsonStructurePrompt
        ]
    ],
    'response_format' => [
        'type' => 'json_object' // Highly compatible mode supported by all auto-routed models
    ]
];

$headers = [
    "Authorization: Bearer $apiKey",
    "Content-Type: application/json"
];

// Execute Request via cURL
$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
} else {
    $result = json_decode($response, true);
    
    if (isset($result['choices'][0]['message']['content'])) {
        $ai_reply_string = $result['choices'][0]['message']['content'];
        
        header('Content-Type: application/json');
        echo json_encode(json_decode($ai_reply_string, true));
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Invalid response from OpenRouter', 'raw' => $result]);
    }
}