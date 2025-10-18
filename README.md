# 🎬 MyFilms

A personal movie playlist web app built with **Laravel 12**, powered by **Docker**, **Nginx**, and **MySQL**.  
This project lets me manage and rewatch my favorite films on my own website — while learning Docker as part of my tech stack.

---

## 🐳 Tech Stack

- **Laravel 12**
- **PHP 8.2 (FPM)**
- **Nginx**
- **MySQL 8.0**
- **Docker Compose**

---

## ⚙️ Project Setup

### 1. Clone the repository

```bash
git clone https://github.com/iemnothin/myfilms.git
cd myfilms
```

### 2. Directory structure

Make sure your structure looks like this:

```
myfilms/
├── docker-compose.yml
├── Dockerfile
├── nginx/
│   └── conf.d/
│       └── default.conf
└── src/
    ├── artisan
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    └── ...
```

---

## 🧱 Build and Run Containers

### 1. Build Docker images

```bash
docker-compose build
```

### 2. Start the containers

```bash
docker-compose up -d
```

### 3. Install Laravel dependencies

```bash
docker exec -it myfilms bash
composer install
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Run migrations

```bash
php artisan migrate
```

---

## 🌐 Access the App

After setup, open your browser and go to:

👉 [http://localhost:8000](http://localhost:8000)

If you see the **Laravel Welcome Page**, everything is working correctly.

---

## ⚡ Environment Configuration

Edit `.env` in `/src` folder:

```env
APP_NAME=MyFilms
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=myfilms
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

---

## 🧹 Common Commands

| Command                        | Description                            |
| ------------------------------ | -------------------------------------- |
| `docker-compose up -d`         | Start all containers                   |
| `docker-compose down`          | Stop and remove containers             |
| `docker exec -it myfilms bash` | Access Laravel container               |
| `php artisan migrate`          | Run database migrations                |
| `php artisan serve`            | (Alternative) Start Laravel dev server |
| `composer install`             | Install dependencies                   |
| `npm install && npm run dev`   | Compile frontend assets                |

---

## 🧰 Troubleshooting

### ❌ “could not find driver”

> PHP is missing the `pdo_mysql` extension.

➡️ Make sure your `Dockerfile` includes:

```dockerfile
RUN docker-php-ext-install pdo pdo_mysql
```

Then rebuild:

```bash
docker-compose down --volumes --remove-orphans
docker-compose up -d --build
```

### ❌ “Permission denied” on storage or bootstrap/cache

```bash
docker exec -it myfilms bash
chmod -R 777 storage bootstrap/cache
```

---

## 🪄 Future Improvements

- 🎞️ Add video player (Google Drive integration)
- 🧭 Movie category & playlist filters
- 👤 Authentication system
- 🌐 Frontend redesign with Tailwind or Vue.js

---

## 🧑‍💻 Author

**Abimanyu Okysaputra Rachman** ([@abiilaco\_](https://github.com/iemnothin))  
Building projects for fun, learning, and passion. 🚀
