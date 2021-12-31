var columnsDrop;

function startDragColumn(event){
    event.target.style.opacity = .5;
    columnsDrop = document.getElementById('columns-drop');
}

function endDragColumn(event){
    event.target.style.opacity = "";
    
    var leftColumn  = rightColumn = 0;
    var leftColumnRef = rightColumnRef =null;

    for(let column of columnsDrop.children){  
        if(column.draggable && column != event.srcElement){
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
        priority = rightColumn - 1;
    }else{
        priority = rightColumn + ( (leftColumn - rightColumn) / 2 );
    }
    var formData = new FormData();
    formData.append('priority',priority);

    http.post(`/columns/update/${event.target.dataset.id}`,formData,(result) => {
        if(result.status == 200){   
            event.target.dataset.priority = priority;
            if(rightColumnRef){
                columnsDrop.insertBefore(event.target, rightColumnRef);
            }else{
                var length = columnsDrop.children.length;
                columnsDrop.insertBefore(event.target, columnsDrop.children.item(length-1));
            }
            
        }else{

        }
    });
}


