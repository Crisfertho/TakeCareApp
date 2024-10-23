<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Aplicación TakeCare para gestionar tu aspecto físico.">
    <title>TakeCare APP</title>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" as="style" onload="this.rel='stylesheet'"> 
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <div class="container-app">
        <section class="app">
            <img src="/build/img/2.webp" alt="imagen" class="image">
            <?php echo $contenido; ?>
        </section>
        <aside class="imagen"></aside>
    </div>

    <?php 
        echo $script ??  '';
    ?>
            
</body>
</html>