# Matrimonial Website

A matrimonial web application built with plain PHP, MySQL and Bootstrap 5. Users can register, browse profiles of the opposite gender, view a profile and exchange private messages.

## Features
- User registration with validation (empty fields, password length, duplicate email)
- Profile photo upload with file type check
- Login and logout using sessions
- View and edit own profile, change password
- Browse profiles (a male user sees female profiles and the other way round)
- View a single profile
- Messaging: send a message, inbox, reply, delete a message, full conversation history between two users

## Tech Stack
- PHP (no framework), PDO for database access
- MySQL
- Bootstrap 5
- XAMPP for local development

## Security Practices Used
- Passwords stored as hashes (`password_hash`), never as plain text
- Prepared statements for all queries (protection from SQL injection)
- `htmlspecialchars` on user data shown on pages (protection from XSS)
- Pages that need login are protected with a session check
- Messages can be deleted only by the receiver, and the sender is always taken from the session, never from the form

## How to Run
1. Install and start XAMPP (Apache and MySQL).
2. Copy this project folder into `htdocs` (for example `/opt/lampp/htdocs/matrimonial2.0`).
3. Open phpMyAdmin and create a database named `matrimonial_data`.
4. Import the file `database.sql` into that database.
5. Check the database settings in `db.php` (host, user, password).
6. Open `http://localhost/matrimonial2.0/` in the browser.

## Not Done Yet
- Delete account
- Page for sent messages
- Common navigation bar on all pages
- Opposite-gender check when opening a profile directly by URL
- Search, filter and pagination

## Author
Gaurav, BCA final year student, Bikaner. This is my learning project. I am rebuilding it in Laravel next.