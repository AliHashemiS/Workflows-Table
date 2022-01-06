<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="/assets/css/login.style.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/request.js"></script>
    <script src="/assets/js/user.js"></script>
    <title>SignIn</title>
</head>
<body>
    <div id="alert" class=""></div>
    <div class="divPrincipal">
        <table class="principalTable" align="center" cellpadding="10" cellspacing="20">
            <tr>  
                <td>   
                    <form id="login" onsubmit="loginUser(event)">
                        <h1 style="margin-bottom: 10%;">Sign In</h1>     

                        <div class="divInputs"> 
                            <input type="email" name="inputEmail" placeholder="Email address" required="" autofocus="">
                        </div>

                        <div class="divInputs">
                            <input type="password" name="inputPassword" placeholder="Password" required="" autofocus="">
                        </div>
                        
                        <div class="divInputs">
                            <button class="button" type="submit">Sign In</button>
                        </div>
                        <div class="divInputs">
                            <a href='register'>Sing Up</a>
                        </div>
                    </form>
                </td>
            </tr>   
        </table>
    </div>
</body>
</html>