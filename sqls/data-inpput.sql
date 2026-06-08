-- =============================================
-- HTML Basic Questions (Quiz ID = 1, Type ID = 1)
-- Manual IDs from 1 to 20
-- =============================================
INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("HTML Basic", 1, "This will cover questions from HTML Basic", "00:20:00", 20);

----------------------------------------
-- Quiz 1 (HTML Basic)

-- Insert 20 questions (quiz_id = 1, question_type_id = 1)
INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(1, 'What does HTML stand for?', 1, 1),
(2, 'Which HTML tag is used for the largest heading?', 1, 1),
(3, 'Which tag is used to create a hyperlink in HTML?', 1, 1),
(4, 'How do you insert an image in HTML?', 1, 1),
(5, 'Which tag creates a line break in HTML?', 1, 1),
(6, 'Which attribute specifies the URL for an <a> tag?', 1, 1),
(7, 'Which tag defines an unordered list?', 1, 1),
(8, 'Which tag defines a table row?', 1, 1),
(9, 'How do you write a comment in HTML?', 1, 1),
(10, 'Which tag is used for the footer of a document?', 1, 1),
(11, 'Which attribute provides alternative text for an image?', 1, 1),
(12, 'Which of the following is a block-level element?', 1, 1),
(13, 'Which tag defines the title of an HTML document?', 1, 1),
(14, 'How do you create a checkbox in HTML?', 1, 1),
(15, 'Which tag defines a dropdown list?', 1, 1),
(16, 'Which semantic element defines navigation links?', 1, 1),
(17, 'What does the <!DOCTYPE html> declaration do?', 1, 1),
(18, 'Which tag is used to embed an external stylesheet?', 1, 1),
(19, 'Which attribute is used to open a link in a new tab?', 1, 1),
(20, 'Which semantic element represents a standalone article?', 1, 1);


-- Insert options for each question (4 options per question, one correct per question)
INSERT INTO question_options (id, option_text, is_correct, question_id) VALUES
-- Question 1 options
(1, 'Hyper Text Markup Language', 1, 1),
(2, 'Home Tool Markup Language', 0, 1),
(3, 'Hyperlinks and Text Markup Language', 0, 1),
(4, 'Hyper Text Making Language', 0, 1),
-- Question 2 options
(5, 'h6', 0, 2),
(6, 'h1', 1, 2),
(7, 'heading', 0, 2),
(8, 'h3', 0, 2),
-- Question 3 options
(9, '<link>', 0, 3),
(10, '<a>', 1, 3),
(11, '<href>', 0, 3),
(12, '<hyper>', 0, 3),
-- Question 4 options
(13, '<img>', 1, 4),
(14, '<image>', 0, 4),
(15, '<src>', 0, 4),
(16, '<picture>', 0, 4),
-- Question 5 options
(17, '<break>', 0, 5),
(18, '<br>', 1, 5),
(19, '<newline>', 0, 5),
(20, '<hr>', 0, 5),
-- Question 6 options
(21, 'src', 0, 6),
(22, 'href', 1, 6),
(23, 'link', 0, 6),
(24, 'ref', 0, 6),
-- Question 7 options
(25, '<ol>', 0, 7),
(26, '<ul>', 1, 7),
(27, '<li>', 0, 7),
(28, '<list>', 0, 7),
-- Question 8 options
(29, '<td>', 0, 8),
(30, '<tr>', 1, 8),
(31, '<th>', 0, 8),
(32, '<row>', 0, 8),
-- Question 9 options
(33, '// comment', 0, 9),
(34, '/* comment */', 0, 9),
(35, '<!-- comment -->', 1, 9),
(36, '# comment', 0, 9),
-- Question 10 options
(37, '<footer>', 1, 10),
(38, '<foot>', 0, 10),
(39, '<bottom>', 0, 10),
(40, '<end>', 0, 10),
-- Question 11 options
(41, 'title', 0, 11),
(42, 'alt', 1, 11),
(43, 'src', 0, 11),
(44, 'aria-label', 0, 11),
-- Question 12 options
(45, '<span>', 0, 12),
(46, '<div>', 1, 12),
(47, '<a>', 0, 12),
(48, '<strong>', 0, 12),
-- Question 13 options
(49, '<title>', 1, 13),
(50, '<head>', 0, 13),
(51, '<h1>', 0, 13),
(52, '<meta>', 0, 13),
-- Question 14 options
(53, '<checkbox>', 0, 14),
(54, '<input type="checkbox">', 1, 14),
(55, '<input type="check">', 0, 14),
(56, '<check>', 0, 14),
-- Question 15 options
(57, '<select>', 1, 15),
(58, '<input type="dropdown">', 0, 15),
(59, '<list>', 0, 15),
(60, '<dl>', 0, 15),
-- Question 16 options
(61, '<nav>', 1, 16),
(62, '<navbar>', 0, 16),
(63, '<navigation>', 0, 16),
(64, '<menu>', 0, 16),
-- Question 17 options
(65, 'It specifies the HTML version (HTML5) for the browser.', 1, 17),
(66, 'It defines a style for the page.', 0, 17),
(67, 'It links to an external JavaScript file.', 0, 17),
(68, 'It declares the page as XML.', 0, 17),
-- Question 18 options
(69, '<style>', 0, 18),
(70, '<link>', 1, 18),
(71, '<script>', 0, 18),
(72, '<css>', 0, 18),
-- Question 19 options
(73, 'href="_new"', 0, 19),
(74, 'target="_blank"', 1, 19),
(75, 'rel="external"', 0, 19),
(76, 'target="_new"', 0, 19),
-- Question 20 options
(77, '<article>', 1, 20),
(78, '<section>', 0, 20),
(79, '<div>', 0, 20),
(80, '<main>', 0, 20);




-- =============================================
-- CSS Basic Questions (Quiz ID = 2, Type ID = 1)
-- Manual IDs from 21 to 40
-- =============================================

--Quiz
INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("CSS Basic", 2, "Learn Basics of CSS", "00:20:00", 20);


-- Insert questions with explicit IDs
INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(21, 'What does CSS stand for?', 2, 1),
(22, 'Which HTML attribute is used to define inline styles?', 2, 1),
(23, 'How do you select an element with id="header" in CSS?', 2, 1),
(24, 'Which CSS property is used to change the background color of an element?', 2, 1),
(25, 'Which CSS property controls the text size?', 2, 1),
(26, 'What is the correct CSS syntax to make all <p> elements have red text?', 2, 1),
(27, 'Which property is used to change the text color of an element?', 2, 1),
(28, 'Which CSS property sets the spacing between lines of text?', 2, 1),
(29, 'How do you make each word in a paragraph start with a capital letter?', 2, 1),
(30, 'What is the default value of the CSS position property?', 2, 1),
(31, 'Which CSS property controls the space between an element''s border and its content?', 2, 1),
(32, 'What does margin: 10px 5px; mean?', 2, 1),
(33, 'Which CSS property is used to change the font of an element?', 2, 1),
(34, 'How do you select all elements with class="example"?', 2, 1),
(35, 'Which CSS property is used to set an image as the background?', 2, 1),
(36, 'Which unit is relative to the font-size of the root element (<html>)?', 2, 1),
(37, 'Which CSS property makes a container a flexbox container?', 2, 1),
(38, 'What does the CSS property "display: none;" do?', 2, 1),
(39, 'Which CSS property is used to add rounded corners to an element?', 2, 1),
(40, 'Which selector has the highest specificity?', 2, 1);

-- Insert options for each question (question_id from 21 to 40)

-- Q21
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Creative Style Sheets', 0, 21),
('Computer Style Sheets', 0, 21),
('Cascading Style Sheets', 1, 21),
('Colorful Style Sheets', 0, 21);

-- Q22
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('class', 0, 22),
('style', 1, 22),
('css', 0, 22),
('inline', 0, 22);

