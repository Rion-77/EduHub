<?php
ob_start();
require_once "config/database-connect.php";
require_once 'classes/ai-quiz.class.php';

if (isset($_POST['start-quiz-btn'])) {

  /* ************************************* */
  // Gets quiz json and
  $generated_quiz = json_decode($_POST['quiz-json'], true);

  // echo "<pre>";
  // print_r($generated_quiz);
  // var_dump($generated_quiz);
  // echo "<pre>";

  /* ************************************* */
  // Add quiz and get quiz id

  $quiz_name = $generated_quiz['quiz_name'];
  $category_id = 11;
  $description = $generated_quiz['description'];
  $time_limit = "00:" . count($generated_quiz['questions']) . ":00";
  $score = count($generated_quiz['questions']);

  // echo $quiz_name . "<br>";
  // echo $description . "<br>";
  // echo $time_limit . "<br>";
  // echo $score . "<br>";
  // print_r($_POST);
  // echo "</pre>";

  // Save data to database
  $quiz = new AIQuiz(null, $quiz_name, $category_id, $description, $time_limit, $score, null);
  $quiz_id = $quiz->createQuiz();
  // echo $quiz_id . "<br>";

  /* ************************************* */
  // Add questions with options

  foreach ($generated_quiz['questions'] as $question) {
    // echo $question['question'] . "<br>";
    // Add question
    $question_id =  $quiz->createQuestion($question['question'], $quiz_id, $question['question_type_id']);

    // Add option
    foreach ($question['options'] as $option) {
      // echo "<p style='padding-left: 10px'>" . $option['option_text'] . "</p>";

      $quiz->createOption($option['option_text'], $question_id, $option['is_correct']);
    }
  }


  // Redirect to quiz page
  header("Location: quiz.php?quiz-id=$quiz_id&category_id=$category_id");
}
?>


<!-- Header -->
<?php include_once "header.php" ?>


<!-- Hero -->
<div class="ai-hero">
  <div class="container">
    <div class="ai-label" style="margin-bottom:12px"><span class="ai-dot"></span> AI-Powered</div>
    <h1>AI Quiz Generator</h1>
    <p style="max-width:500px;margin-top:9px">Generate custom quizzes on any topic instantly — your personal quiz creator available 24/7.</p>
  </div>
</div>

