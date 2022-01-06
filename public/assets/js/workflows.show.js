function presionar_targeta(event)
{
    document.getElementById("speackStatus").setAttribute("state", "false");
    localStorage.setItem("idWorkflow",event.target.body.id);
    let listaTarjetas = document.getElementsByClassName("stikynote");

    console.log(listaTarjetas);

    for(let element of listaTarjetas){
        element.addEventListener('click', function () {
            for (var i=0; i<listaTarjetas.length; i++) {
                listaTarjetas[i].setAttribute("seleccionada",false);
            }
            console.log("Escucha");
            lectura_tarjeta(element.innerText);
            this.setAttribute("seleccionada",true);
        });
    }
}

function automatic_read()
{  
    let listaColumnas = document.getElementsByClassName("column");

    console.log(listaColumnas);

    for(let element of listaColumnas){
        lectura_tarjeta(element.innerText); 
    }
}

function lectura_tarjeta(htmlobj)
{
    console.log(htmlobj);
    utter = new SpeechSynthesisUtterance();
    utter.lang = 'es-ES';
    utter.volume = 1;
    utter.onend = function() 
    {
        console.log('La lectura ha finalizado');
    }
    utter.text = htmlobj;
    window.speechSynthesis.speak(utter);
    
    utter.onboundary = function(event) {
        localStorage.setItem("textSpeack", utter);
    }

    document.addEventListener("keypress", function(event) {
        const keyName = event.key;
        console.log(keyName);
        if(keyName == " "){
            console.log(document.getElementById("speackStatus").getAttribute("state"));
            if(document.getElementById("speackStatus").getAttribute("state") == "false"){
                console.log("pause");
                document.getElementById("speackStatus").setAttribute("state", true);
                window.speechSynthesis.pause();
            }else{
                document.getElementById("speackStatus").setAttribute("state", false);
                console.log("resume");
                console.log(localStorage.getItem("textSpeack"));
                window.speechSynthesis.cancel(utter);
                window.speechSynthesis.speak(utter);
            }
        }
    });
}