-- Q23
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('.header', 0, 23),
('#header', 1, 23),
('header', 0, 23),
('*header', 0, 23);

-- Q24
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('color', 0, 24),
('bgcolor', 0, 24),
('background-color', 1, 24),
('background', 0, 24);

-- Q25
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('text-size', 0, 25),
('font-style', 0, 25),
('font-size', 1, 25),
('text-style', 0, 25);

-- Q26
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('p { text-color: red; }', 0, 26),
('p { color: red; }', 1, 26),
('p { font-color: red; }', 0, 26),
('<p style="color: red;">', 0, 26);

-- Q27
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('text-color', 0, 27),
('foreground', 0, 27),
('color', 1, 27),
('font-color', 0, 27);

-- Q28
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('line-spacing', 0, 28),
('line-height', 1, 28),
('letter-spacing', 0, 28),
('text-spacing', 0, 28);

-- Q29
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('text-transform: capitalize;', 1, 29),
('text-transform: uppercase;', 0, 29),
('font-variant: small-caps;', 0, 29),
('text-style: capitalize;', 0, 29);

-- Q30
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('relative', 0, 30),
('fixed', 0, 30),
('absolute', 0, 30),
('static', 1, 30);

-- Q31
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('margin', 0, 31),
('spacing', 0, 31),
('border-spacing', 0, 31),
('padding', 1, 31);

-- Q32
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('top margin 10px, bottom margin 5px', 0, 32),
('top and bottom margins 10px, left and right margins 5px', 1, 32),
('top margin 10px, left and right margins 5px, bottom margin auto', 0, 32),
('all margins 10px and 5px alternately', 0, 32);

-- Q33
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('font-family', 1, 33),
('font-style', 0, 33),
('font-weight', 0, 33),
('text-font', 0, 33);

-- Q34
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('.example', 1, 34),
('#example', 0, 34),
('*example', 0, 34),
('class=example', 0, 34);

-- Q35
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('background-color', 0, 35),
('background-image', 1, 35),
('bgimage', 0, 35),
('image-background', 0, 35);

-- Q36
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('px', 0, 36),
('em', 0, 36),
('rem', 1, 36),
('vh', 0, 36);

-- Q37
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('flex-container', 0, 37),
('display: flex;', 1, 37),
('display: block;', 0, 37),
('flex: true;', 0, 37);

-- Q38
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('The element becomes transparent', 0, 38),
('The element is hidden but still takes up space', 0, 38),
('The element is completely removed from the layout and not visible', 1, 38),
('The element is hidden but clickable', 0, 38);

-- Q39
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('border-radius', 1, 39),
('corner-radius', 0, 39),
('border-curve', 0, 39),
('edge-radius', 0, 39);

-- Q40
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Element selector', 0, 40),
('Class selector', 0, 40),
('ID selector', 1, 40),
('Universal selector', 0, 40);


-- =============================================
-- Bootstrap Basic Questions (Quiz ID = 3, Type ID = 1)
-- Manual IDs from 41 to 60
-- =============================================

INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("BootStrap Basic", 3, "Learn Basics of BootStrap", "00:20:00", 20);

-- Insert questions with explicit IDs
INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(41, 'What is Bootstrap?', 3, 1),
(42, 'Which class is used to create a responsive container that spans the full width?', 3, 1),
(43, 'What does the "col-sm-6" class mean in Bootstrap 5?', 3, 1),
(44, 'Which Bootstrap class is used to create a button?', 3, 1),
(45, 'How do you center content horizontally in Bootstrap?', 3, 1),
(46, 'Which class adds a zebra-striped effect to a table?', 3, 1),
(47, 'What is the default maximum width of a .container in Bootstrap?', 3, 1),
(48, 'Which class is used to create a navigation bar?', 3, 1),
(49, 'How do you make an image responsive in Bootstrap?', 3, 1),
(50, 'Which spacing utility adds margin on all sides (1.5rem by default)?', 3, 1),
(51, 'What does the "btn-primary" class do?', 3, 1),
(52, 'Which class is used to hide an element on mobile devices?', 3, 1),
(53, 'What is the purpose of the "row" class in Bootstrap?', 3, 1),
(54, 'Which component would you use to create a dropdown menu?', 3, 1),
(55, 'How do you align text to the center in Bootstrap?', 3, 1),
(56, 'Which class adds a hover effect to table rows?', 3, 1),
(57, 'What is the breakpoint for large screens (lg) in Bootstrap 5?', 3, 1),
(58, 'Which class creates a card component?', 3, 1),
(59, 'How do you create a responsive image that is rounded?', 3, 1),
(60, 'Which utility class is used to display an element as flexbox?', 3, 1);

-- Insert options for each question (question_id from 41 to 60)

-- Q41
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('A programming language', 0, 41),
('A CSS framework for responsive design', 1, 41),
('A JavaScript library', 0, 41),
('A database management system', 0, 41);

-- Q42
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('container', 0, 42),
('container-fluid', 1, 42),
('row', 0, 42),
('col', 0, 42);

-- Q43
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('A column that takes 6 out of 12 columns on small screens and above', 1, 43),
('A column with 6px padding', 0, 43),
('A small column of size 6', 0, 43),
('A column that is hidden on small screens', 0, 43);

-- Q44
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('button', 0, 44),
('.button', 0, 44),
('.btn', 1, 44),
('.btn-default', 0, 44);

-- Q45
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('text-align: center;', 0, 45),
('mx-auto', 1, 45),
('center-block', 0, 45),
('justify-content: center;', 0, 45);

-- Q46
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('table-bordered', 0, 46),
('table-hover', 0, 46),
('table-striped', 1, 46),
('table-condensed', 0, 46);

-- Q47
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('100%', 0, 47),
('1140px', 1, 47),
('960px', 0, 47),
('1320px', 0, 47);

-- Q48
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('nav', 0, 48),
('navbar', 1, 48),
('navigation', 0, 48),
('menu', 0, 48);

-- Q49
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('img-fluid', 1, 49),
('img-responsive', 0, 49),
('responsive-img', 0, 49),
('img-full', 0, 49);

-- Q50
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('m-0', 0, 50),
('p-3', 0, 50),
('m-4', 1, 50),
('mt-3', 0, 50);

-- Q51
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Makes the button transparent', 0, 51),
('Applies the primary theme color (usually blue) to the button', 1, 51),
('Makes the button large', 0, 51),
('Disables the button', 0, 51);

-- Q52
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('d-none', 1, 52),
('hidden', 0, 52),
('invisible', 0, 52),
('d-sm-none', 0, 52);  -- d-none hides on all devices, but for "on mobile" d-none works; alternative could be d-sm-none but question says "hide on mobile devices" - d-none hides always. Use d-none as simplest.

-- Q53
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Defines a container for columns in a grid', 1, 53),
('Creates a horizontal line', 0, 53),
('Adds background color', 0, 53),
('Creates a new section', 0, 53);

-- Q54
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('dropdown', 1, 54),
('select', 0, 54),
('menu', 0, 54),
('list-group', 0, 54);

-- Q55
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('text-align: center;', 0, 55),
('center', 0, 55),
('text-center', 1, 55),
('align-center', 0, 55);

-- Q56
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('table-striped', 0, 56),
('table-hover', 1, 56),
('table-active', 0, 56),
('table-bordered', 0, 56);

-- Q57
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('576px', 0, 57),
('768px', 0, 57),
('992px', 1, 57),
('1200px', 0, 57);

-- Q58
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('card', 1, 58),
('box', 0, 58),
('panel', 0, 58),
('widget', 0, 58);

-- Q59
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('img-rounded', 0, 59),
('img-circle', 0, 59),
('rounded img-fluid', 0, 59),
('img-fluid rounded', 1, 59);  -- correct order: class="img-fluid rounded"

