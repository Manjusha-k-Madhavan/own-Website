# Manjusha K Madhavan — Personal Portfolio Website (PHP + MySQL)

A complete, full-stack personal portfolio and memory portal built with **PHP 8**, **MySQL**, **Bootstrap 5**, and native asynchronous JavaScript. The frontend design, typography, dark celestial theme, and smooth transitions have been 100% preserved while hooking everything into a relational database with secure authentication and permission management.

---

## 🌟 Key Features Implemented

### 1. Full Authentication System (Owner vs. Visitors)
- **Owner Account**:
  - Email: `manjushakmadhavan@gmail.com`
  - Password: `owner123` (bcrypt-hashed in MySQL)
  - Role: `owner` (full administrative rights to add/edit/delete notes, delete any thought, approve special date requests, approve private moment viewings, and chat).
- **Visitor Accounts**:
  - Anyone can register with their name, email, and password.
  - PHP session-backed authentication (`session_start()`, secure password hashing via `password_hash()` and `password_verify()`).

### 2. Thoughts of the Day (24-Hour Expiry + Owner Deletion)
- Visitors and owner can post daily thoughts.
- Thoughts automatically expire after 24 hours.
- **Permission requirement fulfilled**: The owner (Manjusha) has full permission to delete any thought at any time with an instant `delete` action.

### 3. Special Dates Memory Unlock & Two-Step Chat
- **Step 1 (Memory Unlock)**: The date and title are public, but the personal memory is locked (`🔒 This memory is private. [Ask to unlock]`).
- When a visitor asks to unlock, the ask is sent to Manjusha as `pending`.
- Manjusha sees the visitor's request and can click **Allow** or **Not now**.
- **Step 2 (Chat Permission)**: Once the memory is unlocked, if the visitor wishes to discuss that date with Manjusha, they click **Ask to chat with me about this**.
- Manjusha receives the chat request and clicks **Open chat**.
- A live chat interface opens where Manjusha and the visitor can exchange messages saved in MySQL.

### 4. Moments (Public vs. Private Photos & Videos)
- **Public Moments**: Viewable by everyone.
- **Private Moments**: Fully locked for visitors (`🔒 Private moments need my approval. [Ask to view]`).
- A visitor requests permission; Manjusha approves via the **Allow** button in her dashboard.
- Once approved, the visitor gets full access to the private gallery.
- Manjusha can upload photos and videos directly from the UI or specify media URLs.

---

## 📁 Project Structure

```
WebTech PJT/
├── index.php             # Main website interface (preserves the exact original UI)
├── setup.php             # Web-based environment check & database installer
├── schema.sql            # Full MySQL database schema and seed data
├── config/
│   └── db.php            # PDO database connection, self-healing table setup, helpers
├── api/
│   ├── auth.php          # Login, Register, Session check, Logout
│   ├── notes.php         # Notes CRUD for owner
│   ├── thoughts.php      # Thoughts listing (24h), posting, owner deletion
│   ├── dates.php         # Special dates, unlock asks, chat asks, chat messages
│   └── moments.php       # Public & private moments, permission asks, file uploads
├── images/               # Profile picture, moon background, and photos
├── uploads/
│   └── moments/          # Uploaded photos and videos
└── README.md             # Project documentation
```

---

## 🚀 How to Run in VS Code with XAMPP

### Step 1: Start MySQL in XAMPP
1. Open the **XAMPP Control Panel**.
2. Click **Start** next to **MySQL** (and **Apache** if you wish to run through Apache).

### Step 2: Run the Website
You can run the site in either of two ways:

#### Option A: Quick Built-In PHP Server in VS Code Terminal
Open your VS Code terminal in this folder (`c:\Users\MANJUSHA K MADHAVAN\Desktop\WebTech PJT`) and run:
```powershell
C:\xampp\php\php.exe -S localhost:8000
```
Then open your browser at:
👉 **[http://localhost:8000](http://localhost:8000)**

#### Option B: Run via XAMPP Apache
1. Copy or move this folder `WebTech PJT` into `C:\xampp\htdocs\portfolio` (or create a symbolic link / virtual host).
2. Start **Apache** and **MySQL** in XAMPP Control Panel.
3. Open your browser at:
👉 **[http://localhost/portfolio](http://localhost/portfolio)**

---

## 🛠️ Automatic Database Initialization
You **do not** need to manually create the database or tables:
- When you first visit `index.php` or `setup.php`, `config/db.php` **automatically creates** the `manjusha_db` database, all 8 tables, and seeds the default owner account, sample notes, special dates, and moments!
- You can also visit `http://localhost:8000/setup.php` at any time to verify system health.

---

## 🔑 Login Credentials

| Role | Email | Password |
|---|---|---|
| **Owner (Manjusha)** | `manjushakmadhavan@gmail.com` | `owner123` |
| **Visitor** | Register your own account on the site or sign in! | Any password |
