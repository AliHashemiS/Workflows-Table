<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/workflows.show.style.css">
    <script src="/assets/js/request.js"></script>
    <script src="/assets/js/workflows.show.js"></script>
    <title>Dashboard</title>
</head>
<body>
    <?php require APP_ROOT . '/views/templates/menu.php'; ?>

    <div class="container">
        <h3>
            <a href="/workflows" class="decoration-none back-button pointer">
                <span class="material-icons">
                    arrow_back
                </span>
            </a>
        <?php echo $data['name']; ?></h3>
        <div class="columns">
            <?php foreach ($data['columns'] as &$column) { ?>
                <div class="column box-shadow">
                    <div class="column-title">
                        <input type="text" disabled name="title" value="<?php echo $column->title; ?>">
                    </div>
                    <ul class="column-stikynotes">
                        <?php foreach ($column->stikyNotes as &$stikyNote) { ?>
                            <li class="stikynote">
                                <?php echo $stikyNote->content; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <div class="column box-shadow">
                <div class="column-title">
                    <input type="text" name="title" value="Añadir otra columna">
                    <button>Agregar columna</button>
                </div>
            </div>

        </div>
    </div>
</body>
</html>

