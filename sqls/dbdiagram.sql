// Users table

 TABLE users {
    id INT [PRIMARY KEY, INCREMENT]
    name VARCHAR
    email VARCHAR
    password VARCHAR
    user_role INT
    user_picture_link VARCHAR
}

TABLE user_roles {
    id INT [PRIMARY KEY, INCREMENT]
    name VARCHAR
}



Ref: user_roles.id < users.user_role

// User quiz related tables


 TABLE user_quiz_attempts {
    id INT [PRIMARY KEY, INCREMENT]
    user_id INT
    quiz_id INT
    user_quiz_score INT
    attempt_at time
}

TABLE user_answers {
    id INT [PRIMARY KEY, INCREMENT]
    question_id INT
    selected_option_id INT
    user_attempt_id INT
}

Ref: user_quiz_attempts.quiz_id > quizzes.id
Ref: user_quiz_attempts.user_id > users.id
Ref: user_answers.user_attempt_id > user_quiz_attempts.id



// Question Related Tables
TABLE quiz_category {
    id INT [primary key, increment]
    name VARCHAR(100)
    parent_id INT [DEFAULT: 0]
    description text
}

TABLE quizzes {
    id integer [primary key, increment] 
    quiz_name VARCHAR(255)
    quiz_category_id INT
    description TEXT
    time_limit TIME
    score INT
}

TABLE question_types {
    id INT [primary key, increment]
    name VARCHAR(100)
}

TABLE questions {
    id INT [primary key, increment]
    question TEXT
    quiz_id INT
    question_type_id INT
}

TABLE question_options {
     id INT [primary key, increment]
     option_text TEXT
     is_correct TINYINT [DEFAULT: 0]
     question_id INT
}

Ref: quiz_category.id < quizzes.quiz_category_id
Ref: quiz_category.id < quiz_category.parent_id
Ref: question_types.id < questions.question_type_id
Ref: quizzes.id < questions.quiz_id 
Ref: questions.id < question_options.question_id








/*
Table follows {
  following_user_id integer
  followed_user_id integer
  created_at timestamp
}

 Table users {
  id integer [primary key]
  username varchar
  role varchar
  created_at timestamp
}

Table posts {
  id integer [primary key]
  title varchar
  body text [note: 'Content of the post']
  user_id integer [not null]
  status varchar
  created_at timestamp
}

Ref user_posts: posts.user_id > users.id // many-to-one

Ref: users.id < follows.following_user_id

Ref: users.id < follows.followed_user_id

Records users(id, username, role) {
  0, 'Alice', 'admin'
  1, 'Bob', 'moderator'
  2, 'Candice', 'moderator'
  3, 'David', 'member'
}

Records follows(following_user_id, followed_user_id, created_at) {
  1, 0, '2026-01-01'
  3, 2, '2026-02-28'
}

Records posts(id, title, user_id) {
  0, 'Welcome to the forum!', 0
  1, 'Guidelines', 1
  2, 'Hello all!', 3
} */
