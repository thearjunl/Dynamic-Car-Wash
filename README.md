
# Dynamic Car Wash Management System

[![GitHub Repository](https://img.shields.io/badge/GitHub-Dynamic--Car--Wash-blue?style=flat-square&logo=github)](https://github.com/thearjunl/Dynamic-Car-Wash)

A comprehensive web-based car wash booking and management system built with PHP, MySQL, and modern web technologies. This application provides a complete solution for managing car wash services, bookings, payments, and administrative tasks.

## 🔗 Repository
**GitHub**: [https://github.com/thearjunl/Dynamic-Car-Wash](https://github.com/thearjunl/Dynamic-Car-Wash)

## 🚗 Features

### Customer Features
- **User Registration & Authentication** - Secure signup and login system
- **Service Booking** - Book car wash services with date/time selection
- **Multiple Wash Plans** - Choose from Normal, Standard, and Dynamic wash packages
- **Washing Point Selection** - Select from available car wash locations
- **Online Payment Integration** - Secure payment processing with Razorpay
- **Booking Management** - View and track booking status
- **Password Recovery** - Forgot password functionality with OTP verification

### Admin Features
- **Admin Dashboard** - Comprehensive overview of business metrics
- **Booking Management** - View, update, and manage all customer bookings
- **Washing Point Management** - Add, edit, and manage car wash locations
- **Staff Management** - Manage staff accounts and permissions
- **Customer Enquiries** - Handle customer queries and feedback
- **Booking Status Updates** - Update booking status (New, In Progress, Completed)

### Technical Features
- **Responsive Design** - Mobile-friendly interface
- **Email Notifications** - PHPMailer integration for email services
- **Real-time Validation** - Form validation and date/time checks
- **Secure Database** - PDO-based database interactions
- **Session Management** - Secure user session handling

## 🛠️ Technology Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap
- **Payment Gateway**: Razorpay
- **Email Service**: PHPMailer
- **Additional Libraries**: 
  - SweetAlert for notifications
  - jQuery for enhanced interactivity
  - Font Awesome for icons

## 📋 Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (for dependency management)
- Modern web browser

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/thearjunl/Dynamic-Car-Wash.git
   cd Dynamic-Car-Wash
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Database Setup**
   - Create a MySQL database named `dynamic`
   - Import the database schema (SQL file should be provided)
   - Update database credentials in configuration files:
     - `dynamic-carwash/inc/config.php`
     - `dynamic-carwash/db_connect.php`

4. **Configure Database Connection**
   ```php
   // Update these files with your database credentials
   $dbHost = 'localhost';
   $dbUser = 'your_username';
   $dbPassword = 'your_password';
   $dbName = 'dynamic';
   ```

5. **Configure Payment Gateway**
   - Set up Razorpay account and get API keys
   - Update payment configuration in relevant files

6. **Configure Email Settings**
   - Update PHPMailer settings for email notifications
   - Configure SMTP settings for password recovery

7. **Set Permissions**
   ```bash
   chmod -R 755 dynamic-carwash/
   chmod -R 777 dynamic-carwash/uploads/ # if upload directory exists
   ```

## 📁 Project Structure

```
carwash1/
├── dynamic-carwash/           # Main application directory
│   ├── assets/               # CSS, JS, images, and other static files
│   ├── css/                  # Additional stylesheets
│   ├── js/                   # JavaScript files
│   ├── images/               # Image assets
│   ├── inc/                  # Include files
│   │   ├── config.php        # Database configuration
│   │   ├── header.php        # Common header
│   │   └── footer.php        # Common footer
│   ├── includes/             # Additional include files
│   ├── fonts/                # Font files
│   ├── Doc/                  # Documentation files
│   ├── index.html            # Homepage
│   ├── login.php             # User login
│   ├── signup.php            # User registration
│   ├── dashboard.php         # Admin dashboard
│   ├── washing-plans.php     # Service booking page
│   ├── payment.php           # Payment processing
│   ├── add-booking.php       # Booking management
│   ├── managecar-washingpoints.php  # Washing point management
│   └── ...                   # Other PHP files
├── vendor/                   # Composer dependencies
├── composer.json             # Composer configuration
└── README.md                # This file
```

## 🔧 Configuration

### Database Tables
The system uses several key database tables:
- `login` - User authentication
- `signup` - User registration details
- `tblcarwashbooking` - Booking information
- `tblwashingpoints` - Car wash locations
- `staff` - Staff management

### Default Admin Access
- Create an admin user in the `login` table with `user_type = 'admin'`
- Access admin panel at `/dashboard.php`

## 🎯 Usage

### For Customers
1. Visit the homepage (`index.html`)
2. Register for a new account or login
3. Browse available washing plans
4. Select a washing point and preferred date/time
5. Complete booking and payment
6. Receive booking confirmation

### For Administrators
1. Login with admin credentials
2. Access the dashboard to view metrics
3. Manage bookings, washing points, and staff
4. Update booking statuses
5. Handle customer enquiries

## 🔒 Security Features

- Password hashing and secure authentication
- SQL injection prevention with PDO prepared statements
- Session management and CSRF protection
- Input validation and sanitization
- Secure payment processing

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 📞 Support

For support and questions:
- Create an issue in the repository
- Contact the development team

## 🔄 Version History

- **v1.0.0** - Initial release with core functionality
- Features include booking system, payment integration, and admin panel

---

**Note**: Make sure to update all configuration files with your specific settings before deploying to production.
