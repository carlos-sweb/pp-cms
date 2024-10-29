<!DOCTYPE html>
<html class="flex w-full h-full" >
<head>
    <meta charset="UTF-8">
    <?php if (isset($site['meta'])): ?>
        <?php foreach (($site['meta']?:[]) as $k=>$v): ?>
            <?php if ($k == 'charset'): ?>
                
                    <meta charset="<?= ($v) ?>"  >
                
                <?php else: ?>
                    <meta name="<?= ($k) ?>" content="<?= ($v) ?>" >
                
            <?php endif; ?>               
        <?php endforeach; ?>
    <?php endif; ?>       
    <?php if (isset($site['css'])): ?>
        <?php foreach (($site['css']?:[]) as $link): ?>
            <link rel="stylesheet" href="<?= ($link) ?>">
        <?php endforeach; ?>
    <?php endif; ?>  
    
    <style>*{font-family: 'Ubuntu', sans-serif; }</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    
    <?php if (isset($site['title'])): ?><title><?= ($site['title']) ?></title><?php endif; ?>

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