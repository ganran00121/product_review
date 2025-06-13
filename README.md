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
```
---

## 🧩 ** ออกแบบฐานข้อมูล Database Schema **
![alt text](image.png)

### 🔸 ตาราง `users`

| Field       | Type            | Description               |
| ----------- | --------------- | ------------------------- |
| id          | bigint (PK)     | รหัสผู้ใช้                |
| name        | string          | ชื่อผู้ใช้                |
| email       | string (unique) | อีเมล                     |
| password    | string          | รหัสผ่าน (bcrypt)         |
| role\_id    | foreignId       | FK → role\_managements.id |
| created\_at | timestamp       | วันที่สร้าง               |
| updated\_at | timestamp       | วันที่อัปเดต              |

---

### 🔸 ตาราง `role_managements`

| Field | Type        | Description               |
| ----- | ----------- | ------------------------- |
| id    | bigint (PK) | รหัสบทบาท                 |
| name  | string      | ชื่อบทบาท (admin, member) |

---

### 🔸 ตาราง `products`

| Field       | Type            | Description      |
| ----------- | --------------- | ---------------- |
| id          | bigint (PK)     | รหัสสินค้า       |
| name        | string          | ชื่อสินค้า       |
| description | text (nullable) | รายละเอียดสินค้า |
| price       | decimal(8,2)    | ราคาสินค้า       |
| created\_at | timestamp       | วันที่สร้าง      |
| updated\_at | timestamp       | วันที่อัปเดต     |

---

### 🔸 ตาราง `reviews`

| Field       | Type         | Description       |
| ----------- | ------------ | ----------------- |
| id          | bigint (PK)  | รหัสรีวิว         |
| user\_id    | foreignId    | FK → users.id     |
| product\_id | foreignId    | FK → products.id  |
| content     | text         | เนื้อหารีวิว      |
| rating      | decimal(2,1) | คะแนน (1.0 - 5.0) |
| created\_at | timestamp    | วันที่สร้าง       |
| updated\_at | timestamp    | วันที่อัปเดต      |

---

## 🧪 Mock API Endpoints 