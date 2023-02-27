<html>

<head>
    <meta charset="utf-8">
    <title>掲示板</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="w-75 mx-auto">
        <!-- 掲示板のタイトル -->
        <h1 class="text-center">ひとこと掲示板</h1>
        <!-- 掲示板の本体。HTMLの<table>を使って、見た目は綺麗だと思います！ -->
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">名前</th>
                    <th scope="col">コメント</th>
                    <th scope="col">時刻</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <?php if (!empty($data)) : ?>
                <?php foreach ($data as $key => $row) : ?>
                    <tr>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="id" value=<?php echo $row['id']; ?>>
                            <td><?php echo html_escape($row['name']); ?></td>
                            <td><?php echo nl2br(html_escape($row['comment'])); ?></td>
                            <td><?php echo html_escape($row['created']); ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>"><input class="btn btn-primary" type="button" value="編集"></a>
                                <button class="btn btn-danger" id="button1">削除</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            <?php endif ?>
        </table>
        <!-- エラーがあれば、ここでエラーのメッセージを表示します！ -->
        <?php if (count($errs)) {
            foreach ($errs as $err) {
                echo '<p style="color: red">' . $err . '</p>';
            }
        } ?>
        <!-- 掲示板の入力エリアです。HTMLの<form>を使わないと、提出(POST)できませんね -->
        <div>
            <form action="" method="POST">
                <p>お名前*<input class="form-control" type="text" name="name">(50文字まで)</p>
                <p>ひとこと*<textarea class="form-control" name="comment" rows="4" cols="40"></textarea>(200文字まで)</p>
                <input type="submit" value="書き込む">
            </form>
        </div>
        <!-- End of Tag -->
    </div>
</body>

</html>