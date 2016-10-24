<html>
    <head>
        <title>Log in</title>
        <link rel="stylesheet" type="text/css" href="register.css">
        <link href="https://fonts.googleapis.com/css?family=Allerta|Nunito" rel="stylesheet">
    </head>
<body>
<?php

$incorrect=0; // 1=username/password not entered 2= wrong username/password

if (isset($_POST["submit"])){

    if ((empty($_POST['id'])||empty($_POST['password']))==0) { //IF ALL THE DATA HAS BEEN ENTERED

            $id = trim($_POST['id']);
        
            require_once('../connect.php');
            
            $query = "SELECT officer_password from officer where officer_id=$id";
            
            $response = mysqli_query($dbc, $query);

            if (!is_bool($response)){

                $row=mysqli_fetch_row($response);
                
                $correctPassword=$row[0];

                if (password_verify($_POST['password'],$correctPassword)){

                    session_start();

                    $_SESSION["id"] = $id;
                    header("Location: http://localhost:80/index_log.php");
                    exit();
                }
                else{
                    $incorrect=2;
                }
                mysqli_close($dbc);  
            }
            else $incorrect=1;  
    }
    else $incorrect=1;
}
?>
    <div class="navbar">
    <ul>
        <li><a href="http://localhost:80/index.html">Home</a></li>
        <li><a href="http://localhost:80/records.php">Criminal Records</a></li>
        <li><a href="#">About</a></li>
        <li style="float:right"><a id="active" href="#">Login</a></li>
        <li style="float:right"><a href="http://localhost:80/register.php">Register</a></li>
    </ul>
    </div>
    <div class="main">
        <h1 id="login">C-Dex Login</h1>
        <form id="name" action="http://localhost:80/login.php" method="post">
            <div class="ip">
                <div class="box">
                    Badge ID : <input type="text" name="id"  value="<?php echo isset($_POST['id']) ? $_POST['id'] : '' ?>">
                </div>
                <div class="box">
                    Password : <input type="password" name="password" id="password">
                </div>
            </div>
            <div id="error">
            <?php

                if ($incorrect==1){
                    echo "Please enter your username and password";
                }
                else if ($incorrect==2){
                    echo "Incorrect username or password";
                }
            ?>
            </div>
            <div class="box" id="lgn">
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
    </div>
 
</body>
</html>