# Remote Team HRMS System

The Remote Team HRMS (Human Resource Management System) is a comprehensive system designed to help your organization efficiently manage attendance, project-wise working logs, leave requests, and holiday management for remote teams. This README file provides an overview of the system, installation instructions, and usage guidelines to help your team get started.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
  - [1. Attendance and Timer](#1-attendance-and-timer)
  - [2. Project-wise Working Logs](#2-project-wise-working-logs)
  - [3. Leave Management](#3-leave-management)
  - [4. Holiday Management](#4-holiday-management)
- [Contributing](#contributing)
- [License](#license)

## Prerequisites

Before installing and using the Remote Team HRMS System, ensure that you have the following prerequisites:

- Web server (e.g., Apache or Nginx)
- PHP 7.4 or higher
- MySQL or another compatible database system
- Composer (for PHP dependencies)

## Installation

Follow these steps to install the Remote Team HRMS System:

1. Clone the repository to your server:

   ```bash
   git clone https://github.com/bansaritech/hrms.git
   ```

2. Navigate to the project directory:

   ```bash
   cd remote-team-hrms
   ```

3. Install PHP dependencies using Composer:

   ```bash
   composer install
   ```

4. Create a database for the application and configure the database connection in the `.env` file.

5. Run database migrations to create the necessary tables:

   ```bash
   php artisan migrate --seed
   ```

6. Generate application encryption key:

   ```bash
   php artisan key:generate
   ```

7. Start the development server:

   ```bash
   php artisan serve
   ```

8. Access the application in your web browser at `http://localhost:8000`.

## Usage

### 1. Attendance and Timer

- Employees can check in and check out using the attendance feature.
- The real-time timer tracks active work hours during the workday.

### 2. Project-wise Working Logs

- Employees can log their work activities by project.
- Track hours spent on each project.

### 3. Leave Management

- Employees can submit leave requests with dates and reasons.
- HR and team leads can approve or reject leave requests.

### 4. Holiday Management

- Maintain a list of company-wide holidays.
- Holidays are automatically considered in attendance and leave calculations.
- Easily add, edit, or remove holidays.

## Contributing

We welcome contributions from the community. If you would like to contribute to the development of the Remote Team HRMS System, please follow our [contribution guidelines](CONTRIBUTING.md).

## License

This project is licensed under the [MIT License](LICENSE). You are free to use, modify, and distribute this software as per the terms of the license.
