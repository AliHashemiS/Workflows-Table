function createUser(event){
    event.preventDefault();
    const user_email = event.target.elements.userEmail.value;
    const user_pass = event.target.elements.userPass.value;
    const user_repeatpass = event.target.elements.userRepeatpass.value;
    if(user_pass == user_repeatpass){
        var formData = new FormData();
        formData.append('userEmail',user_email);
        formData.append('userPass',user_pass);
        
        http.post("/register/register",formData,(result) => {
            console.log(result);
            if(result.status == 200){
                showAlert('alert-success',result.response.message);
            }else{
                showAlert('alert-danger',result.response.message);
            }
        });
    }else{
        showAlert('alert-danger', "Error, las contraseñas no coindiden");
    }
}

function loginUser(event){
    event.preventDefault();
    const inputEmail = event.target.elements.inputEmail.value;
    const inputPassword = event.target.elements.inputPassword.value;
    var formData = new FormData();
    formData.append('inputEmail',inputEmail);
    formData.append('inputPassword',inputPassword);
    
    http.post("/index/login",formData,(result) => {
        console.log(result);
        if(result.status == 200){
            showAlert('alert-success',result.response.message);
            window.location="/workflows";
        }else{
            showAlert('alert-danger',result.response.message);
        }
    });
}

function showAlert(css,message){
    const alert = document.getElementById('alert');
    alert.className = `alert ${css}`;
    alert.innerText = message;
}