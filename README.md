# Event Management System

A simple PHP + MySQL event management system with admin and user roles.

## Features

- User registration and login (passwords hashed with `password_hash`)
- Admin panel to create and delete events
- Users can browse events and register for them
- Admin view of all registrations

## Requirements

- PHP 8.1+
- MySQL / MariaDB
- `mysqli` extension enabled

## Setup

1. Create the database and tables:

   ```bash
   mysql -u root -p < database/event_db.sql
   ```

   This also seeds a default admin account:
   - Email: `admin@example.com`
   - Password: `admin123`

   **Change this password immediately after your first login.**

2. Configure the database connection. By default `config.php` connects to
   `localhost` as `root` with no password, matching typical local XAMPP/MAMP
   setups. To use different credentials, set these environment variables
   instead of editing `config.php` directly:

   ```bash
   export DB_HOST=localhost
   export DB_USER=your_user
   export DB_PASS=your_password
   export DB_NAME=event_db
   ```

3. Serve the app with PHP's built-in server (or point Apache/Nginx at this
   folder):

   ```bash
   php -S localhost:8000
   ```

4. Visit `http://localhost:8000` — you'll be redirected to the login page.

## Project Structure

```
add_event.php          Admin: create a new event
admin_dashboard.php    Admin: list/delete events
config.php             Database connection
dashboard.php          User: browse and register for events
delete_event.php       Admin: delete an event
index.php              Entry point, redirects to dashboard or login
login.php              Login page
logout.php             Destroys the session
register.php           New user registration
register_event.php     Register the logged-in user for an event
view_registrations.php Admin: view all event registrations
assets/                CSS and images
database/              SQL schema
```

## Security notes

- All database queries use prepared statements.
- Output is escaped with `htmlspecialchars` to prevent XSS.
- Sessions are regenerated on login to prevent session fixation.
- `delete_event.php` and other admin actions currently rely on a simple
  session role check with no CSRF token — fine for a course project, but
  worth adding CSRF protection before any real-world deployment.