-- Q60
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('flex', 0, 60),
('d-flex', 1, 60),
('display-flex', 0, 60),
('flexbox', 0, 60);


-- =============================================
-- JavaScript Basic Questions (Quiz ID = 4, Type ID = 1)
-- Manual IDs from 61 to 80
-- =============================================

INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("JavaScript Basic", 4, "Learn Basics of JavaScript", "00:20:00", 20);

-- Insert questions with explicit IDs
INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(61, 'What is JavaScript?', 4, 1),
(62, 'How do you write "Hello World" in an alert box?', 4, 1),
(63, 'Which symbol is used for single-line comments in JavaScript?', 4, 1),
(64, 'What does the "typeof" operator do?', 4, 1),
(65, 'How do you declare a variable in JavaScript?', 4, 1),
(66, 'Which method converts a JSON string into a JavaScript object?', 4, 1),
(67, 'What does "===" mean in JavaScript?', 4, 1),
(68, 'How do you create a function in JavaScript?', 4, 1),
(69, 'What is the correct way to write an array in JavaScript?', 4, 1),
(70, 'Which event occurs when a user clicks on an HTML element?', 4, 1),
(71, 'How do you get the length of an array?', 4, 1),
(72, 'What does "NaN" stand for?', 4, 1),
(73, 'Which built-in method adds an element to the end of an array?', 4, 1),
(74, 'What is the output of "5" + 3 in JavaScript?', 4, 1),
(75, 'How do you stop a form from submitting?', 4, 1),
(76, 'What does "DOM" stand for?', 4, 1),
(77, 'How do you select an element by its ID in JavaScript?', 4, 1),
(78, 'What is the purpose of "console.log()"?', 4, 1),
(79, 'Which keyword is used to declare a constant variable?', 4, 1),
(80, 'What is a closure in JavaScript?', 4, 1);

-- Insert options for each question (question_id from 61 to 80)

-- Q61
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('A styling language', 0, 61),
('A programming language for web interactivity', 1, 61),
('A database system', 0, 61),
('A markup language', 0, 61);

-- Q62
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('alert("Hello World");', 1, 62),
('msgBox("Hello World");', 0, 62),
('console.log("Hello World");', 0, 62),
('alertBox("Hello World");', 0, 62);

-- Q63
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('/*', 0, 63),
('//', 1, 63),
('<!--', 0, 63),
('#', 0, 63);

-- Q64
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Returns the data type of a variable', 1, 64),
('Checks if a variable is defined', 0, 64),
('Converts a variable to a string', 0, 64),
('Compares two variables', 0, 64);

-- Q65
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('v variableName', 0, 65),
('var, let, or const', 1, 65),
('declare variableName', 0, 65),
('variable variableName', 0, 65);

-- Q66
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('JSON.stringify()', 0, 66),
('JSON.parse()', 1, 66),
('JSON.convert()', 0, 66),
('JSON.toObject()', 0, 66);

-- Q67
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Assignment operator', 0, 67),
('Equality with type coercion', 0, 67),
('Strict equality (value and type)', 1, 67),
('Not equal', 0, 67);

-- Q68
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('function myFunction() {}', 1, 68),
('create myFunction() {}', 0, 68),
('def myFunction() {}', 0, 68),
('new function myFunction() {}', 0, 68);

-- Q69
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('var colors = "red", "green", "blue";', 0, 69),
('var colors = (1:"red", 2:"green", 3:"blue");', 0, 69),
('var colors = ["red", "green", "blue"];', 1, 69),
('var colors = red, green, blue;', 0, 69);

-- Q70
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('onmouseover', 0, 70),
('onclick', 1, 70),
('onchange', 0, 70),
('onload', 0, 70);

-- Q71
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('array.size', 0, 71),
('array.length', 1, 71),
('array.count', 0, 71),
('array.len', 0, 71);

-- Q72
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Not a Number', 1, 72),
('Null and None', 0, 72),
('No Action Needed', 0, 72),
('Negative Arithmetic Notation', 0, 72);

-- Q73
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('array.push()', 1, 73),
('array.pop()', 0, 73),
('array.shift()', 0, 73),
('array.unshift()', 0, 73);

-- Q74
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('8', 0, 74),
('53', 1, 74),
('"53"', 0, 74),
('NaN', 0, 74);

-- Q75
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('event.preventDefault()', 1, 75),
('event.stop()', 0, 75),
('return false;', 0, 75),  -- also works but preventDefault is standard
('event.cancel()', 0, 75);

-- Q76
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Document Object Model', 1, 76),
('Data Object Model', 0, 76),
('Document Oriented Model', 0, 76),
('Display Object Management', 0, 76);

-- Q77
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('document.querySelector(".myId")', 0, 77),
('document.getElementById("myId")', 1, 77),
('document.getElementByClass("myId")', 0, 77),
('$("#myId")', 0, 77);  -- jQuery, not pure JS

-- Q78
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Displays an alert box', 0, 78),
('Writes output to the browser console', 1, 78),
('Logs errors only', 0, 78),
('Prints to the screen', 0, 78);

-- Q79
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('var', 0, 79),
('let', 0, 79),
('const', 1, 79),
('constant', 0, 79);

-- Q80
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('A function that has access to its own scope and the outer function’s scope', 1, 80),
('A loop that runs forever', 0, 80),
('A way to declare private variables only', 0, 80),
('A built-in JavaScript object', 0, 80);





-- =============================================
-- HTML Intermediate Questions (Quiz ID = 5, Type ID = 1)
-- Manual IDs from 81 to 100
-- =============================================

INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("HTML Intermediate", 1, "Test your intermediate level of knowledge", "00:20:00", 20);

-- Insert questions with explicit IDs
INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(81, 'Which HTML element is used to define navigation links?', 5, 1),
(82, 'What does the "alt" attribute in an <img> tag provide?', 5, 1),
(83, 'Which HTML tag is used to create a dropdown list?', 5, 1),
(84, 'What is the purpose of the <meta> tag?', 5, 1),
(85, 'Which attribute specifies that an input field must be filled out?', 5, 1),
(86, 'How do you embed a video in HTML without using Flash?', 5, 1),
(87, 'What does the <article> element represent?', 5, 1),
(88, 'Which input type creates a slider control?', 5, 1),
(89, 'What is the difference between <div> and <span>?', 5, 1),
(90, 'Which HTML element is used to display a scalar measurement within a range?', 5, 1),
(91, 'What does the "target" attribute with "_blank" value do?', 5, 1),
(92, 'Which tag is used to define a client-side image map?', 5, 1),
(93, 'How can you make a list that lists its items with Roman numerals?', 5, 1),
(94, 'What is the purpose of the <fieldset> element?', 5, 1),
(95, 'Which HTML element defines the title of a document (shown in browser tab)?', 5, 1),
(96, 'What does the "autocomplete" attribute do in a form?', 5, 1),
(97, 'Which tag is used to define a table caption?', 5, 1),
(98, 'What is the correct way to link an external CSS file?', 5, 1),
(99, 'Which HTML5 feature allows you to draw graphics on the fly?', 5, 1),
(100, 'What does the "async" attribute do in a <script> tag?', 5, 1);

-- Insert options for each question (question_id from 81 to 100)

-- Q81
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<nav>', 1, 81),
('<header>', 0, 81),
('<menu>', 0, 81),
('<ul>', 0, 81);

-- Q82
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Alternative text if image cannot be displayed', 1, 82),
('Image alignment', 0, 82),
('Image border', 0, 82),
('Image tooltip', 0, 82);

-- Q83
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<input type="dropdown">', 0, 83),
('<select>', 1, 83),
('<list>', 0, 83),
('<dropdown>', 0, 83);

-- Q84
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Provides metadata about the HTML document', 1, 84),
('Creates a meta description visible on page', 0, 84),
('Links to external resources', 0, 84),
('Defines a meta search engine', 0, 84);

