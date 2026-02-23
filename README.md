# EasyColoc – Web Platform for Shared Housing Management

EasyColoc is a **web application for managing shared housing (colocations)**.  
It allows tracking shared expenses, automatically calculating debts, and keeping a clear overview of **“who owes what to whom”**.  

---

## Table of Contents

- [Features](#features)  
- [Actors & Roles](#actors--roles)  
- [Technologies](#technologies)  
- [Architecture](#architecture)  
- [Installation](#installation)  
- [Usage](#usage)  
- [Database & Migrations](#database--migrations)  
- [Security & Validation](#security--validation)  
- [Future Enhancements](#future-enhancements)  
- [License](#license)  

---

## Features

### User Management
- User registration and login  
- Profile management  
- Automatic promotion of first registered user as **Global Admin**  
- User blocking for banned accounts  

### Colocation Management
- Create, update, and cancel colocations  
- Invite members via email/token  
- Only **one active colocation per user**  
- Members can leave; owners can remove members  

### Expense Management
- Add expenses (title, amount, category, payer, date)  
- Expense history and monthly/category statistics  
- Filter expenses by month  

### Balances & Debts
- Automatic calculation of total paid, individual share, and balance  
- Simplified “who owes whom” view  
- Simple payments (“Mark as Paid”)  

### Reputation System
- Leaving or canceling with debt → -1 point  
- Leaving or canceling without debt → +1 point  
- Owner removing member with debt → debt transferred to owner  

---

## Actors & Roles

| Role | Description |
|------|-------------|
| **Member** | Standard user. Can add expenses, view balance, mark payments, leave colocation. |
| **Owner** | Creator of a colocation. Can invite/remove members, manage categories, cancel colocation. |
| **Global Admin** | Platform-wide admin. Can view all statistics, ban/unban users, can also be Owner/Member. |

---

## Technologies

- **Backend**: PHP 8.x + Laravel (MVC)  
- **Frontend**: Blade templates + Tailwind CSS  
- **Database**: MySQL / PostgreSQL (via migrations)  
- **ORM**: Eloquent (relations: `hasMany`, `belongsToMany`)  
- **Authentication**: Laravel Breeze / Jetstream  
- **Version Control**: Git / GitHub  

---

## Architecture

- **MVC (Model-View-Controller)** structure  
- Business logic separated from controllers and views  
- Responsive UI for desktop, tablet, and mobile  
- Secure forms using CSRF tokens and server-side validation  
- Protection against XSS with Blade escaping (`{{ }}`)  

---

## Installation

1. Clone the repository:  
```bash
git clone https://github.com/elgmouriabderrahim/easyColoc.git
```
2. Navigate to the project folder:
```bash
cd easyColoc
```

3. Copy .env.example to .env and configure your database:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Run migrations and seeders:
```bash
php artisan migrate --seed
```


# Usage

- Register a user (first user automatically becomes Global Admin)
- Create a colocation (Owner)
- Invite members via email/token
- Add and manage expenses
- Track balances and payments
- Monitor reputation scores for each user

## Database & Migrations

**Tables:** users, colocations, memberships, expenses, categories, payments, reputation

**Relationships:**
- User ↔ Colocation (hasMany / belongsToMany)
- Colocation ↔ Expense (hasMany)
- Expense ↔ User (payer)
- Membership ↔ User & Colocation (pivot table)

## Security & Validation

- CSRF protection with @csrf
- XSS protection via Blade escaping {{ }}
- Server-side validation using Form Requests or validate()
- Client-side validation with HTML5 (required, type, pattern)
- Role-based authorization (Admin, Owner, Member)