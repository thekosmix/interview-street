# Product Requirements Document: Online Platform for Recruitment and Preparation (OPRP)

## 1. Overview

OPRP is a web-based platform designed to streamline the campus recruitment process for students, placement coordinators, and companies. It combines a job portal with an online coding platform to facilitate the entire lifecycle of recruitment, from application to technical assessment.

## 2. User Roles & Personas

*   **Student:** A student of the college who is seeking job or internship opportunities.
*   **Placement Coordinator (Admin):** A staff member of the college responsible for managing the placement process.
*   **Company/Recruiter:** A representative from a company looking to hire students.

## 3. Key Features

### 3.1. Job Portal (Résumé Manager)

*   **Student Profile:** Students can create and maintain a detailed profile with:
    *   Personal information
    *   Academic details (BE, ME, MBA)
    *   Projects and professional experience
    *   Resume upload and download
*   **Company Listings:** Placement coordinators can post job and internship opportunities, including:
    *   Company profile and requirements
    *   Job descriptions and eligibility criteria
    *   Application deadlines
*   **Application Process:**
    *   Students can view and apply to listed companies.
    *   Companies can view a list of applicants for their postings.
    *   Companies can shortlist candidates and import their resumes.
*   **Recruiter Management:** Placement coordinators can add, edit, and manage recruiter accounts.
*   **Student Management:** Placement coordinators can add, edit, and manage student accounts.

### 3.2. Online Compiler & Coding Platform

*   **Problem Administration:** Admins can post coding problems for students, including:
    *   Setting resource limits (e.g., execution time, memory).
    *   Uploading problem statements.
*   **Online IDE:** Students can write, compile, and run code in various languages (C, C++, Java, Python, etc.).
*   **Competitive Programming:**
    *   Students can solve public problems or company-specific challenges.
    *   Companies can create and host coding contests for hiring.
    *   A leaderboard/ranking system shows top performers.
*   **Code Analysis:** Companies can view the code submitted by students to assess their coding skills.

### 3.3. Communication & Collaboration

*   **Forum/Discussion Board:**
    *   Students can discuss company preparation strategies and share resources.
    *   Threads can be created for specific topics or companies.
*   **Calendar:**
    *   Displays a schedule of upcoming company visits and deadlines.
    *   Students can see which companies they are eligible for.
*   **Contact & Messaging:**
    *   Students can contact placement coordinators.
    *   A system for sending messages between users.

### 3.4. Mobile Application

*   An Android application (`ResumeManager.apk`) provides access to key features on the go, including:
    *   Viewing announcements
    *   User authentication
    *   Viewing recruiter details
    *   Sending messages

## 4. Non-Functional Requirements

*   **Security:** Secure user authentication and session management.
*   **Usability:** An intuitive and easy-to-use interface for all user roles.
*   **Performance:** The online compiler should be responsive and handle concurrent submissions efficiently.
