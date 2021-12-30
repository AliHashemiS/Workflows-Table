<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/workflows.style.css">
    <script src="/assets/js/workflows.js"></script>
    <title>Dashboard</title>
</head>
<body>
    <?php require APP_ROOT . '/views/templates/menu.php'; ?>

    <div class="container">
        <h2>
            Mis Tableros
        </h2>

        <div class="workflows">
            <?php foreach ($data['workflows'] as &$workflow) { ?>
                <div class="workflow">
                    <form id="worflow-<?php echo $workflow->id;?>" action="workflows/edit/<?php echo $workflow->id;?>" method="POST">
                        <input class="workflow-title" name="name" placeholder="Nombre de tablero" min="1" max="100" required disabled value="<?php echo $workflow->name;?>">

                        <textarea class="workflow-description" disabled name="description" ><?php echo $workflow->description;?></textarea>

                        <span>
                            Creado: <?php echo $workflow->created_at;?>
                        </span>
                        <input class="worflow-submit" type="submit" value="Guardar">
                    </form>
                    <div class="workflow-options">
                        <a class="decoration-none  pointer text-success" href="workflows/show/<?php echo $workflow->id;?>">
                            <span class="material-icons">
                                visibility
                            </span>
                        </a>

                        <button onclick="enableEdit()" class="text-warning edit pointer">
                            <span class="material-icons">
                                edit
                            </span>
                        </button>

                        <a class="text-danger pointer" href="workflows/delete/<?php echo $workflow->id;?>">
                            <span class="material-icons">
                                delete
                            </span>
                        </a>
                    </div>
                </div>
            <?php } ?>


            <div class="workflow">
                <form id="worflow-1" action="workflows/create" method="POST">
                    <input class="workflow-title" name="name" placeholder="Nombre Tablero" min="1" max="100" required value="">

                    <textarea class="workflow-description" name="description" required minlength="0" maxlength="1024" placeholder="Descripción de us nuevo tablero"></textarea>
                    <input class="worflow-submit" type="submit" value="Guardar">
                </form>
            </div>

        </div>
    </div>
</body>
</html>