<div class="generation-container container" style="padding-top:0;padding-bottom:72px">
  <div class="gen-layout">

    <!-- Generation -->
      <div class="gen-card anim-fade-up" style="animation-play-state: running;">
        <h3 style="margin-bottom:20px">⚙️ Configure Your Quiz</h3>

        <div class="form-group">
          <label class="form-label">📖 Topic or Subject</label>
          <input class="form-input" type="text" name="topic" placeholder="HTML form, CSS transitions, Jqeury basics">
          <div class="form-hint empty-topic" style="display:none; color:red; font-size:16px">Please enter a topic</div>
          <div class="form-hint">Be specific for better quality questions.</div>
        </div>

        <div class="form-group">
          <label class="form-label">🔢 Number of Questions</label>
          <select class="form-select" name="question-number">
            <option value="5">5 questions</option>
            <option value="10">10 questions</option>
            <option value="15">15 questions</option>
            <option value="20" selected>20 questions</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" style="margin-bottom:10px">🎯 Difficulty Level</label>
          <div class="diff-grid">
            <label class="diff-option">
              <input type="radio" name="difficulty" value="easy">
              <div class="diff-emoji">🟢</div>
              <div class="diff-label">Easy</div>
            </label>
            <label class="diff-option active">
              <input type="radio" name="difficulty" value="medium" checked="">
              <div class="diff-emoji">🟡</div>
              <div class="diff-label">Medium</div>
            </label>
            <label class="diff-option">
              <input type="radio" name="difficulty" value="hard">
              <div class="diff-emoji">🔴</div>
              <div class="diff-label">Hard</div>
            </label>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" style="margin-bottom:10px">❓ Question Types</label>
          <div class="qtype-grid">
            <label class="qtype-opt active">
              <input type="checkbox" name="types[]" value="mcq" checked="">
              <span>🔘</span><span style="font-family:var(--font-display);font-weight:700;font-size:.82rem">Multiple Choice</span>
              <div class="qtype-check"></div>
            </label>
            <!-- <label class="qtype-opt">
              <input type="checkbox" name="types[]" value="tf">
              <span>✅</span><span style="font-family:var(--font-display);font-weight:700;font-size:.82rem">True / False</span>
              <div class="qtype-check"></div>
            </label> -->
            <!-- <label class="qtype-opt">
              <input type="checkbox" name="types[]" value="fill">
              <span>✏️</span><span style="font-family:var(--font-display);font-weight:700;font-size:.82rem">Fill in Blank</span>
              <div class="qtype-check"></div>
            </label> -->
            <!-- <label class="qtype-opt">
              <input type="checkbox" name="types[]" value="short">
              <span>📝</span><span style="font-family:var(--font-display);font-weight:700;font-size:.82rem">Short Answer</span>
              <div class="qtype-check"></div>
            </label> -->
          </div>
        </div>


        <button class="gen-btn" type="submit">✨ Generate Quiz Now</button>
      </div>

    <!-- Preview -->
    <div class="preview-card anim-fade-up delay-1" style="display:none; animation-play-state: running; min-height: 592px">
      <div style="align-items:center;justify-content:space-between;margin-bottom:16px" class="preview-header">
        <h3>📋 Generated Preview</h3>
        <!-- start quiz button -->
        <div class="start-quiz-container" style="display:none">
          <form method="POST">
            <input class="json-holder" type="hidden" name="quiz-json">
            <button type="submit" name="start-quiz-btn" class="btn btn-primary">▶ Start Quiz</button>
          </form>
        </div>
      </div>

      <div class="quiz-info alert alert-info" style="margin-bottom:16px"><span>✨</span>
        <h3 class="quiz-title"></h3>
        <p class="quiz-desciption"></p>

      </div>

      <!-- PHP: foreach ($preview_questions as $i => $pq) -->
      <div class="generated-qustions">
        Generate quiz to see a preview here.
      </div>


      <!-- <div style="text-align:center;padding:10px;color:var(--slate);font-size:.83rem;background:var(--bg);border-radius:var(--radius-md)">+ 7 more questions</div> -->


    </div>
  </div>
</div>

<!-- footer -->
<?php include_once "footer.php" ?>


<!-- 

// gemini response

