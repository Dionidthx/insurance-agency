<?php
$db = new PDO('sqlite:services.db');

$filter = isset($_GET['category']) ? $_GET['category'] : '';

if ($filter) {
    $stmt = $db->prepare("SELECT * FROM services WHERE category = :cat");
    $stmt->bindParam(':cat', $filter);
    $stmt->execute();
} else {
    $stmt = $db->query("SELECT * FROM services");
}

$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <title>Наші послуги</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
  <h1>Наші послуги</h1>
  <nav>
    <ul>
      <li><a href="index.html">Головна</a></li>
      <li><a href="services.php">Послуги</a></li>
      <li><a href="contacts.html">Контакти</a></li>
      <li><button onclick="toggleMerch()">Мерч</button></li>
      <li><button onclick="openCart()">🛒 Кошик</button></li>
    </ul>
  </nav>
</header>

<main class="grid-container">
  <form method="get">
    <label for="category">Фільтр за категорією:</label>
    <select name="category" id="category">
      <option value="">Усі</option>
      <option value="авто" <?= $filter == 'авто' ? 'selected' : '' ?>>Авто</option>
      <option value="здоров'я" <?= $filter == "здоров'я" ? 'selected' : '' ?>>Здоров’я</option>
      <option value="нерухомість" <?= $filter == 'нерухомість' ? 'selected' : '' ?>>Нерухомість</option>
    </select>
    <button type="submit">Фільтрувати</button>
  </form>

  <section class="services">
    <?php foreach ($services as $srv): ?>
    <article>
      <img src="<?= strtolower($srv['category']) ?>-insurance.jpg" alt="<?= htmlspecialchars($srv['name']) ?>">
      <h2><?= htmlspecialchars($srv['name']) ?></h2>
      <p><?= htmlspecialchars($srv['description']) ?></p>
    </article>
    <?php endforeach; ?>
  </section>
</main>

<?php include 'cart-section.php'; ?>
<script src="script.js" defer></script>
</body>
</html>
