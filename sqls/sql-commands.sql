-- ------------------------------------
-- User Related Tables

-- Users table

CREATE TABLE users {
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR,
    email VARCHAR,
    password VARCHAR,
    user_role INT
};

CREATE TABLE roles {
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR
}


-- ------------------------------------
-- Quiz related Tables

-- Quiz category

CREATE TABLE quiz_category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
);


-- Quizzes table
CREATE TABLE quizzes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    quiz_name VARCHAR(255), 
    quiz_category_id INT,
    description TEXT,
    time_limit TIME,
    socre INT
);


-- Questions
CREATE TABLE questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question TEXT,
    quiz_id INT,
    question_type INT
)

-- Qusetion types (e.g. mcq, true-false, checkbox etc)

CREATE TABLE qustion_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question TEXT,
    quiz_id INT,
    question_type INT
)

CREATE TABLE question_options {
     id INT PRIMARY KEY AUTO_INCREMENT,
     option_text TEXT,
     is_correct TINYINT DEFAULT 0,
     quiz_id INT
}

-- ------------------------------------
-- User quiz related tables

-- user attempts
CREATE TABLE user_quiz_attempts {
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    quiz_id INT,
    user_quiz_score INT,
    attempt_at time
}

--user answers 

CREATE TABLE user_answers {
    id INT PRIMARY KEY AUTO_INCREMENT,
    question_id INT,
    user_id INT,
    selected_option_id INT
}




