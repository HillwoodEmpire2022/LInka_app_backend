<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .form-wrapper{
        background: whitesmoke;
        height: 100vh;
        padding: 10% 30%;
        }
        .form-wrapper form {
            width: 500px;
            background: white;
            border: 1px solid lightgrey;
           padding: 10px 40px;
            display: flex;
            flex-direction: column;
            gap: 10px

        }
        .form-wrapper form input{
            padding: 10px;
            border: 1px solid lightgrey;
            width: 400px;
            border-radius: 7px;
        }
        .form-wrapper form button{
            padding: 10px;
            border: 1px solid lightgrey;
            background: crimson;
            color: white;
            width: 400px;
            border-radius: 7px;

        }
        .login-google-wrapper{
            display: flex;
            gap: 40px;
        }
        .google{
            border-radius: 7px;
            border: 1px solid lightgrey;
            padding: 7px;
        }
        .google a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
     <div class="form-wrapper">
<form action="" method="get">
    <h1>Login</h1>
    <input type="email" name="email" placeholder="Enter your email">
    <input type="password" name="email" placeholder="enter your Password" id="">
    <div class="login-google-wrapper">
        <div class="google">
            <a href="/login/google">Login with google</a>
        </div>
        <div class="google">
            <a href="">Login with facebook</a>
        </div>
    </div>
    <button>Login</button>
</form>
     </div>
</body>
</html>