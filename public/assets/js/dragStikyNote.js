var stikyNotesDrop;

function endDragStikyNote(event){
    const stikyNoteElement = event.target;

    if(stikyNotesDrop.children.length > 0){
        var near = null
        var nearRect = null;
        var min = null;
        for(let stikyNote of stikyNotesDrop.children){
            if(stikyNote.draggable && stikyNote != stikyNoteElement){
                elemRect = stikyNote.getBoundingClientRect();
                var middle = elemRect.y +(elemRect.height /2);
                var distance = Math.abs(event.y -middle);
                if(min > distance){
                    min = distance;
                    near = stikyNote;
                    nearRect = elemRect;
                }
                
                if(!min){
                    min = distance;
                    near = stikyNote;
                    nearRect = elemRect;
                }
            }
        }

        var topDistance,bottomDistance,priority = 0;
        var insertBefore;

        topDistance = Math.abs(nearRect.y - event.y);
        bottomDistance = Math.abs(nearRect.bottom - event.y);
        var index = Array.prototype.indexOf.call(stikyNotesDrop.children, near);
        if(topDistance < bottomDistance){ // esta más cerda de arriba(insertar arriba)
            insertBefore = true;
            if(index == 0){
                priority = Number(near.dataset.priority) -0.1;
                
            }else{
                priority = Number(near.dataset.priority) + ( (stikyNotesDrop.children[index-1].dataset.priority - near.dataset.priority) / 2 );
            }
        }else{
            insertBefore = false;

            if(index == stikyNotesDrop.children.length-1){ // ultimo elemento
                priority = Number(near.dataset.priority) +1;
            }else{
                priority = Number(near.dataset.priority)  + ( (stikyNotesDrop.children[index+1].dataset.priority - near.dataset.priority) / 2 );
            }
        }
    }else{
        var priority = 1000;
        var first = true;
    }
    var formData = new FormData();
    formData.append('priority',priority);
    formData.append('id_column',stikyNotesDrop.dataset.id_column);

    http.post(`/stikyNotes/update/${stikyNoteElement.dataset.id}`,formData,(result) => {
        if(result.status == 200){   
            stikyNoteElement.dataset.id_column = stikyNotesDrop.dataset.id_column;
            stikyNoteElement.dataset.priority = priority;
            if(first){
                stikyNotesDrop.appendChild(stikyNoteElement);
                return;
            }
            if(insertBefore){
                stikyNotesDrop.insertBefore(stikyNoteElement, near);
            }else{
                stikyNotesDrop.insertBefore(stikyNoteElement, near.nextSibling);
            }
        }else{

        }
    });
}

function enterDragStikyNote(event){
    if(stikyNotesDrop == event.target || event.target.className != 'column-body'){
        return;
    }
    stikyNotesDrop = event.target;
}


function startDragStikyNote(event){
    stikyNotesDrop  = event.target.parentElement;
}


function changeColor(event){
    const id = event.target.dataset.id;
    const color = event.target.value;
    
    var formData = new FormData();
    formData.append('color',color);

    http.post(`/stikyNotes/update/${id}`,formData,(result) => {
        if(result.status == 200){   
            const stikyNote = document.getElementById(`stiky-note-${id}`)
            stikyNote.style.backgroundColor = color;
        }else{

        }
    });
}

function deleteStikyNote(event){
    const id = event.target.dataset.id;

    http.delete(`/stikyNotes/delete/${id}`,(result) => {
        if(result.status == 200){   
            const stikyNote = document.getElementById(`stiky-note-${id}`)
            stikyNote.remove();
        }else{

        }
    });
}

function addStikyNote(event){
    const id_column = event.target.dataset.id;
    const content = 'Click para cambiar el contenido';
    const priority = getStikyNoteMaxPriority(id_column) + 1;
    
    var formData = new FormData();
    formData.append('content',content);
    formData.append('priority',priority);
    formData.append('id_column',id_column);

    http.post(`/stikyNotes/create`,formData,(result) => {
        if(result.status == 200){   
            const stikyNote = createStikyNoteElement(result.response.data.id,id_column,content,"#FFFFFF",priority);
            document.getElementById(`column-body-${id_column}`).appendChild(stikyNote);
        }else{

        }
    });
}

function getStikyNoteMaxPriority(id_column){
    var stikyNotes = document.getElementById(`column-body-${id_column}`);
    var maxPriority = 0;
    for(let stikyNote of stikyNotes.children){  
        const priority = stikyNote.dataset.priority;
        if(maxPriority < priority){
            maxPriority = Number(priority)
        }
    }
    return maxPriority;
}


function createStikyNoteElement(id,id_column,content,color,priority){
    const li = document.createElement('li');
    li.id = `stiky-note-${id}`;
    li.draggable = true;
    li.addEventListener('dragend',endDragStikyNote);
    li.addEventListener('dragstart',startDragStikyNote);
    li.dataset.id_column = id_column;
    li.dataset.id = id;
    li.dataset.priority = priority;
    li.className = "stikynote box-shadow";
    li.style.backgroundColor = color;
    
    const input = document.createElement('input');
    input.type="color";
    input.dataset.id = id;
    input.addEventListener('change',changeColor);
    input.value = color;

    const div = document.createElement('div');
    div.dataset.id = id;

    const p = document.createElement('p');
    p.className = "word-break";
    p.addEventListener('click',enableEditStikyNote);
    p.innerText = content;

    const button = document.createElement('button');
    button.dataset.id=id;
    button.addEventListener('click',deleteStikyNote);
    button.innerText = "Borrar";

    li.appendChild(input);
    div.appendChild(p);
    li.appendChild(div)
    li.appendChild(button);
    return li;
}


function enableEditStikyNote(event){
    const text = event.target;
    const parent = event.target.parentElement;
    event.target.remove();
    const input = document.createElement('textarea');
    const origialTitle = text.innerText.trim();
    input.value = origialTitle;
    input.className = "stikynote-content";
    parent.appendChild(input);
    input.focus();

    input.addEventListener('focusout', (e) => {
        const value = input.value;
        text.innerText = value;
        input.remove();
        parent.appendChild(text);

        var formData = new FormData();
        formData.append('content',value);
        const id = parent.parentElement.dataset.id;
        if(origialTitle == value){
            return;
        }
        http.post(`/stikyNotes/update/${id}`,formData,(result) => {
            if(result.status != 200){   
                title.innerText = origialTitle;
            }
        });

    });
}