-- Q85
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('required', 1, 85),
('mandatory', 0, 85),
('validate', 0, 85),
('mustfill', 0, 85);

-- Q86
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<video>', 1, 86),
('<embed>', 0, 86),
('<media>', 0, 86),
('<movie>', 0, 86);

-- Q87
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('A standalone piece of content like a blog post', 1, 87),
('A sidebar', 0, 87),
('The main heading', 0, 87),
('A navigation menu', 0, 87);

-- Q88
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('range', 1, 88),
('slider', 0, 88),
('number', 0, 88),
('scale', 0, 88);

-- Q89
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<div> is block-level, <span> is inline', 1, 89),
('<div> is inline, <span> is block-level', 0, 89),
('No difference', 0, 89),
('<div> is for styling, <span> is for layout', 0, 89);

-- Q90
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<meter>', 1, 90),
('<progress>', 0, 90),
('<range>', 0, 90),
('<gauge>', 0, 90);

-- Q91
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Opens the link in a new tab or window', 1, 91),
('Opens the link in the same frame', 0, 91),
('Opens the link in the parent frame', 0, 91),
('Prevents opening the link', 0, 91);

-- Q92
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<map>', 1, 92),
('<imagemap>', 0, 92),
('<area>', 0, 92),
('<usemap>', 0, 92);

-- Q93
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<ol type="I">', 1, 93),
('<ol type="i">', 0, 93),  -- lowercase roman numerals, but question says Roman numerals (uppercase common)
('<ul type="roman">', 0, 93),
('<list style="roman">', 0, 93);
-- Note: both uppercase and lowercase are Roman, but typical answer is type="I"

-- Q94
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Groups related form elements', 1, 94),
('Creates a field for file upload', 0, 94),
('Defines a set of fields', 0, 94),
('Adds a border to form', 0, 94);

-- Q95
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<title>', 1, 95),
('<head>', 0, 95),
('<h1>', 0, 95),
('<caption>', 0, 95);

-- Q96
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Enables browser auto-fill suggestions', 1, 96),
('Automatically submits the form', 0, 96),
('Completes the form with default values', 0, 96),
('Validates the form automatically', 0, 96);

-- Q97
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<caption>', 1, 97),
('<thead>', 0, 97),
('<title>', 0, 97),
('<legend>', 0, 97);

-- Q98
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<link rel="stylesheet" href="style.css">', 1, 98),
('<style src="style.css">', 0, 98),
('<css src="style.css">', 0, 98),
('<stylesheet href="style.css">', 0, 98);

-- Q99
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<canvas>', 1, 99),
('<svg>', 0, 99),
('<graphics>', 0, 99),
('<draw>', 0, 99);

-- Q100
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Script is fetched asynchronously without blocking HTML parsing', 1, 100),
('Script executes immediately', 0, 100),
('Script is deferred until HTML is parsed', 0, 100),
('Script is cached', 0, 100);


-- =============================================
-- HTML Advanced Questions (Quiz ID = 6, Type ID = 1)
-- Manual IDs from 101 to 120
-- =============================================
INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("HTML Advance", 1, "Test your advance level knowledge of HTML", "00:20:00", 20);

-- Insert questions with explicit IDs
INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(101, 'What is the purpose of the "data-*" attribute in HTML5?', 6, 1),
(102, 'Which element is used to provide a caption for a <figure> element?', 6, 1),
(103, 'What does the "contenteditable" attribute do?', 6, 1),
(104, 'How can you make a custom dropdown without using <select>?', 6, 1),
(105, 'What is the correct way to use the <template> tag?', 6, 1),
(106, 'Which input type is used for selecting a date and time?', 6, 1),
(107, 'What is the purpose of the "sandbox" attribute in an <iframe>?', 6, 1),
(108, 'How do you specify that an <input> element should have spell checking enabled?', 6, 1),
(109, 'Which element is used to represent the main content of a document?', 6, 1),
(110, 'What is the difference between "defer" and "async" in <script>?', 6, 1),
(111, 'Which attribute allows you to validate an email input with a specific pattern?', 6, 1),
(112, 'What is the purpose of the <datalist> element?', 6, 1),
(113, 'How do you create a responsive iframe that maintains aspect ratio?', 6, 1),
(114, 'Which HTML element is used to display a dialog box or modal?', 6, 1),
(115, 'What does the "download" attribute in an <a> tag do?', 6, 1),
(116, 'How can you define a custom element in HTML?', 6, 1),
(117, 'What is the purpose of the "reversed" attribute in an <ol>?', 6, 1),
(118, 'Which element is used to define a sidebar or complementary content?', 6, 1),
(119, 'What is the correct way to embed a PDF in an HTML page?', 6, 1),
(120, 'How do you enable cross-origin resource sharing (CORS) for media elements?', 6, 1);

-- Insert options for each question (question_id from 101 to 120)

-- Q101
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('To store custom data private to the page or application', 1, 101),
('To define a data table', 0, 101),
('To create a database connection', 0, 101),
('To encrypt user data', 0, 101);

-- Q102
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<legend>', 0, 102),
('<figcaption>', 1, 102),
('<caption>', 0, 102),
('<summary>', 0, 102);

-- Q103
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Allows the user to edit the content of an element', 1, 103),
('Makes the content read-only', 0, 103),
('Automatically saves the content', 0, 103),
('Hides the content', 0, 103);

-- Q104
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Use a <div> with JavaScript to toggle a list', 1, 104),
('Use <input type="dropdown">', 0, 104),
('Use <option> outside <select>', 0, 104),
('Use <list> tag', 0, 104);

-- Q105
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Holds HTML fragments that are not rendered until used by JavaScript', 1, 105),
('Creates a template for email', 0, 105),
('Defines a reusable style', 0, 105),
('Preloads images', 0, 105);

-- Q106
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('datetime-local', 1, 106),
('date', 0, 106),
('time', 0, 106),
('datetime', 0, 106);

-- Q107
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Enables a set of extra restrictions on content in the iframe', 1, 107),
('Prevents the iframe from loading', 0, 107),
('Allows full access to parent page', 0, 107),
('Makes the iframe transparent', 0, 107);

-- Q108
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('spellcheck="true"', 1, 108),
('spell="on"', 0, 108),
('check-spelling="yes"', 0, 108),
('enable-spellcheck', 0, 108);

-- Q109
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<main>', 1, 109),
('<body>', 0, 109),
('<section>', 0, 109),
('<content>', 0, 109);

-- Q110
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('defer executes after HTML parsing, async executes as soon as downloaded', 1, 110),
('defer downloads script immediately, async waits', 0, 110),
('No difference', 0, 110),
('defer is for external scripts, async for inline', 0, 110);

-- Q111
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('pattern', 1, 111),
('validate', 0, 111),
('regex', 0, 111),
('format', 0, 111);

-- Q112
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Provides an autocomplete list for an <input>', 1, 112),
('Creates a dropdown menu', 0, 112),
('Defines a list of data items', 0, 112),
('Used for data binding', 0, 112);

-- Q113
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Wrap <iframe> in a <div> with padding-bottom and position relative', 1, 113),
('Use width="100%" only', 0, 113),
('Use CSS transform', 0, 113),
('Set viewport meta tag', 0, 113);

-- Q114
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<dialog>', 1, 114),
('<modal>', 0, 114),
('<popup>', 0, 114),
('<alert>', 0, 114);

-- Q115
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Tells the browser to download the linked resource instead of navigating', 1, 115),
('Opens the link in a new tab', 0, 115),
('Prevents the link from opening', 0, 115),
('Automatically saves the page as PDF', 0, 115);

-- Q116
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Using customElements.define() with JavaScript', 1, 116),
('Using <custom> tag', 0, 116),
('Using <element> tag', 0, 116),
('Using data-custom attribute', 0, 116);

