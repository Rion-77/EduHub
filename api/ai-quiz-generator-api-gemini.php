<?php
if (!isset($_POST['topic'])) {
    header("Location: index.php");
}

require_once '../vendor/autoload.php';
require_once '../config/api-keys.php';



// use Gemini\Data\GenerationConfig;
// use Gemini\Data\Schema;
// use Gemini\Enums\DataType;
// use Gemini\Enums\ResponseMimeType;


// $result = $client
//     ->generativeModel(model: 'gemini-2.0-flash')
//     ->withGenerationConfig(
//         generationConfig: new GenerationConfig(
//             responseMimeType: ResponseMimeType::APPLICATION_JSON,
//             responseSchema: new Schema(
//                 type: DataType::ARRAY,
//                 items: new Schema(
//                     type: DataType::OBJECT,
//                     properties: [
//                         'recipe_name' => new Schema(type: DataType::STRING),
//                         'cooking_time_in_minutes' => new Schema(type: DataType::INTEGER)
//                     ],
//                     required: ['recipe_name', 'cooking_time_in_minutes'],
//                 )
//             )
//         )
//     )
//     ->generateContent('List 5 popular cookie recipes with cooking time');

// $result->json();

//[
//    {
//      +"cooking_time_in_minutes": 10,
//      +"recipe_name": "Chocolate Chip Cookies",
//    },
//    {
//      +"cooking_time_in_minutes": 12,
//      +"recipe_name": "Oatmeal Raisin Cookies",
//    },
//    {
//      +"cooking_time_in_minutes": 10,
//      +"recipe_name": "Peanut Butter Cookies",
//    },
//    {
//      +"cooking_time_in_minutes": 10,
//      +"recipe_name": "Snickerdoodles",
//    },
//    {
//      +"cooking_time_in_minutes": 12,
//      +"recipe_name": "Sugar Cookies",
//    },
//  ]





use Gemini\Data\GenerationConfig;
use Gemini\Data\Schema;
use Gemini\Enums\DataType;
use Gemini\Enums\ResponseMimeType;

$client = Gemini::client(GEMINI_API_KEY);


// User Request
$topic = $_POST['topic'];
$question_number = $_POST['question-number'];
$difficulty = $_POST['difficulty'];



// gemini-2.5-flash-lite

try {
    $result = $client
        ->generativeModel(model: 'gemini-2.5-flash-lite')
        ->withGenerationConfig(
            generationConfig: new GenerationConfig(
                responseMimeType: ResponseMimeType::APPLICATION_JSON,
                responseSchema: new Schema(
                    type: DataType::OBJECT,
                    properties: [
                        'quiz_name' => new Schema(type: DataType::STRING),
                        'description' => new Schema(type: DataType::STRING),
                        'time_limit' => new Schema(type: DataType::INTEGER),
                        'score' => new Schema(type: DataType::INTEGER),
                        'questions' => new Schema(
                            type: DataType::ARRAY,
                            items: new Schema(
                                type: DataType::OBJECT,
                                properties: [
                                    'question' => new Schema(type: DataType::STRING),
                                    'question_type_id' => new Schema(type: DataType::INTEGER),
                                    'options' => new Schema(
                                        type: DataType::ARRAY,
                                        items: new Schema(
                                            type: DataType::OBJECT,
                                            properties: [
                                                'option_text' => new Schema(type: DataType::STRING),
                                                'is_correct' => new Schema(
                                                    type: DataType::INTEGER,
                                                    description: '1 if correct option, otherwise 0'
                                                ),
                                            ],
                                            required: ['option_text', 'is_correct']
                                        )
                                    )
                                ],
                                required: ['question', 'question_type_id', 'options']
                            )
                        )
                    ],
                    required: ['quiz_name', 'description', 'time_limit', 'score', 'questions']
                )
            )
        )
        ->generateContent("create mcq questions on the {$topic}. number of questions is {$question_number}. questions difficulty is {$difficulty}");

    header('Content-Type: application/json');
    echo json_encode($result->json());
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}




/* 
quiz_name:
description:
time_limit:
score:
question: [{
         question:
         question_type_id: 1
         options: [
                 {option_text: 
                  is_correct: 1 if correct option, otherwise 0
                 },
                 {option_text: 
                  is_correct: 1 if correct option, otherwise 0
                 },
                 {option_text: 
                  is_correct: 1 if correct option, otherwise 0
                 } ,
                  {option_text: 
                  is_correct: 1 if correct option, otherwise 0
                 }     
                ]
         }, 
         {
         question:
         question_type_id: 1
         options: [
                 {option_text: 
                  is_correct: 1 if correct option, otherwise 0
                 },
                 {option_text: 
                  is_correct: 1 if correct option, otherwise 0
                 },
                 {option_text: 
                  is_correct: 1 if correct option, otherwise 0
                 } ,
                  {option_text: 
                  is_correct: 1 if correct option, otherwise 0
                 }     
                ]
         }  
        ]
}

*/

// $ai_reply =  $result->json();

// echo ($ai_reply);



// $response = [
//     'topic' => $topic,
//     'question-number' => $question_number,
//     'difficulty' => $difficulty
// ];

// $response = $client->generativeModel('gemini-2.5-flash-lite')->generateContent(
//     new TextPart($prompt),
// );