<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/workflows.show.style.css">
    <script src="/assets/js/request.js"></script>
    <script src="/assets/js/workflows.show.js"></script>
    <script src="/assets/js/dragStikyNote.js"></script>
    <script src="/assets/js/dragColumn.js"></script>
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
                <div id="column-<?php echo $column->id; ?>" class="column box-shadow" data-draggable="true"  data-priority="<?php echo $column->priority; ?>" data-id="<?php echo $column->id; ?>">

                    <div id="column-title-<?php echo $column->id;?>" class="column-title" draggable="true"  ondragend="endDragColumn(event)" ondragstart="startDragColumn(event)" >
                        <label onclick="enableEditColumn(event)">
                            <?php echo $column->title; ?>
                        </label>
                    </div>
                    <ul id="column-body-<?php echo $column->id; ?>" data-id_column="<?php echo $column->id; ?>" class="column-body" ondragenter="enterDragStikyNote(event)">
                        <?php foreach ($column->stikyNotes as &$stikyNote) { ?>
                            <li id="stiky-note-<?php echo $stikyNote->id;?>" draggable="true" ondragend="endDragStikyNote(event)" ondragstart="startDragStikyNote(event)" data-id_column="<?php echo $stikyNote->id_column; ?>" data-id="<?php echo $stikyNote->id; ?>"  data-priority="<?php echo $stikyNote->priority;?>" class="stikynote box-shadow" style="background-color: <?php echo $stikyNote->color;?>;">
                                <input type="color" data-id="<?php echo $stikyNote->id;?>" onchange="changeColor(event)" value="<?php echo $stikyNote->color;?>">
                                <div data-id="<?php echo $stikyNote->id; ?>">
                                    <p class="word-break" onclick="enableEditStikyNote(event)">
                                        <?php echo $stikyNote->content; ?>
                                    </p>
                                    
                                </div>
                               
                                <button data-id="<?php echo $stikyNote->id;?>" onclick="deleteStikyNote(event)">Borrar</button>
                               
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="column-footer">
                        <button data-id="<?php echo $column->id; ?>" onclick="addStikyNote(event)" class="submit">
                            Agregar Stiky note
                        </button>
                    </div>
                </div>
            <?php } ?>
            <button>Agregar Columna</button>

        </div>
    </div>
</body>
</html>

