var columnsDrop;

function startDragColumn(event){
    event.target.parentElement.style.opacity = .5;
    columnsDrop = document.getElementById('columns-drop');
}

function endDragColumn(event){
    const columnElement = event.target.parentElement;
    columnElement.style.opacity = "";
    
    var leftColumn  = rightColumn = 0;
    var leftColumnRef = rightColumnRef =null;

    for(let column of columnsDrop.children){  
        if(column.dataset.draggable && column != columnElement){
            elemRect = column.getBoundingClientRect();
            var middle = elemRect.x + (elemRect.width/2);
            if(middle >= event.x && rightColumn == 0){
                rightColumn = Number(column.dataset.priority);
                rightColumnRef = column;
                continue;
            }
            
            if(middle <= event.x && leftColumn == 0){
                leftColumn = Number(column.dataset.priority);
                leftColumnRef = column;
            }
        }
    }

    var priority = 0;
    
    if(rightColumn <=0){

        priority = leftColumn +1;
    }else if (leftColumn <=0){
        priority = rightColumn - 0.1;
    }else{
        priority = rightColumn + ( (leftColumn - rightColumn) / 2 );
    }
    var formData = new FormData();
    formData.append('priority',priority);

    http.post(`/columns/update/${columnElement.dataset.id}`,formData,(result) => {
        if(result.status == 200){   
            columnElement.dataset.priority = priority;
            if(rightColumnRef){
                columnsDrop.insertBefore(columnElement, rightColumnRef);
            }else{
                var length = columnsDrop.children.length;
                columnsDrop.insertBefore(columnElement, columnsDrop.children.item(length-1));
            }
            
        }else{

        }
    });
}


function enableEditColumn(event){
    const title = event.target;
    const parent = event.target.parentElement;
    event.target.remove();
    const input = document.createElement('input');
    const origialTitle = title.innerText.trim();
    input.value = origialTitle;
    parent.appendChild(input);
    input.focus();

    input.addEventListener('focusout', (e) => {
        const value = input.value;
        title.innerText = value;
        input.remove();
        parent.appendChild(title);

        var formData = new FormData();
        formData.append('title',value);
        const id = parent.parentElement.dataset.id;
        if(origialTitle == value){
            return;
        }
        http.post(`/columns/update/${id}`,formData,(result) => {
            if(result.status != 200){   
                title.innerText = origialTitle;
            }
        });

    });
}



function addColumn(event){
    id_workflow = event.target.dataset.id_workflow;
    priority = getColumnMaxPriority()+1;
    title = "Nueva Columna";

    var formData = new FormData();
    formData.append('id_workflow',id_workflow);
    formData.append('priority',priority);
    formData.append('title',title);

    http.post(`/columns/create`,formData,(result) => {
        if(result.status == 200){   
            const column = createColumnElement(result.response.data.id,priority,title);
            const createButton = document.getElementById('create-column');
            document.getElementById('columns-drop').insertBefore(column,createButton);
        }else{

        }
    });
}

function getColumnMaxPriority(){
    var columnDrop = document.getElementById('columns-drop');
    var maxPriority = 0;
    for(let column of columnDrop.children){  
        const priority = column.dataset.priority;
        if(maxPriority < priority){
            maxPriority = Number(priority)
        }
    }
    return maxPriority;
}


function createColumnElement(id,priority,title){
    const div = document.createElement('div');
    div.id = `column-${id}`;
    div.className = "column box-shadow";
    div.dataset.draggable="true";
    div.dataset.priority = priority;
    div.dataset.id = id;

    const columnTitle = document.createElement('div');
    columnTitle.id=`column-title-${id}`;
    columnTitle.className = "column-title";
    columnTitle.draggable = true;
    columnTitle.addEventListener('dragend',endDragColumn);
    columnTitle.addEventListener('dragstart',startDragColumn);

    const label = document.createElement('label');
    label.addEventListener('click',enableEditColumn);
    label.innerText = title;

    const ul = document.createElement('ul');
    ul.id = `column-body-${id}`;
    ul.dataset.id_column = id;
    ul.className = "column-body"
    ul.addEventListener('dragenter',enterDragStikyNote);

    const columnFooter = document.createElement('div');
    columnFooter.className = "column-footer";

    const button = document.createElement('button');
    button.dataset.id = id;
    button.addEventListener('click',addStikyNote);
    button.className = "submit";
    button.innerText = "Aadd Sticky Note";

    const deleteButton = document.createElement('button');
    deleteButton.dataset.id = id;
    deleteButton.addEventListener('click',deleteColumn);
    deleteButton.className = "delete";
    deleteButton.innerText = "Delete";

    div.appendChild(columnTitle);
    columnTitle.appendChild(label);
    div.appendChild(ul);
    div.appendChild(columnFooter);
    columnFooter.appendChild(button);
    columnFooter.appendChild(deleteButton);

    return div;

    
}

function deleteColumn(event){
    const id = event.target.dataset.id;

    http.delete(`/columns/delete/${id}`,(result) => {
        if(result.status == 200){   
            document.getElementById(`column-${id}`).remove();
        }else{

        }
    });
}

