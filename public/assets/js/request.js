function formatParams(params){
    return  Object
        .keys(params)
        .map(function(key){
            return key+"="+encodeURIComponent(params[key])
        })
        .join("&")
}

const http = {

    post: (url, body,callback, ) =>{
        var xmlHttp = new XMLHttpRequest();
        
        xmlHttp.onreadystatechange = function() { 
            if (xmlHttp.readyState == XMLHttpRequest.DONE){
                callback({status:xmlHttp.status,response:JSON.parse(xmlHttp.response)});
            }
        }

        xmlHttp.open("POST", url, true); // true for asynchronous 
        xmlHttp.send(body);
    },

    get: (url, callback, params ={}) =>{
        var xmlHttp = new XMLHttpRequest();
        var paramsString = formatParams(params);
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == XMLHttpRequest.DONE){
                callback({status:xmlHttp.status,response:JSON.parse(xmlHttp.response)});
            }
        }
        xmlHttp.open("GET", url.concat('?',paramsString), true); // true for asynchronous 
        xmlHttp.send(null);
    },

    delete: (url, callback) => {
        var xmlHttp = new XMLHttpRequest();
        
        xmlHttp.onreadystatechange = function() { 
            if (xmlHttp.readyState == XMLHttpRequest.DONE){
                callback({status:xmlHttp.status,response:JSON.parse(xmlHttp.response)});
            }
        }
        xmlHttp.open("DELETE", url, true); // true for asynchronous 
        xmlHttp.send(null);
    },

    put: (url, body,callback, ) =>{
        var xmlHttp = new XMLHttpRequest();
        
        xmlHttp.onreadystatechange = function() { 
            if (xmlHttp.readyState == XMLHttpRequest.DONE){
                callback({status:xmlHttp.status,response:JSON.parse(xmlHttp.response)});
            }
        }

        xmlHttp.open("PUT", url, true); // true for asynchronous 
        xmlHttp.send(body);
    }
}

