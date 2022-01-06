
function enableEdit(event,id){
    const workflowForm = document.getElementById(`workflow-form-${id}`);

    workflowForm.elements.name.disabled =false;
    workflowForm.elements.name.focus();
    workflowForm.elements.description.disabled =false;
    workflowForm.elements.submit.className = "worflow-submit ";

}

function updateWorkflow(event,id){
    event.preventDefault();
    var formData = new FormData();
    const name = event.target.elements.name.value;
    const description = event.target.elements.description.value;
    formData.append('name',name);
    formData.append('description',description);
    http.post(`/workflows/update/${id}`,formData,(result) => {
        if(result.status == 200){
            showAlert('alert-success',result.response.message);

            const workflowForm = document.getElementById(`workflow-form-${id}`);
            workflowForm.elements.name.disabled =true;
            workflowForm.elements.description.disabled =true;
            workflowForm.elements.submit.className = "worflow-submit d-none";
            
        }else{
            showAlert('alert-danger',result.response.message);
        }
    });
}


function deleteWorkflow(event,id){
    var formData = new FormData();
    formData.append('id',id);

    http.delete(`/workflows/delete/${id}`,(result) => {
        if(result.status == 200){
            showAlert('alert-success',result.response.message);
            document.getElementById(`workflow-${id}`).remove();
        }else{
            showAlert('alert-danger',result.response.message);
        }
    });
}

function createWorkflow(event){
    event.preventDefault();
    const name = event.target.elements.name.value;
    const description = event.target.elements.description.value;
    var formData = new FormData();
    formData.append('name',name);
    formData.append('description',description);
    
    http.post("/workflows/create",formData,(result) => {
        if(result.status == 200){
            showAlert('alert-success',result.response.message);
            createWorkflowElement(result.response.data.id,name,description);
        }else{
            showAlert('alert-danger',result.response.message);
        }
    });
}

function marcarWorkflow() {
    let idWorkflow = window.localStorage.getItem("idWorkflow");
    let tablaMarcada = document.getElementById("workflow-" + idWorkflow);
    tablaMarcada.setAttribute("seleccionada",true);
    console.log(idWorkflow);
}

function showAlert(css,message){
    const alert = document.getElementById('alert');
    alert.className = `alert ${css}`;
    alert.innerText = message;
}

// this function create html code of workflow
function createWorkflowElement(id,title,description){
    const workflow = document.createElement('div');
    workflow.className = "workflow box-shadow";
    workflow.id = `workflow-${id}`;

    const form = document.createElement('form');
    form.addEventListener('submit', (e) => createWorkflow(e,id));
    form.id = `workflow-form-${id}`;

    const nameInput = document.createElement('input');
    nameInput.className = "workflow-title";
    nameInput.placeholder = "Nombre de tablero";
    nameInput.name = "name";
    nameInput.min = 1;
    nameInput.max = 100;
    nameInput.disabled = true;
    nameInput.value = title;
    nameInput.required = true;

    const descriptionInput = document.createElement('textarea');
    descriptionInput.className = "workflow-description";
    descriptionInput.placeholder = "Descripción de us nuevo tablero";
    descriptionInput.name = "description";
    descriptionInput.min = 1;
    descriptionInput.max = 1024;
    descriptionInput.disabled = true;
    descriptionInput.value = description;
    descriptionInput.required = true;

    const dateSpan = document.createElement('span');
    const currentDate = new Date();
    dateSpan.innerText = `Creado: ${currentDate.toLocaleDateString()}`;

    const submitInput = document.createElement('input');
    submitInput.className = "worflow-submit d-none";
    submitInput.type = "submit";
    submitInput.name = "submit";
    submitInput.value = "Guardar";

    const options = document.createElement('div');
    options.className = "workflow-options";

    const viewButton = document.createElement('a');
    viewButton.className = "decoration-none  pointer text-success";
    viewButton.href = `workflows/show/${id}`;

    const viewIcon =  document.createElement('span');
    viewIcon.className = "material-icons";
    viewIcon.innerHTML = "visibility";

    viewButton.appendChild(viewIcon);


    const updateButton = document.createElement('button');
    updateButton.addEventListener('click',(e) => enableEdit(e,id))
    updateButton.className = "text-warning edit pointer";

    const updateIcon =  document.createElement('span');
    updateIcon.className = "material-icons";
    updateIcon.innerHTML = "edit";

    updateButton.appendChild(updateIcon);


    const deleteButton = document.createElement('button');
    deleteButton.addEventListener('click',(e) => deleteWorkflow(e,id))
    deleteButton.className = "text-danger edit pointer";

    const deleteIcon =  document.createElement('span');
    deleteIcon.className = "material-icons";
    deleteIcon.innerHTML = "delete";

    deleteButton.appendChild(deleteIcon);

    form.appendChild(nameInput);
    form.appendChild(descriptionInput);
    form.appendChild(dateSpan);
    form.appendChild(submitInput);
    workflow.appendChild(form);

    options.appendChild(viewButton);
    options.appendChild(updateButton);
    options.appendChild(deleteButton);
    workflow.appendChild(options);

    document.getElementById('workflows').appendChild(workflow);


}

