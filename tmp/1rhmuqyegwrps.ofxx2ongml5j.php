<!DOCTYPE html><html lang="en" class="flex w-full h-full">
<head>
    <meta charset="UTF-8">
    <?php foreach (($meta?:[]) as $item): ?>
    <meta name="<?= ($item["name"]) ?>" content="<?= ($item["content"]) ?>" >
    <?php endforeach; ?>
    <?php foreach (($css?:[]) as $link): ?>
    <link rel="stylesheet" href="<?= ($link) ?>">
    <?php endforeach; ?>
    <style>*{font-family: 'Ubuntu', sans-serif;}</style>
    <title><?= ($title) ?></title>
</head>
<body class="gray300 flex flex-col items-center justify-start w-full h-full select-none">