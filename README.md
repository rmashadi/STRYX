# STRYX

**S**ystem for **T**hreat **R**esponse & **Y**ber Assessment Management

Threat Response &amp; Yber Assessment — Security Operations Platform.

---

## Tech Stack

- **Framework:** CodeIgniter 3
- **Theme:** STRYX Dark — custom security engineer aesthetic
- **PHP:** 7.x+
- **Database:** MySQL/MariaDB
- **Icons:** Font Awesome 5

## Setup

### Requirements

- PHP 7.x or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) with `mod_rewrite`

### Installation

1. Clone repository:
   ```bash
   git clone git@github.com:rmashadi/STRYX.git
   ```

2. Create database and import schema

3. Configure database connection in `application/config/database.php`:
   ```php
   $db['default'] = array(
       'dsn'       => '',
       'hostname'  => 'localhost',
       'username'  => 'root',
       'password'  => '',         // your database password
       'database'  => 'stryx_db', // your database name
       'dbdriver'  => 'mysqli',
       // ...
   );
   ```

4. Set base URL in `application/config/config.php`:
   ```php
   $config['base_url'] = 'http://localhost/stryx';
   ```

5. Ensure `uploads/` directory is writable

6. Access via browser and login

---

STRYX &mdash; Threat Response &amp; Cyber Assessment
