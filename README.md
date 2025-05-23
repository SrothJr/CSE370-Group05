# Student Help Desk

## Introduction

The **Student Help Desk** is a user-friendly web platform designed to improve student and academic administration communication. It helps students to easily submit and track complaints and allows the university to handle them in an organized and efficient manner. Furthermore, it keeps a vault of relevant academic resources corresponding to the needs of academic coursework. The system also includes key features like writing course reviews and providing an FAQ section, all aimed at making students’ academic experience better. The platform is built using **HTML** and **CSS** for the front-end, and **PHP** and **MySQL** for the back-end, ensuring smooth interaction between users and the system. The database structure is designed using an Enhanced Entity-Relationship (EER) diagram, which maps out how students, complaints, reviews, and administrators are all connected, making it easier to manage and expand the system in the future. With its focus on _simplicity, accessibility, and organization_, the system ensures that student concerns are heard and resolved quickly, while also being scalable enough to adapt to future needs.

## Project Features

The key features of the Student Help Desk include:

### User Module

- Two main types of users: Students(users) and Admins.

- Each user has attributes like ID, name, email, password, phone, and account creation timestamp.
  Admin status is tracked using a `boolean` flag.

### Complaint Submission

- Students can submit complaints containing a title, description, category, and status.
- Complaints are linked to the user who posted them and are timestamped.
  The voting feature allows students(users) to upvote or downvote certain complaints, adding relevance priority.

### Admin Panel

- Admins can view, update, and track the status of complaints.
- Admins can also delete complaints for indecency, irrelevancy, or any other reason.

### Course Review System

- Students can submit reviews for specific courses, which include the course code, title, and a 5 scale rating.
- Review description can contain, but is not limited to, guidance for other students, constructive criticism, and feedback for coordinators.

### Resource Collection

- Students collect various learning resources like books, lectures, and videos associated with different courses.
- Admins can provide, update, or delete resources.
- Students can directly request that resources be added to the authority.

### FAQs

- Admins manage a frequently asked questions (FAQs) section where common student queries and answers are stored.
- Users can view the page and acquire information, and admin access unlocks easy insertion of Questions and Answers to the database.

### Voting System

- Students can vote on complaints, indicating how many others face the same issue, helping prioritize resolution.

## Back-end Structure

### EER Diagram

![EER Diagram](https://github.com/user-attachments/assets/106c8aa0-2244-4a53-833b-c3566405fd80)

### Schema Diagram

![Schema Diagram](https://github.com/user-attachments/assets/602fa4b7-ff94-404f-9f2e-48ea22e1b48a)

### How to source this Project?

1. Clone the project using [https://github.com/SrothJr/CSE370-Group05.git](https://github.com/SrothJr/CSE370-Group05.git) into your XAMPP/htdocs folder.
2. Launch XAMPP, start Apache and MySQL Module.
3. Create a database named "group5" in your MySQL Data server.
4. Locate the group5.sql file in your repository and import it into the created database.
5. On a different tab of your browser, goto to `localhost/CSE370-Group05/login.php` to get started!
