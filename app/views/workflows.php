<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/workflows.style.css">
    <script src="/assets/js/request.js"></script>
    <script src="/assets/js/workflows.js"></script>
    <title>Dashboard</title>
</head>
<body onload="marcarWorkflow()">
    <?php require APP_ROOT . '/views/templates/menu.php'; ?>

    <div class="container">
        <h2>
            Workflows
        </h2>  

        <div id="alert" class="">

        </div>

        <div id="workflows" class="workflows">
            <div class="workflow box-shadow">
                <form id="worflow-1" onsubmit="createWorkflow(event)">
                    <input class="workflow-title" name="name" placeholder="Worflow name" min="1" max="100" required value="">

                    <textarea class="workflow-description" name="description" required minlength="0" maxlength="1024" placeholder="Worflow description"></textarea>
                    <input class="worflow-submit" type="submit" value="Save">
                </form>
            </div>

            <?php foreach ($data['workflows'] as &$workflow) { ?>
                <div id="workflow-<?php echo $workflow->id;?>" class="workflow box-shadow">
                    <form id="workflow-form-<?php echo $workflow->id;?>" onsubmit="updateWorkflow(event,<?php echo $workflow->id;?>)">
                        <input class="workflow-title" name="name" placeholder="Workflow name" min="1" max="100" required disabled value="<?php echo $workflow->name;?>">

                        <textarea class="workflow-description" disabled name="description" ><?php echo $workflow->description;?></textarea>

                        <span>
                            Create at: <?php echo  date("d/m/Y", strtotime($workflow->created_at));?>
                        </span>
                        <input class="worflow-submit d-none" name="submit" type="submit" value="save">
                    </form>
                    <div class="workflow-options">
                        <a class="decoration-none  pointer text-success" href="workflows/show/<?php echo $workflow->id;?>">
                            <span class="material-icons">
                                visibility
                            </span>
                        </a>

                        <button onclick="enableEdit(event,<?php echo $workflow->id;?>)" class="text-warning edit pointer">
                            <span class="material-icons">
                                edit
                            </span>
                        </button>

                        <button onclick="deleteWorkflow(event,<?php echo $workflow->id;?>)" class="text-danger edit pointer">
                            <span class="material-icons">
                                delete
                            </span>
                        </button>
                    </div>
                </div>
            <?php } ?>


            

        </div>
    </div>
</body>
</html>

