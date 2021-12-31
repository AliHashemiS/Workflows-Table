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


