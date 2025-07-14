<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CheckInCafe - 絞り込み一覧</title>
</head>
<body>

  <!-- 絞り込み用フォーム -->
  <form action="read.php" method="get">
    <label for="cafe">カフェで絞り込む：</label>
    <select id="cafe" name="cafe" onchange="this.form.submit()">
      <option value="">— すべて表示 —</option>
      <option value="スターバックス" <?= (isset($_GET['cafe']) && $_GET['cafe']==='スターバックス')?'selected':'' ?>>スターバックス</option>
      <option value="タリーズ"       <?= (isset($_GET['cafe']) && $_GET['cafe']==='タリーズ')      ?'selected':'' ?>>タリーズ</option>
      <option value="ドトール"       <?= (isset($_GET['cafe']) && $_GET['cafe']==='ドトール')      ?'selected':'' ?>>ドトール</option>
    </select>
    <!-- JavaScriptをオフにしている方のために submit ボタンも残しておく -->
    <button type="submit">絞り込む</button>
  </form>

  <?php
  // フィルターに使うカフェ名を受け取る（未指定なら空文字）
  $filterCafe = isset($_GET['cafe']) ? $_GET['cafe'] : '';

  // CSVを１行ずつ読み込み、フィルタリングして表示
  if (($handle = fopen('cafe.csv', 'r')) !== false) {
      echo '<ul>';
      while (($row = fgetcsv($handle)) !== false) {
          // $row[0]: カフェ名, $row[1]: メニュー, $row[2]: 備考, $row[3]: 送信時刻（追加している場合）
          
          // フィルターが指定されていて、かつ一致しないレコードはスキップ
          if ($filterCafe !== '' && $row[0] !== $filterCafe) {
              continue;
          }

          // 表示用に各列をエスケープ
          $cafe    = htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8');
          $menu    = htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8');
          $memo    = nl2br(htmlspecialchars($row[2], ENT_QUOTES, 'UTF-8'));
          // もし send_at を追加済みなら４番目の要素を利用
          $sentAt  = isset($row[3]) ? htmlspecialchars($row[3], ENT_QUOTES, 'UTF-8') : '';

          echo '<li>';
          if ($sentAt !== '') {
              echo "【{$sentAt}】 ";
          }
          echo "{$cafe} ／ {$menu}";
          if ($memo !== '') {
              echo " ／ {$memo}";
          }
          echo '</li>';
      }
      echo '</ul>';
      fclose($handle);
  } else {
      echo "<p>ファイルオープン失敗</p>";
  }
  ?>

  <p><a href="index.php">← トップに戻る</a></p>

</body>
</html>
