<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>
        <?php echo $title; ?>
    </title>
</head>
<body>

    <h1>
        <?php echo $title; ?>
        admin
    </h1>

    <p>
        <?php dump($data); ?>
        <?php dump($get); ?>
        <?php dump($sessions); ?>
        <?php dump($_SERVER); ?>
    </p>

</body>
</html>
