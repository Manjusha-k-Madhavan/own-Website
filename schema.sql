-- ============================================================
-- Database Schema for Manjusha K Madhavan Personal Portfolio
-- ============================================================

CREATE DATABASE IF NOT EXISTS `manjusha_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `manjusha_db`;

-- 1. Users Table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(191) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('owner', 'visitor') NOT NULL DEFAULT 'visitor',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Diary Notes Table (Owner manages notes)
CREATE TABLE IF NOT EXISTS `notes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `content` TEXT NOT NULL,
    `note_date` DATE NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Thoughts of the Day Table (Visitors & Owner post, 24h lifespan, Owner can delete)
CREATE TABLE IF NOT EXISTS `thoughts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NULL,
    `name` VARCHAR(100) NOT NULL,
    `thought` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Special Dates Table (Owner manages special memories)
CREATE TABLE IF NOT EXISTS `special_dates` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `event_date` DATE NOT NULL,
    `memory` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Special Date Unlock & Chat Requests Table
-- Controls: 1) Date memory unlock permission, 2) Chat permission for that date
CREATE TABLE IF NOT EXISTS `date_unlock_requests` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `date_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `status` ENUM('pending', 'approved', 'declined') NOT NULL DEFAULT 'pending',
    `chat_status` ENUM('none', 'pending', 'approved', 'declined') NOT NULL DEFAULT 'none',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `uk_user_date` (`user_id`, `date_id`),
    FOREIGN KEY (`date_id`) REFERENCES `special_dates`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Date Chat Messages Table (Messages exchanged between visitor and owner for an approved date)
CREATE TABLE IF NOT EXISTS `date_chat_messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `request_id` INT NOT NULL,
    `sender_id` INT NOT NULL,
    `sender_name` VARCHAR(100) NOT NULL,
    `sender_role` ENUM('owner', 'visitor') NOT NULL,
    `message` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`request_id`) REFERENCES `date_unlock_requests`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`sender_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Private Moments Access Requests Table
CREATE TABLE IF NOT EXISTS `moment_requests` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `status` ENUM('pending', 'approved', 'declined') NOT NULL DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `uk_user_moment` (`user_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Moments Media Table (Photos & Videos: Public and Private)
CREATE TABLE IF NOT EXISTS `moments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `type` ENUM('photo', 'video') NOT NULL DEFAULT 'photo',
    `media_url` VARCHAR(500) NOT NULL,
    `title` VARCHAR(255) NULL,
    `is_private` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Default Seed Data
-- ============================================================

-- Default Owner: manjushakmadhavan@gmail.com / owner123
-- Password hash generated with password_hash('owner123', PASSWORD_BCRYPT)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`)
VALUES (1, 'Manjusha K Madhavan', 'manjushakmadhavan@gmail.com', '$2y$10$w42FjK7Lqj9Fqg15B2sYxezB.5n8k8e0b6M7tU5i4A2Z4P6v9z0s6', 'owner')
ON DUPLICATE KEY UPDATE `email`=`email`;

-- Default Notes
INSERT INTO `notes` (`id`, `content`, `note_date`) VALUES
(1, 'Quiet days are also growing days.', '2026-10-12'),
(2, 'Learn the steps, then forget them and dance.', '2026-10-20'),
(3, 'Small progress is still progress.', '2026-10-27')
ON DUPLICATE KEY UPDATE `id`=`id`;

-- Default Special Dates
INSERT INTO `special_dates` (`id`, `title`, `event_date`, `memory`) VALUES
(1, 'A small day that meant a lot', '2025-08-13', 'The day I started my M.Tech at Barton Hill. I walked in nervous and walked out a little braver.'),
(2, 'A quiet beginning', '2025-12-01', 'My first class as a freelance faculty. My hands shook a little, but the students smiled and it felt like home.'),
(3, 'Rain on the way home', '2026-06-18', 'We got caught in the rain, laughed the whole way and never remembered the reason we were late.')
ON DUPLICATE KEY UPDATE `id`=`id`;

-- Default Moments (Public)
INSERT INTO `moments` (`id`, `type`, `media_url`, `title`, `is_private`) VALUES
(1, 'photo', 'images/fly.jpg', 'Moment', 0),
(2, 'photo', 'images/moon.webp', 'Moon night', 0)
ON DUPLICATE KEY UPDATE `id`=`id`;
