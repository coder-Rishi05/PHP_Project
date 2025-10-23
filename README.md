# 🧾 Personal Expense Tracker (PHP + MySQL)

📁 Project Overview

The Personal Expense Tracker is a web-based PHP project designed to help users record, categorize, and manage daily expenses. It uses a MySQL database for storing data and PHP for backend logic, along with HTML/CSS for the user interface.

## Project structure

```pgsql

expense-tracker/                ← project root folder
│
├── public/                     ← public web-accessible files
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   ├── images/
│   │   └── logo.png
│   ├── index.php               ← home page
│   └── logout.php
│
├── app/
│   ├── config/
│   │   └── config.php          ← database connection, constants
│   ├── functions/
│   │   └── general.php         ← user-defined functions (utility)
│   └── models/
│       └── Expense.php         ← expense-related data operations
│
├── templates/                  ← reusable UI fragments
│   ├── header.php
│   └── footer.php
│
├── uploads/                    ← for any file uploads (receipts etc)
│
└── README.md                   ← project description/documentation

```

🔧 How the Project Will Work

1. Users can add expenses with details like title, amount, category, and date.

2. The data is stored in a MySQL database via PHP scripts.

3. A dashboard/home page will show total expenses and summaries.

4. A view page will list all entries with edit/delete options.

5. Eventually, the project can include user login and data visualization.

### Features

1. User registration & login

2. Session-based authentication & logout1.

3. Add, View, Edit, Delete Expenses (CRUD)

4. Dashboard showing total expenses & last 5 entries

5. “Remember Me” cookie

6. Export expenses as CSV
