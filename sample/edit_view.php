<html>

<head>
    <meta charset="utf-8">
    <title>掲示板</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
<!-- エラーがあれば、ここでエラーのメッセージを表示します！ -->
<?php if (count($errs)) {
    foreach ($errs as $err) {
        echo '<p style="color: red">' . $err . '</p>';
    }
} ?>

<body>
    <div class="w-75 mx-auto">
        <!-- 掲示板のタイトル -->
        <h1 class="text-center">投稿編集</h1>
        <!-- 掲示板の本体。HTMLの<table>を使って、見た目は綺麗だと思います！ -->
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">名前</th>
                    <th scope="col">コメント</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <?php if (!empty($data)) : ?>
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <form action="update.php" method="POST">
                            <td><input type="text" class="form-control" name="name" value="<?php echo html_escape($row['name']); ?>">
                                <div class="form-text">(50文字まで)</div>
                            </td>
                            <td><textarea class="form-control" name=" comment" rows="4" cols="40"><?php echo (html_escape($row['comment'])); ?></textarea>
                                <div class="form-text">(200文字まで)</div>
                            </td>
                            <td><input class="btn btn-primary" type="submit" value="更新"></td>
                            <input type="hidden" name="id" value="<?php echo html_escape($row['id']); ?>">
                        </form>
                    </tr>
                <?php endforeach; ?>
            <?php endif ?>
        </table>
    </div>
</body>

</html>