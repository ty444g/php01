<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckInCafe</title>
</head>
<body>
    <form action="write.php" method="post">
        <label for="cafe">カフェを選択：</label>
        <select id="cafe" name="cafe" required>
            <!-- プレースホルダー的に “選んでください” を最初に表示 -->
            <option value="" disabled selected>— 選んでください —</option>
            <!-- value 属性がサーバへ送られる値、タグ内テキストが表示ラベル -->
            <option value="スターバックス">スターバックス</option>
            <option value="タリーズ">タリーズ</option>
            <option value="ドトール">ドトール</option>
        </select><br>
        メニュー：<input type="text" name="menu"><br>
        備考：<textarea name="memo" cols="30" rows="10"></textarea>
        <button type="submit">送信</button>
    </form>

    <ul>
    <li><a href="read.php">read.php</a></li>
    </ul>    
</body>
</html>
