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
        <div id="columns-drop" class="columns">
            <?php foreach ($data['columns'] as &$column) { ?>
                <div id="column-<?php echo $column->id; ?>" data-priority="<?php echo $column->priority; ?>" data-id="<?php echo $column->id; ?>" draggable="true" ondragend="endDragColumn(event)" ondragstart="startDragColumn(event)" class="column box-shadow">

                    <div id="column-title-<?php echo $column->id;?>">
                        <label onclick="enableEdit(event)">
                            <?php echo $column->title; ?>
                        </label>
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
            <div id="column-create" class="column box-shadow">
                <form>
                    <input type="text"  class="column-title" name="title" value="Añadir otra columna">
                    <input type="submit" class="submit" name="save" value="Guardar">
                </form>
            </div>

        </div>
    </div>
</body>
</html>

