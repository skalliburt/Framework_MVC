<?php require ROUTE_APP.'/views/inc/header.php'; ?>

<?php echo $data['tittle']?>

<ul>
    <?php foreach($data['articulos'] as $articulo) : ?>
        <li><?php echo $articulo->Titulo; ?></li>
    <?php endforeach ?>
</ul>

<?php require ROUTE_APP.'/views/inc/footer.php'; ?>
