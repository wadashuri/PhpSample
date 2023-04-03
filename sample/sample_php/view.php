<!DOCTYPE html>
<html class="h-100">

<head>
    <meta charset="utf-8">
    <title>サンプルコード</title>
    <!-- bootstrapの読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link href="style.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand p-2" href="#">バリデーションサンプルコード</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">php</a>
            </li>
        </ul>
    </nav>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5 border-bottom">送信フォーム</h1>
            <!-- エラーがあれば、ここでエラーのメッセージを表示します！ -->
            <?php if (count($errs)) {
                foreach ($errs as $err) {
                    echo '<div class="alert alert-danger" role="alert">' . $err . '</div>';
                }
            } ?>
            <!-- 送信成功すれば、ここで成功のメッセージを表示します！ -->
            <?php if (count($success)) {
                foreach ($success as $succes) {
                    echo '<div class="alert alert-success" role="alert">' . $succes . '</div>';
                }
            } ?>
            <!-- form -->
            <!-- formのenctypeに"multipart/form-data"を設定する -->
            <form action="controller.php" method="post" enctype="multipart/form-data">

                <!-- input typeは"file"を設定する -->
                <input type="file" class="form-control" name="file">

                <p>お名前<span class='text-danger'>*</span><input class="form-control" type="text" name="name"><span style="color:red;">※50文字まで</span></p>

                <p>年齢<input class="form-control" type="text" min="0" name="num"><span style="color:red;">※3桁まで</span></p>

                <a href="/posts" class="btn btn-secondary">戻る</a>
                <input type="submit" class="btn btn-primary" value="送信">
            </form>
        </div>
    </main>
</body>

</html>