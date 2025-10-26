# Employee Management System

A comprehensive web-based employee management system built with PHP, MySQL, and Bootstrap. This system allows administrators to manage employees, handle leave applications, and maintain organizational records.

## Features

- **Admin Panel**: Complete administrative control over the system
- **Employee Management**: Add, edit, and manage employee records
- **Leave Management**: Apply for leave, approve/reject applications, and track leave status
- **User Authentication**: Secure login system for both admins and employees
- **Responsive Design**: Mobile-friendly interface using Bootstrap
- **Department Management**: Organize employees by departments
- **Contact System**: Internal communication features

## Login Credentials

### Super Admin Access
- **Username**: `superadmin`
- **Password**: `11111111`

### Department Change & Role Management

When changing an employee's department or role, use the following credentials:

#### For New Admin (Promoted Employee)
- **New Password**: `NEXGEN@123`

#### For Demoted Admin (Now Employee)
- **New Password**: `NEXGEN@123`

## Installation

1. **Prerequisites**
   - XAMPP/WAMP/LAMP server
   - PHP 7.4 or higher
   - MySQL 5.7 or higher
   - Web browser

2. **Setup Steps**
   ```bash
   # Clone or download the project
   # Place the project folder in your web server directory (htdocs for XAMPP)
   
   # Import the database
   # Open phpMyAdmin and import the _empadmin.sql file
   
   # Configure database connection
   # Update config.php with your database credentials
   ```

3. **Database Configuration**
   - Import `_empadmin.sql` into your MySQL database
   - Update database connection settings in `config.php`

## Project Structure

```
Project/
├── assets/
│   ├── fonts/           # Poppins font files
│   └── fontawesome/     # FontAwesome icons
├── css/
│   ├── nav1.css         # Navigation styling
│   ├── boot.css         # Bootstrap customizations
│   └── *.css           # Other stylesheets
├── js/
│   ├── script.js        # Main JavaScript
│   └── *.js            # Other JavaScript files
├── config.php           # Database configuration
├── nav.php             # Navigation component
├── index2.php          # Main dashboard
├── adminSignin.php     # Admin login page
├── empSignin.php       # Employee login page
├── registration.php    # Employee registration
├── applyLeave.php      # Leave management
├── employe.php         # Employee listing
└── _empadmin.sql       # Database schema
```

## Usage

1. **Access the System**
   - Open your web browser
   - Navigate to `http://localhost/Project/index2.php`

2. **Admin Login**
   - Click "Admin Login"
   - Use superadmin credentials to access full administrative features

3. **Employee Login**
   - Click "Employee Login"
   - Use employee credentials to access employee features

4. **Managing Users**
   - Admins can register new employees
   - Change employee departments
   - Promote employees to admin roles
   - Demote admins to employee roles

## Security Notes

- Change default passwords after initial setup
- Use strong passwords for production environments
- Regularly update the system and dependencies
- Implement proper backup procedures

## Technologies Used

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 5
- **Icons**: FontAwesome
- **Fonts**: Poppins

## Support

For technical support or questions about the system, please contact the development team.

---

**Note**: This system is designed for internal organizational use. Ensure proper security measures are in place before deploying to production.
