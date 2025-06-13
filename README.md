# Laravel + JWT + Docker Starter Project

โปรเจกต์นี้ใช้ Laravel + JWT สำหรับระบบยืนยันตัวตน และรันด้วย Docker เพื่อความสะดวกในการพัฒนา

## 🚀 วิธีใช้งาน

ทำตามขั้นตอนนี้เรียงลำดับเป๊ะ ๆ:

```bash
# คัดลอกไฟล์ .env จากไฟล์ตัวอย่าง
cp .env.example .env

# สร้าง JWT secret สำหรับการเข้ารหัส token
php artisan jwt:secret

# ติดตั้ง dependencies ของ PHP ด้วย Composer
composer install

# เปิด Docker แล้ว Build และรัน Docker containers ทั้งหมดใน background
docker-compose up -d --build

# รีเซ็ตฐานข้อมูลและ seed ข้อมูลตัวอย่าง
php artisan migrate:fresh --seed
