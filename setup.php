<?php
/**
 * Automated Database & Environment Setup Script
 * Manjusha K Madhavan Personal Portfolio
 */
require_once __DIR__ . '/config/db.php';

$message = '';
$status = 'info';

if (isset($_POST['init'])) {
    try {
        $pdo = getDB();
        $message = "Database `manjusha_db` and all tables initialized successfully!<br>Default owner account: <b>manjushakmadhavan@gmail.com</b> / <b>owner123</b>";
        $status = 'success';
    } catch (Exception $e) {
        $message = "Setup error: " . htmlspecialchars($e->getMessage());
        $status = 'danger';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Setup & Diagnostic &middot; Manjusha K Madhavan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  body { background: #070913; color: #ece9e2; font-family: 'Jost', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; }
  .card { background: rgba(14, 18, 38, 0.85); border: 1px solid rgba(216, 184, 120, 0.3); border-radius: 0; box-shadow: 0 10px 40px rgba(0,0,0,0.8); max-width: 580px; width: 100%; padding: 2.2rem; }
  h1 { font-family: 'Cormorant Garamond', serif; color: #d8b878; font-size: 2.2rem; }
  .btn-gold { background: #d8b878; color: #000; border: 0; font-weight: 500; border-radius: 0; padding: .6rem 1.6rem; }
  .btn-gold:hover { background: #fff; color: #000; }
  .badge-check { background: #2d6a4f; color: #fff; padding: .2rem .6rem; border-radius: 4px; font-size: .8rem; }
  .badge-fail { background: #b91c1c; color: #fff; padding: .2rem .6rem; border-radius: 4px; font-size: .8rem; }
</style>
</head>
<body>
<div class="card">
  <h1>Database Setup & Status</h1>
  <p class="text-secondary">Check your local PHP & MySQL environment for the portfolio website.</p>

  <?php if ($message): ?>
    <div class="alert alert-<?= $status ?> mb-4"><?= $message ?></div>
  <?php endif; ?>

  <div class="mb-4">
    <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25">
      <span>PHP Version:</span>
      <strong><?= phpversion() ?></strong>
    </div>
    <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25">
      <span>PDO MySQL Extension:</span>
      <span><?= extension_loaded('pdo_mysql') ? '<span class="badge-check">Enabled</span>' : '<span class="badge-fail">Missing</span>' ?></span>
    </div>
    <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25">
      <span>Uploads Directory:</span>
      <span><?= is_writable(__DIR__ . '/uploads/moments') ? '<span class="badge-check">Writable</span>' : '<span class="badge-fail">Check permissions</span>' ?></span>
    </div>
    <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25">
      <span>Default DB Host / Port:</span>
      <strong><?= DB_HOST ?>:<?= DB_PORT ?></strong>
    </div>
  </div>

  <form method="POST" class="d-flex gap-2">
    <button type="submit" name="init" class="btn btn-gold">Initialize Database Now</button>
    <a href="index.php" class="btn btn-outline-light" style="border-radius:0;">Open Portfolio Website &rarr;</a>
  </form>
</div>
</body>
</html>
