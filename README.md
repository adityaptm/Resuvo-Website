# Resuvo - Professional CV Builder (Kinobi Style)

Resuvo is a modern, web-based CV builder application built with **Laravel**. It features a multi-step form design inspired by platforms like Kinobi, offering a premium user experience and ATS-compliant output.

## 🚀 Features

- **Kinobi-Inspired UI**: A clean, structured, and professional multi-step builder.
- **Live Preview**: Real-time CV pratinjau on the left side as you type.
- **ATS-Compliant Template**: Uses a Harvard-style template that is highly readable by Applicant Tracking Systems.
- **Dynamic Photo Upload**: Easily upload and preview your profile photo.
- **Automatic Formatting**: 
    - Intelligent date selectors (Month/Year).
    - Automatic bullet points for experience and organization descriptions.
    - GPA formatting and location fields.
- **Dynamic Categories**: Add multiple skills, achievements, or projects with specific categories.
- **Responsive Design**: Works seamlessly on desktop and mobile devices.
- **Simulated Payment Flow**: Integrated demonstration of a payment-gated download feature.

## 🛠️ Tech Stack

- **Backend**: Laravel 10+
- **Frontend**: Blade Templates, Vanilla CSS, JavaScript (ES6)
- **Database**: SQLite / MySQL
- **Icons**: FontAwesome 6

## 📦 Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/adityaptm/Resuvo-Website.git
   cd resuvo-app
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration**:
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

5. **Run the application**:
   ```bash
   php artisan serve
   ```

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---
Developed with ❤️ by [Aditya Pratama Putra](https://github.com/adityaptm)
