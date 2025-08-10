 <?php
  // Einfaches, sicheres appending der Wunsch-URL in eine Textdatei
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'] ?? '';
    $title = $_POST['title'] ?? '';
    $url = trim($url);
    $title = trim($title);
    if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
      $line = date('Y-m-d H:i:s') . "\t" . $title . "\t" . $url . PHP_EOL;
      file_put_contents('wish_queue.txt', $line, FILE_APPEND | LOCK_EX);
      http_response_code(200);
      echo 'OK';
      exit;
    }
  }
  http_response_code(400);
  echo 'Bad Request';
  ?>