# ใช้ Apache + PHP 8.1 จาก DockerHub
FROM php:8.1-apache

# คัดลอกไฟล์ทั้งหมดในโปรเจกต์ไปยังโฟลเดอร์เว็บ
COPY . /var/www/html/

# เปิดพอร์ต 80 สำหรับเว็บ
EXPOSE 80
