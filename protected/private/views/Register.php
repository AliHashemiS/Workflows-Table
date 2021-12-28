<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="/assets/css/register.css">
    <title>SignUp</title>
</head>
<body>
<div class="divPrincipal">
        <table class="principalTable" align="center" cellpadding="10" cellspacing="20">
            <tr>  
                <td>   
                    <form>
                        <h1 style="margin-bottom: 10%;">Sign Up</h1>     

                        <div class="divInputs"> 
                            <input type="email" id="user-email" class="form-control" placeholder="Email address" required autofocus="">
                        </div>

                        <div class="divInputs">
                            <input type="password" id="user-pass" class="form-control" placeholder="Password" required autofocus="">
                        </div>

                        <div class="divInputs">
                            <input type="password" id="user-repeatpass" class="form-control" placeholder="Repeat Password" required autofocus="">
                        </div>
                        
                        <div class="divInputs">
                            <button class="button" type="submit">Sign Up</button>
                        </div>
                        
                        <div class="divInputs">
                            <a href="index.php">Back</a>
                        </div>
                    </form>
                </td>
            </tr>   
        </table>
    </div>
</body>
</html>

<?php


?>