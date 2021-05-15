--<!--
-----------------------------------------------------------------------------------------------

--                                    PHP CV GENERATOR
--
--    @author   PIYUSH KUMAR
--    @date     12 MARCH 2020
--    @purpose (pgSql) Database Setup  for CV_GEN Portal



-----------------------------------------------------------------------------------------------
-->

CREATE DATABASE cv_gen_piyush;

\c cv_gen_piyush

CREATE TABLE piyush_registered_users
(
    id SERIAL PRIMARY KEY NOT NULL,
    username varchar(30),
    userpassword varchar(30)
);

CREATE TABLE piyush_user_basic_information
(
    user_id INT REFERENCES piyush_registered_users(id),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email TEXT,
    mobile BIGINT,
    photo TEXT,
    address TEXT,
    city TEXT,
    country TEXT,
    objective TEXT
);

CREATE TABLE piyush_user_work_experience
(
    user_id INT REFERENCES piyush_registered_users(id),
    title TEXT,
    company TEXT,
    startmonth INT,
    endmonth INT,
    startyear INT,
    endyear INT,
    description TEXT
);

CREATE TABLE piyush_user_education
(
    user_id integer REFERENCES piyush_registered_users(id),
    degree TEXT,
    stream TEXT,
    college TEXT,
    startmonth INTEGER,
    endmonth INTEGER,
    startyear INTEGER,
    endyear INTEGER,
    grade TEXT
);

CREATE TABLE piyush_user_languages
(
    user_id integer REFERENCES piyush_registered_users(id),
    language VARCHAR(50),
    level VARCHAR(10)
);

CREATE TABLE piyush_user_skills
(
    user_id integer REFERENCES piyush_registered_users(id),
    skill TEXT,
    level VARCHAR(10)
)
