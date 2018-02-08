<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .wrapper {
            margin: auto;
        }
        #player1 {
            float: left;
            margin-right: 10px;
            style="color: white"
        }
        #player2 {
            overflow: hidden;
            style="color: white";
        }
        .buton {
            clear: left;
        }
    </style>
    <title>Document</title>
</head>
<body style=" background-image: url(https://static.pexels.com/photos/110854/pexels-photo-110854.jpeg)">
    <h1 style="color: white" >Create a new account</h1>
    <div class="wrapper">
        <form method="POST" action="add_new_user.php">
            <div id="player1">
            <p style="color: white" class="player1">Player 1</p>
            <p class="player1"><input name="login1" type="text" placeholder="Login"/></p>
            <p class="player1"><input name="passwd1" type="password" placeholder="Enter a password"/></p>
            </div>
            <div id="player2">
            <p style="color: white" class="player2">Player 2</p>
            <p class="player2"><input name="login2" type="text" placeholder="Login"/></p>
            <p class="player2"><input name="passwd2" type="password" placeholder="Enter a password"/></p>
            </div>
            <p class="buton"><input name="submit" type="submit" value="OK"/></p>
        </form>
    </div>
<h1 style="color: white" >Log In</h1>
    <div class="wrapper">
        <form method="POST" action="log_in.php">
            <div id="player1">
                <p style="color: white" class="player1">Player 1</p>
                <p class="player1"><input name="login1" type="text" placeholder="Login"/></p>
                <p class="player1"><input name="passwd1" type="password" placeholder="Enter a password"/></p>
            </div>
            <div id="player2">
                <p style="color: white" class="player2">Player 2</p>
                <p class="player2"><input name="login2" type="text" placeholder="Login"/></p>
                <p class="player2"><input name="passwd2" type="password" placeholder="Enter a password"/></p>
            </div>
            <p class="buton"><input name="submit" type="submit" value="OK"/></p>
        </form>
    </div>
</body>
</html>