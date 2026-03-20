<?php
// DB bilgileri (.env ile aynı)
$host = '127.0.0.1';
$db   = 'blog';
$user = 'blog';
$pass = ''; // .env ile aynı
$charset = 'utf8mb4';

// Eklemek istediğin admin bilgileri
$username = 'admin';         // Artık username kullanıyoruz
$password = '123456';        // Bu şifreyi hashleyeceğiz

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Şifreyi bcrypt ile hashle
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Admini ekle
    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashedPassword]);

    echo "Admin başarıyla eklendi!\nUsername: $username\nŞifre: $password";
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
