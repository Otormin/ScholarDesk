
---

# 🎓 ScholarDesk

**A streamlined, user-friendly university management system focused on academic success.**

ScholarDesk is a web application built to simplify the often complex and confusing experience of traditional university portals. While many institutional systems are bloated with administrative features like hostel selection and fee payments, ScholarDesk strips away the noise to focus on what matters most in the classroom: **Course Management, Grading, and Attendance.**

## 📸 Screenshots
![Login page](screenshots/gpaCalculator1.png)
![Homepage](screenshots/gpaCalculator2.png)
![Courses page](screenshots/gpaCalculator3.png)
![Student Profile Page](screenshots/gpaCalculator3.png)
![List of students enrolled under a course](screenshots/gpaCalculator3.png)
![Student details page](screenshots/gpaCalculator3.png)

## 📖 The Problem & Solution

* **The Problem:** Existing university management systems are often cluttered, difficult to navigate, and overwhelming for new students and staff.
* **The Solution:** ScholarDesk provides a clean, intuitive interface that separates academic management from administrative overhead. It empowers students to easily enroll in courses and teachers to manage their classrooms without the learning curve.

## ✨ Key Features by Role

### 👨‍💼 Admin

* **Department Control:** Add and edit university departments.
* **Course Management:** Create new courses and delete obsolete ones.
* **User Oversight:** Manage teachers assigned to courses and remove students from courses if necessary.
* **Grade Override:** Capability to update grades for administrative corrections.

### 👩‍🏫 Teacher

* **Course Selection:** Flexibility to browse and select specific courses they wish to teach.
* **Classroom Management:** View a list of all enrolled students.
* **Academic Records:** Enter and manage student grades.
* **Attendance:** Track student attendance for active courses.
* **Profile:** Manage personal details and credentials.

### 👨‍🎓 Student

* **Easy Access:** Login securely using a unique **Matriculation Number** and password.
* **Self-Service:** Browse available courses and enroll instantly.
* **Dashboard:** View all registered courses and track progress.
* **Profile:** Edit personal information.

## 🛠️ Tech Stack

* **Backend:** PHP (Native)
* **Frontend:** HTML5, CSS3, JavaScript (Responsive)
* **Database:** MySQL (Managed via phpMyAdmin)

## 🚀 Installation & Setup

To run ScholarDesk locally on your machine:

1. **Set up a Local Server:**
Install tools like **XAMPP**, **WAMP**, or **MAMP** to handle PHP and MySQL.
2. **Clone the Repository:**
Navigate to your server's root directory (e.g., `htdocs` in XAMPP).
```bash
cd htdocs
git clone https://github.com/Otormin/ScholarDesk.git

```


3. **Database Configuration:**
* Open **phpMyAdmin** in your browser (`localhost/phpmyadmin`).
* Create a new database named `scholardesk`.
* Import the SQL file located in the root folder of this repo (e.g., `database.sql`).
* *Optional:* Check the PHP connection file (usually `db.php` or `connect.php`) to ensure the credentials match (User: `root`, Password: `     `).


4. **Run the App:**
Open your browser and navigate to: `http://localhost/ScholarDesk`

## 📂 Project Structure

```text
├── admin/              # Admin dashboard and logic
├── teacher/            # Teacher dashboard and logic
├── student/            # Student dashboard and logic
├── css/                # Stylesheets
├── js/                 # JavaScript files
├── includes/           # DB connection and reusable components
├── uploads/            # Profile pictures or documents
├── index.php           # Landing/Login page
├── database.sql        # Database import file
└── README.md           # Documentation

```