{
  "quiz_name": "CSS Medium Difficulty Quiz",
  "description": "Test your knowledge of CSS with these medium difficulty questions.",
  "time_limit": 600,
  "score": 100,
  "questions": [
    {
      "question": "What does the 'em' unit represent in CSS?",
      "question_type_id": 1,
      "options": [
        {"option_text": "A fixed unit equal to 16 pixels", "is_correct": 0},
        {"option_text": "The font size of the parent element", "is_correct": 1},
        {"option_text": "The font size of the nearest sibling element", "is_correct": 0},
        {"option_text": "A relative unit based on the viewport width", "is_correct": 0}
      ]
    },
    {
      "question": "What does the `display: inline-block;` property do?",
      "question_type_id": 1,
      "options": [
        {"option_text": "Makes the element take up the full width available.", "is_correct": 0},
        {"option_text": "Allows setting width and height, but the element flows with text.", "is_correct": 1},
        {"option_text": "Makes the element disappear.", "is_correct": 0},
        {"option_text": "Makes the element behave like a block element but without starting on a new line.", "is_correct": 0}
      ]
    },
    {
      "question": "What is the CSS 'box model' composed of?",
      "question_type_id": 1,
      "options": [
        {"option_text": "Margin, Border, Padding, Content", "is_correct": 1},
        {"option_text": "Width, Height, Margin, Padding", "is_correct": 0},
        {"option_text": "Content, Background, Border, Outline", "is_correct": 0},
        {"option_text": "Padding, Border, Background, Margin", "is_correct": 0}
      ]
    },
    {
      "question": "What is the correct syntax for a CSS comment?",
      "question_type_id": 1,
      "options": [
        {"option_text": "// This is a comment", "is_correct": 0},
        {"option_text": "/* This is a comment */", "is_correct": 1},
        {"option_text": "-- This is a comment ", "is_correct": 0},
        {"option_text": "# This is a comment", "is_correct": 0}
      ]
    },
    {
      "question": "What is the purpose of the `position: relative;` property?",
      "question_type_id": 1,
      "options": [
        {"option_text": "Takes the element out of the normal document flow.", "is_correct": 0},
        {"option_text": "Allows an element to be positioned relative to its normal position without affecting the layout of other elements.", "is_correct": 1},
        {"option_text": "Positions the element at the top-left corner of the viewport.", "is_correct": 0},
        {"option_text": "Allows an element to scroll independently.", "is_correct": 0}
      ]
    },
    {
      "question": "Which CSS property controls the stacking order of positioned elements?",
      "question_type_id": 1,
      "options": [
        {"option_text": "position", "is_correct": 0},
        {"option_text": "overflow", "is_correct": 0},
        {"option_text": "z-index", "is_correct": 1},
        {"option_text": "order", "is_correct": 0}
      ]
    },
    {
      "question": "Which CSS property is used to change the background color of an element?",
      "question_type_id": 1,
      "options": [
        {"option_text": "color", "is_correct": 0},
        {"option_text": "bgcolor", "is_correct": 0},
        {"option_text": "background-color", "is_correct": 1},
        {"option_text": "background", "is_correct": 0}
      ]
    },
    {
      "question": "Which CSS property is used to create space between the border and the content of an element?",
      "question_type_id": 1,
      "options": [
        {"option_text": "margin", "is_correct": 0},
        {"option_text": "border", "is_correct": 0},
        {"option_text": "padding", "is_correct": 1},
        {"option_text": "outline", "is_correct": 0}
      ]
    },
    {
      "question": "Which CSS property is used to make text bold?",
      "question_type_id": 1,
      "options": [
        {"option_text": "font-weight: bold;", "is_correct": 1},
        {"option_text": "text-weight: bold;", "is_correct": 0},
        {"option_text": "font-style: bold;", "is_correct": 0},
        {"option_text": "text-decoration: bold;", "is_correct": 0}
      ]
    },
    {
      "question": "Which CSS selector selects an element with a specific ID?",
      "question_type_id": 1,
      "options": [
        {"option_text": ".", "is_correct": 0},
        {"option_text": "#", "is_correct": 1},
        {"option_text": "*", "is_correct": 0},
        {"option_text": ":", "is_correct": 0}
      ]
    }
  ]
}

-->

<script>

</script>