-- Q117
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Numbers the list in descending order (e.g., 3,2,1)', 1, 117),
('Reverses the order of items visually', 0, 117),
('Applies a reverse color scheme', 0, 117),
('Flips the list horizontally', 0, 117);

-- Q118
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<aside>', 1, 118),
('<sidebar>', 0, 118),
('<nav>', 0, 118),
('<section>', 0, 118);

-- Q119
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('<embed src="file.pdf">', 0, 119),
('<object data="file.pdf">', 0, 119),
('<iframe src="file.pdf">', 0, 119),
('All of the above', 1, 119);  -- Multiple ways, but most correct is <object> or <embed>; however "All of the above" is typical advanced answer

-- Q120
INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('crossorigin attribute', 1, 120),
('cors="true"', 0, 120),
('allow-cors', 0, 120),
('origin="*"', 0, 120);




-- ============================================================
-- CSS Intermediate (Quiz ID = 7) – Questions 121 to 140
-- ============================================================

INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("CSS Intermediate", 2, "Test your intermediate level knowledge of CSS", "00:20:00", 20);


INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(121, 'Which CSS property is used to control the stacking order of elements?', 7, 1),
(122, 'What does "position: absolute" do relative to?', 7, 1),
(123, 'How do you select the first child of an element?', 7, 1),
(124, 'Which CSS function is used to create custom properties (variables)?', 7, 1),
(125, 'What does "box-sizing: border-box" do?', 7, 1),
(126, 'How can you center a block element horizontally?', 7, 1),
(127, 'Which media feature is used to detect if the device is in landscape mode?', 7, 1),
(128, 'What does "transition: all 0.3s ease" do?', 7, 1),
(129, 'Which pseudo-element is used to style the first line of a paragraph?', 7, 1),
(130, 'How do you create a CSS grid container?', 7, 1),
(131, 'What is the difference between "display: none" and "visibility: hidden"?', 7, 1),
(132, 'Which unit is relative to the viewport width?', 7, 1),
(133, 'What does "z-index" only work on?', 7, 1),
(134, 'How do you apply a style to all elements that are checked?', 7, 1),
(135, 'What does "animation-iteration-count: infinite" do?', 7, 1),
(136, 'Which property is used to set the space between grid items?', 7, 1),
(137, 'What is the difference between "nth-child" and "nth-of-type"?', 7, 1),
(138, 'How do you create a triangle with pure CSS?', 7, 1),
(139, 'What does "pointer-events: none" do?', 7, 1),
(140, 'Which property is used to write a multi-column layout?', 7, 1);

INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('z-index', 1, 121), ('stack-order', 0, 121), ('layer-index', 0, 121), ('order', 0, 121),
('Nearest positioned ancestor', 1, 122), ('Viewport', 0, 122), ('Parent element', 0, 122), ('Document body', 0, 122),
(':first-child', 1, 123), (':first-of-type', 0, 123), (':first', 0, 123), (':nth-child(1)', 0, 123),
('var()', 1, 124), ('custom()', 0, 124), ('set()', 0, 124), ('define()', 0, 124),
('Includes padding and border in the element’s total width/height', 1, 125), ('Only includes content', 0, 125), ('Adds border outside', 0, 125), ('Resets box model', 0, 125),
('margin: 0 auto;', 1, 126), ('text-align: center', 0, 126), ('align: center', 0, 126), ('position: center', 0, 126),
('orientation: landscape', 1, 127), ('device-orientation', 0, 127), ('screen: landscape', 0, 127), ('@media landscape', 0, 127),
('Applies a smooth transition to all properties over 0.3s with easing', 1, 128), ('Changes all colors', 0, 128), ('Makes all elements hidden', 0, 128), ('Sets timeout', 0, 128),
('::first-line', 1, 129), (':first-line', 0, 129), ('::first-letter', 0, 129), ('.first-line', 0, 129),
('display: grid', 1, 130), ('display: flex', 0, 130), ('grid: true', 0, 130), ('display: grid-container', 0, 130),
('none removes from layout, hidden hides but occupies space', 1, 131), ('Same effect', 0, 131), ('none hides, hidden removes', 0, 131), ('none is for flex', 0, 131),
('vw', 1, 132), ('vh', 0, 132), ('vmin', 0, 132), ('%', 0, 132),
('Positioned elements (relative, absolute, fixed, sticky)', 1, 133), ('All elements', 0, 133), ('Block elements only', 0, 133), ('Inline elements', 0, 133),
(':checked', 1, 134), (':selected', 0, 134), ('[checked]', 0, 134), ('.checked', 0, 134),
('Animation runs forever', 1, 135), ('Animation runs once', 0, 135), ('Stops animation', 0, 135), ('Repeats 2 times', 0, 135),
('gap', 1, 136), ('grid-gap', 0, 136), ('space', 0, 136), ('padding', 0, 136),
('nth-child counts all children, nth-of-type counts only same tag', 1, 137), ('Same', 0, 137), ('nth-child is faster', 0, 137), ('nth-of-type is deprecated', 0, 137),
('Using border-width and transparent borders', 1, 138), ('Using clip-path', 0, 138), ('Using shape-outside', 0, 138), ('Using SVG', 0, 138),
('Makes element ignore mouse events', 1, 139), ('Hides pointer cursor', 0, 139), ('Disables clicks but shows hand', 0, 139), ('Removes hover', 0, 139),
('column-count', 1, 140), ('columns', 0, 140), ('multi-column', 0, 140), ('grid-template-columns', 0, 140);

-- ============================================================
-- CSS Advanced (Quiz ID = 8) – Questions 141 to 160
-- ============================================================

INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("CSS Advance", 2, "Test your advance level knowledge of CSS", "00:20:00", 20);

INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(141, 'What is the difference between CSS Grid and Flexbox?', 8, 1),
(142, 'How do you create a keyframe animation?', 8, 1),
(143, 'What does "will-change" property do?', 8, 1),
(144, 'What is CSS specificity and how is it calculated?', 8, 1),
(145, 'How do you implement a responsive design without media queries?', 8, 1),
(146, 'What is the purpose of "contain" property?', 8, 1),
(147, 'What is a CSS preprocessor and name two examples?', 8, 1),
(148, 'How do you create a parallax scrolling effect?', 8, 1),
(149, 'What is the difference between "transform" and "translate"?', 8, 1),
(150, 'What is "cascade" in CSS?', 8, 1),
(151, 'How do you optimize CSS for performance?', 8, 1),
(152, 'What is "CSS Houdini"?', 8, 1),
(153, 'How do you create a sticky footer with CSS Grid?', 8, 1),
(154, 'What is the difference between "rem" and "em"?', 8, 1),
(155, 'How do you implement dark mode in CSS?', 8, 1),
(156, 'What is "isolation: isolate" used for?', 8, 1),
(157, 'How can you create a CSS-only tooltip?', 8, 1),
(158, 'What is the "currentColor" keyword?', 8, 1),
(159, 'What does "backface-visibility: hidden" do?', 8, 1),
(160, 'How do you debug CSS layout issues?', 8, 1);

INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Grid is 2D, Flexbox is 1D', 1, 141), ('Flexbox is 2D, Grid is 1D', 0, 141), ('Same', 0, 141), ('Grid is older', 0, 141),
('@keyframes name { from {} to {} }', 1, 142), ('@animation keyframes', 0, 142), ('keyframes {}', 0, 142), ('@keyframe name {}', 0, 142),
('Hints to browser about which properties will change to optimize performance', 1, 143), ('Forces property change', 0, 143), ('Deprecated', 0, 143), ('Prevents changes', 0, 143),
('Weight that determines which rule applies; calculated as inline > ID > class > element', 1, 144), ('Order of styles', 0, 144), ('Importance flag', 0, 144), ('Browser specific', 0, 144),
('Using flexbox or grid with auto-fill, minmax, and clamp()', 1, 145), ('Using JavaScript', 0, 145), ('Not possible', 0, 145), ('Using viewport meta only', 0, 145),
('Improves performance by isolating a subtree from the rest of the page', 1, 146), ('Contains an element', 0, 146), ('Container queries', 0, 146), ('Holds content', 0, 146),
('Sass, Less (or Stylus)', 1, 147), ('JavaScript, Python', 0, 147), ('jQuery, React', 0, 147), ('HTML, XML', 0, 147),
('Using background-attachment: fixed on background images', 1, 148), ('Using transform: translateZ', 0, 148), ('Using perspective', 0, 148), ('Using scroll-snap', 0, 148),
('transform is a property, translate() is a function of transform', 1, 149), ('Same', 0, 149), ('translate is a property', 0, 149), ('transform moves, translate rotates', 0, 149),
('The order of styles combining and overriding based on origin, importance, specificity', 1, 150), ('Waterfall effect', 0, 150), ('Animation', 0, 150), ('Grid system', 0, 150),
('Minify CSS, use fewer selectors, avoid @import, use CSS containment', 1, 151), ('Use more !important', 0, 151), ('Write all styles inline', 0, 151), ('Use only IDs', 0, 151),
('APIs that allow developers to extend CSS with JavaScript', 1, 152), ('A new framework', 0, 152), ('A CSS validator', 0, 152), ('A browser', 0, 152),
('Using grid with min-height: 100vh and footer in last row', 1, 153), ('Using position: fixed', 0, 153), ('Using margin-top: auto', 0, 153), ('Using flexbox only', 0, 153),
('rem is relative to root font-size, em relative to parent', 1, 154), ('Same', 0, 154), ('rem is for margins', 0, 154), ('em is absolute', 0, 154),
('Using prefers-color-scheme media query', 1, 155), ('Using dark class', 0, 155), ('Using JavaScript only', 0, 155), ('Using @media light', 0, 155),
('Creates a new stacking context', 1, 156), ('Isolates from JS', 0, 156), ('Prevents click events', 0, 156), ('Hides element', 0, 156),
('Using :hover on parent to show a pseudo-element', 1, 157), ('Using title attribute', 0, 157), ('Using JavaScript', 0, 157), ('Using <abbr>', 0, 157),
('Refers to the current value of color property', 1, 158), ('Current time', 0, 158), ('Current window', 0, 158), ('Current border', 0, 158),
('Hides the back face of a 3D transformed element', 1, 159), ('Makes element invisible', 0, 159), ('Hides front face', 0, 159), ('Applies blur', 0, 159),
('Use browser devtools, outline, or border', 1, 160), ('Guess', 0, 160), ('Restart browser', 0, 160), ('Delete CSS', 0, 160);

-- ============================================================
-- Bootstrap Intermediate (Quiz ID = 9) – IDs 161 to 180
-- ============================================================

INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("BootStrap Intermediate", 3, "Test your intermediate level knowledge of BootStrap", "00:20:00", 20);


INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(161, 'How do you create a responsive navigation bar that collapses?', 9, 1),
(162, 'What are Bootstrap cards and how do you use them?', 9, 1),
(163, 'How do you center a modal vertically in Bootstrap 5?', 9, 1),
(164, 'What is the purpose of "spinners" in Bootstrap?', 9, 1),
(165, 'How do you create a carousel/slider in Bootstrap?', 9, 1),
(166, 'What are Bootstrap tooltips and how are they initialized?', 9, 1),
(167, 'How do you create a scrollspy navigation?', 9, 1),
(168, 'What is the difference between "display: flex" and Bootstrap''s d-flex?', 9, 1),
(169, 'How do you create an offcanvas sidebar in Bootstrap 5?', 9, 1),
(170, 'What are Bootstrap badges?', 9, 1),
(171, 'How do you create a button group in Bootstrap?', 9, 1),
(172, 'What is the purpose of the "data-bs-*" attributes?', 9, 1),
(173, 'How do you create a toast notification in Bootstrap?', 9, 1),
(174, 'What is the difference between "col-*" and "col-*-*"?', 9, 1),
(175, 'How do you create a responsive table with horizontal scrolling?', 9, 1),
(176, 'What are Bootstrap list groups?', 9, 1),
(177, 'How do you create a floating label input in Bootstrap 5?', 9, 1),
(178, 'What is the purpose of "placeholders" in Bootstrap?', 9, 1),
(179, 'How do you customize Bootstrap using CSS variables?', 9, 1),
(180, 'What are Bootstrap breakpoints and their default values?', 9, 1);

INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Using navbar-expand-* class', 1, 161),
('Using collapse.js', 0, 161),
('Using flex-wrap', 0, 161),
('Using media queries', 0, 161),
('Flexible content containers with header, body, footer', 1, 162),
('Credit cards', 0, 162),
('Playing cards', 0, 162),
('Image cards', 0, 162),
('Add modal-dialog-centered class to modal-dialog', 1, 163),
('Use vertical-align', 0, 163),
('Use margin auto', 0, 163),
('Use position absolute', 0, 163),
('Indicate loading state', 1, 164),
('Spinning animation', 0, 164),
('Game spinner', 0, 164),
('Form spinner', 0, 164),
('Using carousel component with .carousel class', 1, 165),
('Using slider.js', 0, 165),
('Using cycle plugin', 0, 165),
('Using slideshow', 0, 165),
('Popups with text that appear on hover; initialized via JS', 1, 166),
('Tooltips are automatic', 0, 166),
('Only CSS', 0, 166),
('No initialization needed', 0, 166),
('Add data-bs-spy="scroll" to body and data-bs-target to nav', 1, 167),
('Use scroll.js', 0, 167),
('Use CSS only', 0, 167),
('Use jQuery', 0, 167),
('d-flex is Bootstrap''s utility for display: flex', 1, 168),
('Same', 0, 168),
('d-flex is faster', 0, 168),
('No difference', 0, 168),
('Use .offcanvas component with data-bs-toggle="offcanvas"', 1, 169),
('Use sidebar class', 0, 169),
('Use drawer class', 0, 169),
('Use slideout', 0, 169),
('Small inline counters and labels', 1, 170),
('Badges are buttons', 0, 170),
('Badges are icons', 0, 170),
('Badges are alerts', 0, 170),
('Wrap buttons in .btn-group', 1, 171),
('Use group class', 0, 171),
('Use button-group class on each button', 0, 171),
('Use flex', 0, 171),
('Custom attributes for Bootstrap JavaScript components', 1, 172),
('Data attributes for HTML5', 0, 172),
('For styling', 0, 172),
('For SEO', 0, 172),
('Use .toast component with .toast class and JS trigger', 1, 173),
('Use alert', 0, 173),
('Use notification', 0, 173),
('Use popup', 0, 173),
('col-* is equal width, col-*-* specifies number of columns', 1, 174),
('Same', 0, 174),
('col-* is for rows', 0, 174),
('col-*-* is deprecated', 0, 174),
('Wrap table in .table-responsive', 1, 175),
('Use overflow: auto', 0, 175),
('Use scroll table', 0, 175),
('Use width: 100%', 0, 175),
('Vertically stacked list items', 1, 176),
('Horizontal lists', 0, 176),
('Ordered lists', 0, 176),
('Unordered lists', 0, 176),
('Use .form-floating class on wrapper', 1, 177),
('Use floating attribute', 0, 177),
('Use placeholder="float"', 0, 177),
('Use label floating', 0, 177),
('Skeleton loading placeholders for content', 1, 178),
('Form placeholders', 0, 178),
('Image placeholders', 0, 178),
('Card placeholders', 0, 178),
('Override root CSS variables like --bs-primary', 1, 179),
('Edit bootstrap.css', 0, 179),
('Use !important', 0, 179),
('Use a different framework', 0, 179),
('sm:576px, md:768px, lg:992px, xl:1200px, xxl:1400px', 1, 180),
('480, 768, 1024, 1200', 0, 180),
('mobile, tablet, desktop', 0, 180),
('No breakpoints', 0, 180);

