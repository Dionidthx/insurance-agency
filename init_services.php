<?php
$db = new PDO("sqlite:services.db");

// Створюємо таблицю, якщо ще не існує
$db->exec("CREATE TABLE IF NOT EXISTS services (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    category TEXT NOT NULL
)");

// Перевіряємо, чи таблиця вже має дані
$count = $db->query("SELECT COUNT(*) FROM services")->fetchColumn();

if ($count == 0) {
    // Додаємо дані лише один раз
    $db->exec("INSERT INTO services (name, description, category) VALUES
        ('Автострахування', 'Захистіть себе та транспорт', 'авто'),
        ('Медичне страхування', 'Якісне обслуговування', 'здоров\'я'),
        ('Страхування майна', 'Захист майна від форс-мажору', 'нерухомість')
    ");
    echo " Послуги додано до бази.";
} else {
    echo " Дані вже існують у таблиці services.";
}
?>
