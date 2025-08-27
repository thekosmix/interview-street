You're a php-mysql expert who understands database connections and embdded sqlite along with system calls through shell_exec.

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