<script>
  // Open route response
  const sampleObj = {
    "quiz_name": "jQuery Fundamentals Quiz",
    "description": "Test your knowledge of core jQuery concepts with 10 medium-difficulty multiple-choice questions.",
    "time_limit": 10,
    "score": 100,
    "questions": [{
        "question": "Which method is used to execute code when the DOM is fully loaded?",
        "question_type_id": 1,
        "options": [{
            "option_text": "$(document).ready()",
            "is_correct": 1
          },
          {
            "option_text": "window.onload()",
            "is_correct": 0
          },
          {
            "option_text": "document.addEventListener('DOMContent')",
            "is_correct": 0
          },
          {
            "option_text": "$.loadComplete()",
            "is_correct": 0
          }
        ]
      },
      {
        "question": "What does the jQuery selector $('div#header') target?",
        "question_type_id": 1,
        "options": [{
            "option_text": "All div elements with ID 'header'",
            "is_correct": 1
          },
          {
            "option_text": "The first div with class 'header'",
            "is_correct": 0
          },
          {
            "option_text": "All header elements inside divs",
            "is_correct": 0
          },
          {
            "option_text": "Only the body header section",
            "is_correct": 0
          }
        ]
      },
      {
        "question": "Which method would you use to get the text content of an element without HTML tags?",
        "question_type_id": 1,
        "options": [{
            "option_text": ".text()",
            "is_correct": 1
          },
          {
            "option_text": ".html()",
            "is_correct": 0
          },
          {
            "option_text": ".content()",
            "is_correct": 0
          },
          {
            "option_text": ".val()",
            "is_correct": 0
          }
        ]
      },
      {
        "question": "What does the .on() method primarily handle in jQuery?",
        "question_type_id": 1,
        "options": [{
            "option_text": "Event handling",
            "is_correct": 1
          },
          {
            "option_text": "AJAX requests",
            "is_correct": 0
          },
          {
            "option_text": "CSS animations",
            "is_correct": 0
          },
          {
            "option_text": "DOM traversal",
            "is_correct": 0
          }
        ]
      },
      {
        "question": "Which jQuery method is used to iterate over a collection of elements?",
        "question_type_id": 1,
        "options": [{
            "option_text": ".each()",
            "is_correct": 1
          },
          {
            "option_text": ".loop()",
            "is_correct": 0
          },
          {
            "option_text": ".iterate()",
            "is_correct": 0
          },
          {
            "option_text": ".forAll()",
            "is_correct": 0
          }
        ]
      },
      {
        "question": "How would you select all elements with class 'active' inside a <ul>?",
        "question_type_id": 1,
        "options": [{
            "option_text": "$('ul .active')",
            "is_correct": 1
          },
          {
            "option_text": "$('ul > .active')",
            "is_correct": 0
          },
          {
            "option_text": "$('.active ul')",
            "is_correct": 0
          },
          {
            "option_text": "$('ul.active')",
            "is_correct": 0
          }
        ]
      },
      {
        "question": "Which method adds a class to selected elements?",
        "question_type_id": 1,
        "options": [{
            "option_text": ".addClass()",
            "is_correct": 1
          },
          {
            "option_text": ".appendClass()",
            "is_correct": 0
          },
          {
            "option_text": ".toggleAttribute()",
            "is_correct": 0
          },
          {
            "option_text": ".setClass()",
            "is_correct": 0
          }
        ]
      },
      {
        "question": "What does $('p').hide(500) accomplish?",
        "question_type_id": 1,
        "options": [{
            "option_text": "Hides all paragraphs with a 500ms animation",
            "is_correct": 1
          },
          {
            "option_text": "Hides the first paragraph for 500 seconds",
            "is_correct": 0
          },
          {
            "option_text": "Hides paragraph with ID 500",
            "is_correct": 0
          },
          {
            "option_text": "Delays paragraph display by 500ms",
            "is_correct": 0
          }
        ]
      },
      {
        "question": "Which is the correct syntax for an AJAX GET request using jQuery?",
        "question_type_id": 1,
        "options": [{
            "option_text": "$.get(url, callback)",
            "is_correct": 1
          },
          {
            "option_text": "$.fetch(url).then(callback)",
            "is_correct": 0
          },
          {
            "option_text": "$.ajaxGet(url, callback)",
            "is_correct": 0
          },
          {
            "option_text": "$(document).get(url, callback)",
            "is_correct": 0
          }
        ]
      },
      {
        "question": "What does the .find() method do?",
        "question_type_id": 1,
        "options": [{
            "option_text": "Searches descendant elements of the selected elements",
            "is_correct": 1
          },
          {
            "option_text": "Locates elements in the entire document",
            "is_correct": 0
          },
          {
            "option_text": "Retrieves parent elements",
            "is_correct": 0
          },
          {
            "option_text": "Filters elements by visibility",
            "is_correct": 0
          }
        ]
      }
    ]
  }

    /* ************************************* */
    // Generation event
  $('.gen-btn').click(() => {
    console.log("button clicked");

    /* ************************************* */
    // Gets question info
    const topic = $('input[name="topic"]').val();
    // console.log(topic);
    const questionNumber = $('select[name="question-number"]').val();
    // console.log(questionNumber);
    let difficulty = $('input[name="difficulty"]');

    for (const [key, input] of Object.entries(difficulty)) {
      // console.log(input.checked);
      if (input.checked) {
        difficulty = input.value;
        break;
      };
    }
    // console.log(difficulty);

    /* ************************************* */
    // Checks if topic field is empty. if not makes a request


    if (topic === "") {
      $('.empty-topic').css('display', 'block');
    } else {

    

      // hides generation card
      $('.gen-card').css("display", 'none');

      //shows preview card
      $('.preview-card').css("display", 'block');

      $('.generated-qustions').html(`<span class="loader"></span>`);
      $('.empty-topic').css('display', 'none');
      $('.preview-header').css('display', 'none');
      $('.quiz-info').css('display', 'none');
      $.ajax({
        // url: "https://jsonplaceholder.typicode.com/posts",
        url: "api/ai-quiz-generator-api-deepseek.php",
        // url: "api/ai-quiz-generator-api-openrouter.php",
        // url: "api/ai-quiz-generator-api-gemini.php",
        method: "POST",
        dataType: "json",
        data: {
          'topic': topic,
          'question-number': questionNumber,
          'difficulty': difficulty
        },
        success: function(respone) {
          console.log(respone);
          // dummyPreview(respone);
          questionPreview(respone);
        },
        error: function(respone) {
          console.log(typeof respone);
        }
      })
    }

    // difficulty.forEach(element => {
    //   if(element.checked) console.log(element.value);
    // });

  })



  /* ************************************** */
  // function for successful request
  function dummyPreview(obj) {

    // select containers
    const generatedQuestions = $('.generated-qustions');

    // quiz title and info
    $(".quiz-title").text(obj.quiz_name);
    $(".quiz-desciption").text(obj.description);


    let counter = 0;

    let questionHTML = "This is a text";
    // console.log(typeof questions);
    // console.log(typeof obj.questions);
    // console.log(obj.questions);

    // loop all questions

    // Add the html in the container
    generatedQuestions.html(questionHTML);

    // display info and buttons
    $('.quiz-info').css("display", "block");
    $('.start-quiz-container').css("display", "block");
    $('.preview-header').css('display', 'flex');


    //set the json in the hidden input as value
    $(".json-holder").attr("value", JSON.stringify(obj));
  }

  function questionPreview(obj) {

    // select containers
    const generatedQuestions = $('.generated-qustions');

    // quiz title and info
    $(".quiz-title").text(obj.quiz_name);
    $(".quiz-desciption").text(obj.description);

    let counter = 0;

    let questionHTML = " ";
    // console.log(typeof questions);
    // console.log(typeof obj.questions);
    // console.log(obj.questions);

    // loop all questions
    for (const [key, question] of Object.entries(obj.questions)) {
      console.log(`${question.question}`);
      questionHTML += `

      <div class="question-block" id="qblock-${++counter}">
          <div class="q-label">Question ${counter}</div>
          <div class="q-text">${question.question}</div>
          <div class="q-options" data-question="1">`

      // loop options of each question
      for (const [key, option] of Object.entries(question.options)) {
        questionHTML += `

                <label class="q-option">
                <input type="radio" disabled>
                <span class="q-radio"></span>
                <span class="q-option-text">${option['option_text']}</span>
              </label>          
              `
      }
      questionHTML += `
        </div>
      </div>
    
      `
    }

    // Add the html in the container
    generatedQuestions.html(questionHTML);

    // display info and buttons
    $('.quiz-info').css("display", "block");
    $('.start-quiz-container').css("display", "block");
    $('.preview-header').css('display', 'flex');


    //set the json in the hidden input as value
    $(".json-holder").attr("value", JSON.stringify(obj));
  }
  // questionPreview(sampleObj);
</script>