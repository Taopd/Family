CREATE TABLE users (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(128),
    `password` VARCHAR(128),
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    `deleted_at` DATETIME DEFAULT NULL
);
INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '2d8c3b62815cbec4d6190f75058f9636c5471fa1', NULL, NULL, NULL);