-- ============================================================
-- Bootstrap Advanced (Quiz ID = 10) – IDs 181 to 200
-- ============================================================

INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("BootStrap Advance", 3, "Test your advance level knowledge of BootStrap", "00:20:00", 20);

INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(181, 'How do you create a custom Bootstrap theme using SASS?', 10, 1),
(182, 'What are Bootstrap RTL (Right-to-Left) utilities?', 10, 1),
(183, 'How do you remove the default Bootstrap gutters in a grid?', 10, 1),
(184, 'What is the difference between Bootstrap 4 and 5?', 10, 1),
(185, 'How do you create a modal that does not close when clicking outside?', 10, 1),
(186, 'What are Bootstrap 5 utilities API?', 10, 1),
(187, 'How do you implement a dark theme in Bootstrap 5?', 10, 1),
(188, 'How do you change the Bootstrap primary color globally?', 10, 1),
(189, 'What is the purpose of "popper.js" in Bootstrap?', 10, 1),
(190, 'How do you create a multi-level dropdown in Bootstrap 5?', 10, 1),
(191, 'How do you enable Bootstrap components using pure JavaScript (no jQuery)?', 10, 1),
(192, 'What is the Bootstrap "margin" and "padding" spacer system?', 10, 1),
(193, 'How do you create a sticky navbar that becomes fixed after scrolling?', 10, 1),
(194, 'What is the "rem" unit used in Bootstrap 5 spacing?', 10, 1),
(195, 'How do you customize Bootstrap breakpoints?', 10, 1),
(196, 'What are Bootstrap "extend" classes?', 10, 1),
(197, 'How do you create a responsive sidebar layout with Bootstrap 5 grid?', 10, 1),
(198, 'What is the difference between "data-bs-dismiss" and "data-bs-toggle"?', 10, 1),
(199, 'How do you enable smooth scrolling for anchor links in Bootstrap?', 10, 1),
(200, 'How do you create a full-screen modal in Bootstrap 5?', 10, 1);

INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Import Bootstrap SCSS files and override variables before compiling', 1, 181),
('Edit CSS directly', 0, 181),
('Use theme roller', 0, 181),
('Use JavaScript', 0, 181),
('Support for languages written right-to-left', 1, 182),
('Responsive toggles', 0, 182),
('Rotation utilities', 0, 182),
('Reverse layout', 0, 182),
('Use class g-0 on row', 1, 183),
('Use no-gutters', 0, 183),
('Remove padding manually', 0, 183),
('Use m-0', 0, 183),
('Bootstrap 5 dropped jQuery, added RTL, new components', 1, 184),
('No difference', 0, 184),
('Bootstrap 5 is older', 0, 184),
('Bootstrap 4 has no grid', 0, 184),
('Set data-bs-backdrop="static" on modal button', 1, 185),
('Use backdrop: false', 0, 185),
('Use keyboard: false', 0, 185),
('Use close button', 0, 185),
('A way to generate utility classes programmatically', 1, 186),
('An API for components', 0, 186),
('A JavaScript API', 0, 186),
('A color system', 0, 186),
('Add data-bs-theme="dark" to body or use dark mode class', 1, 187),
('Use CSS filter', 0, 187),
('Use prefers-color-scheme', 0, 187),
('Use JavaScript toggle', 0, 187),
('Override $primary variable in SCSS', 1, 188),
('Use !important', 0, 188),
('Use CSS custom property', 0, 188),
('Use inline style', 0, 188),
('Handles positioning of tooltips and popovers', 1, 189),
('Animation library', 0, 189),
('Form validation', 0, 189),
('Carousel logic', 0, 189),
('Add nested dropdown inside a dropdown (requires custom CSS or JS)', 1, 190),
('Use .multi-dropdown', 0, 190),
('Bootstrap does not support', 0, 190),
('Use .sub-menu', 0, 190),
('Using Bootstrap''s native JavaScript module (bootstrap.bundle.js)', 1, 191),
('jQuery is required', 0, 191),
('No JavaScript needed', 0, 191),
('Use Angular', 0, 191),
('Responsive spacing classes: m-*, p-* with values 0-5 and auto', 1, 192),
('Only fixed margins', 0, 192),
('Only padding', 0, 192),
('No system', 0, 192),
('Use .sticky-top class', 1, 193),
('Use position: fixed', 0, 193),
('Use sticky navbar class', 0, 193),
('Use scroll event', 0, 193),
('Relative to root font-size (default 16px)', 1, 194),
('Relative to parent', 0, 194),
('Absolute', 0, 194),
('Viewport unit', 0, 194),
('Override $grid-breakpoints map in SCSS', 1, 195),
('Edit media queries', 0, 195),
('Use JavaScript', 0, 195),
('Not possible', 0, 195),
('Predefined classes that inherit styles from others', 1, 196),
('Extension of components', 0, 196),
('Plugin system', 0, 196),
('Utility classes', 0, 196),
('Use row and col with responsive classes like col-lg-3', 1, 197),
('Use offcanvas', 0, 197),
('Use flex column', 0, 197),
('Use position absolute', 0, 197),
('dismiss closes component, toggle toggles component', 1, 198),
('Same', 0, 198),
('dismiss is for alerts', 0, 198),
('toggle is for modals only', 0, 198),
('Add scroll-behavior: smooth to CSS or use JS', 1, 199),
('Use data-bs-smooth', 0, 199),
('Use smooth class', 0, 199),
('Not supported', 0, 199),
('Add modal-fullscreen class to modal-dialog', 1, 200),
('Use fullscreen: true', 0, 200),
('Use width: 100%', 0, 200),
('Use vh-100', 0, 200);

-- ============================================================
-- JavaScript Intermediate (Quiz ID = 11) – IDs 201 to 220
-- ============================================================

INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("JavaScipt Intermediate", 4, "Test your intermediate level knowledge of JavaScipt", "00:20:00", 20);


INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(201, 'What is the difference between let, const, and var?', 11, 1),
(202, 'What are arrow functions and how do they differ from regular functions?', 11, 1),
(203, 'What is template literals in ES6?', 11, 1),
(204, 'What is the spread operator (...) used for?', 11, 1),
(205, 'What is destructuring assignment?', 11, 1),
(206, 'What are promises in JavaScript?', 11, 1),
(207, 'What is async/await?', 11, 1),
(208, 'What is the difference between map() and forEach()?', 11, 1),
(209, 'What is the event loop in JavaScript?', 11, 1),
(210, 'What are closures?', 11, 1),
(211, 'What is the this keyword?', 11, 1),
(212, 'What is prototypal inheritance?', 11, 1),
(213, 'What are modules in JavaScript (ES6)?', 11, 1),
(214, 'What is the difference between == and ===?', 11, 1),
(215, 'What is the purpose of the fetch API?', 11, 1),
(216, 'What is localStorage?', 11, 1),
(217, 'What is debouncing in JavaScript?', 11, 1),
(218, 'What is the difference between null and undefined?', 11, 1),
(219, 'What is the "use strict" directive?', 11, 1),
(220, 'What is hoisting?', 11, 1);

INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('var is function-scoped, let/const are block-scoped; const cannot be reassigned', 1, 201),
('All same', 0, 201),
('let is global', 0, 201),
('const can be changed', 0, 201),
('Arrow functions have no own this, no arguments, cannot be constructors', 1, 202),
('Same', 0, 202),
('Arrow functions are slower', 0, 202),
('Arrow functions have their own this', 0, 202),
('String literals using backticks with embedded expressions', 1, 203),
('HTML templates', 0, 203),
('JSX', 0, 203),
('String concatenation', 0, 203),
('Expands arrays/objects into individual elements', 1, 204),
('Rest operator', 0, 204),
('Multiplication', 0, 204),
('Spreads function arguments', 0, 204),
('Extract values from arrays or objects into variables', 1, 205),
('Delete properties', 0, 205),
('Assign default values', 0, 205),
('Merge objects', 0, 205),
('Objects representing eventual completion/async operation', 1, 206),
('Callbacks only', 0, 206),
('Events', 0, 206),
('Functions', 0, 206),
('Syntactic sugar over promises, makes async code look synchronous', 1, 207),
('Old way', 0, 207),
('Replaces promises', 0, 207),
('Callback hell', 0, 207),
('map returns a new array, forEach does not', 1, 208),
('Same', 0, 208),
('map is faster', 0, 208),
('forEach returns array', 0, 208),
('Handles asynchronous callbacks, queues tasks', 1, 209),
('Game loop', 0, 209),
('Animation loop', 0, 209),
('Render loop', 0, 209),
('Function with access to its outer scope even after outer function returns', 1, 210),
('Loop variable', 0, 210),
('Global variable', 0, 210),
('Private variable', 0, 210),
('Refers to the object that is executing the current function', 1, 211),
('Current function', 0, 211),
('Global object', 0, 211),
('Parent object', 0, 211),
('Objects inherit properties from other objects via prototype chain', 1, 212),
('Class inheritance', 0, 212),
('No inheritance', 0, 212),
('Copy properties', 0, 212),
('Import/export syntax to split code into files', 1, 213),
('External libraries', 0, 213),
('Node.js only', 0, 213),
('HTML modules', 0, 213),
('=== checks value and type, == converts types', 1, 214),
('Same', 0, 214),
('== is stricter', 0, 214),
('No difference', 0, 214),
('Make HTTP requests and handle responses', 1, 215),
('Read files', 0, 215),
('Manipulate DOM', 0, 215),
('Store data', 0, 215),
('Store key-value pairs persistently in browser', 1, 216),
('Database', 0, 216),
('Session storage', 0, 216),
('Cookie', 0, 216),
('Limit rate of function calls', 1, 217),
('Remove debugs', 0, 217),
('Delay execution', 0, 217),
('Cancel event', 0, 217),
('undefined means not assigned, null is intentional absence', 1, 218),
('Same', 0, 218),
('null is undefined', 0, 218),
('undefined is an object', 0, 218),
('Enforces stricter parsing and error handling', 1, 219),
('Disables features', 0, 219),
('Old mode', 0, 219),
('Debug mode', 0, 219),
('Variable/function declarations moved to top of scope', 1, 220),
('Throws error', 0, 220),
('Not possible', 0, 220),
('Only functions', 0, 220);

-- ============================================================
-- JavaScript Advanced (Quiz ID = 12) – IDs 221 to 240
-- ============================================================

INSERT INTO quizzes (quiz_name, quiz_category_id, description, time_limit, score) VALUES ("JavaScipt Advance", 4, "Test your advance level knowledge of JavaScipt", "00:20:00", 20);

INSERT INTO questions (id, question, quiz_id, question_type_id) VALUES
(221, 'What is the prototype chain and how does it work?', 12, 1),
(222, 'What are generators in JavaScript?', 12, 1),
(223, 'What is the Proxy object?', 12, 1),
(224, 'What are Web Workers?', 12, 1),
(225, 'What is the difference between shallow copy and deep copy?', 12, 1),
(226, 'What is memoization?', 12, 1),
(227, 'What is the event delegation pattern?', 12, 1),
(228, 'What are symbols in JavaScript?', 12, 1),
(229, 'What is the difference between call, apply, and bind?', 12, 1),
(230, 'What is the "new" operator doing?', 12, 1),
(231, 'What are WeakMap and WeakSet?', 12, 1),
(232, 'What is currying in JavaScript?', 12, 1),
(233, 'What is the observer pattern?', 12, 1),
(234, 'How does the JavaScript engine handle memory management?', 12, 1),
(235, 'What are JavaScript iterators?', 12, 1),
(236, 'What is the difference between deep freeze and Object.freeze?', 12, 1),
(237, 'What is the "optional chaining" operator (?.)?', 12, 1),
(238, 'What are decorators in JavaScript (proposal)?', 12, 1),
(239, 'What is a Service Worker?', 12, 1),
(240, 'What is the "composite" pattern in JavaScript?', 12, 1);

INSERT INTO question_options (option_text, is_correct, question_id) VALUES
('Objects inherit from other objects; when property not found, lookup goes up the chain', 1, 221),
('Array chain', 0, 221),
('Function chain', 0, 221),
('Class chain', 0, 221),
('Functions that can be paused and resumed with yield', 1, 222),
('Async functions', 0, 222),
('Promises', 0, 222),
('Callbacks', 0, 222),
('Creates a wrapper to intercept operations on an object', 1, 223),
('Network proxy', 0, 223),
('Server proxy', 0, 223),
('Event proxy', 0, 223),
('Run JavaScript in background threads', 1, 224),
('UI threads', 0, 224),
('Main thread', 0, 224),
('Event loop', 0, 224),
('Shallow copies only top-level, deep copies all nested objects', 1, 225),
('Same', 0, 225),
('Shallow is slower', 0, 225),
('Deep copies references', 0, 225),
('Caching function results to improve performance', 1, 226),
('Memory leak', 0, 226),
('Function composition', 0, 226),
('Recursion', 0, 226),
('Using parent element to handle events on children', 1, 227),
('Event bubbling', 0, 227),
('Event capturing', 0, 227),
('Event listeners', 0, 227),
('Unique and immutable primitive values', 1, 228),
('Objects', 0, 228),
('Strings', 0, 228),
('Numbers', 0, 228),
('call/apply invoke immediately with given this and arguments; bind returns a new function', 1, 229),
('All same', 0, 229),
('bind is immediate', 0, 229),
('apply is for arrays only', 0, 229),
('Creates a new object, sets prototype, binds this, returns object', 1, 230),
('Calls function', 0, 230),
('Creates array', 0, 230),
('Declares variable', 0, 230),
('Collections with weak references (no prevention of GC)', 1, 231),
('Strong collections', 0, 231),
('Regular Map/Set', 0, 231),
('Arrays', 0, 231),
('Transforming a function with multiple args into sequence of functions with single args', 1, 232),
('Spicy function', 0, 232),
('Partial application', 0, 232),
('Higher-order function', 0, 232),
('One-to-many dependency where objects notify observers of changes', 1, 233),
('Singleton', 0, 233),
('Factory', 0, 233),
('Module', 0, 233),
('Automatic garbage collection using mark-and-sweep', 1, 234),
('Manual free', 0, 234),
('No management', 0, 234),
('Reference counting only', 0, 234),
('Objects that define a sequence and a next() method', 1, 235),
('Loops', 0, 235),
('Arrays', 0, 235),
('Functions', 0, 235),
('Object.freeze is shallow, deep freeze recursively freezes', 1, 236),
('Same', 0, 236),
('Deep freeze is built-in', 0, 236),
('Object.freeze is deep', 0, 236),
('Safely access nested properties without checking each level', 1, 237),
('Null check', 0, 237),
('Ternary operator', 0, 237),
('Logical OR', 0, 237),
('Experimental feature to modify class behavior declaratively', 1, 238),
('Production feature', 0, 238),
('Typescript only', 0, 238),
('React only', 0, 238),
('Script that runs in background for offline support and push notifications', 1, 239),
('Web worker', 0, 239),
('Main thread script', 0, 239),
('Event handler', 0, 239),
('Compose objects into tree structures to represent part-whole hierarchies', 1, 240),
('UI pattern', 0, 240),
('Data pattern', 0, 240),
('Singleton', 0, 240);

COMMIT;