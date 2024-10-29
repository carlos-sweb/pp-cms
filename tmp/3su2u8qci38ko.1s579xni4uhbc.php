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
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"
/>
    <title><?= ($title) ?></title>
</head>

<body 
class="
        deeppurple50 
        flex 
        flex-col 
        items-center 
        justify-start 
        w-full 
        h-full select-none
">