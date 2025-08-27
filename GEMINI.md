You're a php-mysql expert who understands database connections and embdded sqlite along with system calls through shell_exec. On every run/invocation, read all .md files to understand the project structure and features to have more context rather than reading the entire folder.

## Project Overview: interview-street/oprp

This project is a PHP-based web application that serves as a job portal and online compiler for a college. It is designed to be used by students, placement coordinators (admins), and recruiters.

### Key Directories:

*   `/oprp`: The main application directory.
    *   `/_php`: Contains the core PHP logic, including database connections, session management, and feature-specific functions.
    *   `/student`: The student-facing part of the application, where they can manage their profile, apply for jobs, and use the online compiler.
    *   `/recruiter`: The recruiter-facing part of the application, where they can view applicants and manage job postings.
    *   `/rm_admin`: The admin panel for placement coordinators to manage students, recruiters, and job postings.
    *   `/online_compiler`: The online compiler, with support for multiple languages.
    *   `/mobile_app`: A mobile application for Android.

*   `/`: The main directory.
    * `PRD.md`: Contains the feature the apps has.
    * `GEMINI.md`: Contains instructions for gemini-cli.
    * `README.md`: Contains the description/about the project.
    * `setup.md`: Contains the instruction for setting up the project locally and running it.
    * `oprp.sql`: The initial MySQL database file to start the database for admin login.
    * `oprp.sqlite`: The initial SQLite database file to start the embedded databse for admin login.
    * `/oprp`: The main application directory.
    * `/screen_shots`: Have few screenshots of the project while running locally. 

