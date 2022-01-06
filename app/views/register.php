<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="/assets/css/register.style.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/request.js"></script>
    <script src="/assets/js/user.js"></script>
    <title>SignUp</title>
</head>
<body>
    <div id="alert" class=""></div>
    <div class="divPrincipal">
        <table class="principalTable" align="center" cellpadding="10" cellspacing="20">
            <tr>
                <td>
                    <form id="register" onsubmit="createUser(event)">
                        <h1 style="margin-bottom: 10%;">Sign Up</h1>     

                        <div class="divInputs">
                            <input type="email" name="userEmail" placeholder="Email address" required autofocus="">
                        </div>

                        <div class="divInputs">
                            <input type="password" name="userPass" placeholder="Password" required autofocus="">
                        </div>

                        <div class="divInputs">
                            <input type="password" name="userRepeatpass" placeholder="Repeat Password" required autofocus="">
                        </div>
                        
                        <div class="divInputs">
                            <button class="button" type="submit">Sign Up</button>
                        </div>
                        
                        <div class="divInputs">
                            <a href="./index">Back</a>
                        </div>
                    </form>
                </td>
            </tr>   
        </table>
    </div>
</body>
</html>