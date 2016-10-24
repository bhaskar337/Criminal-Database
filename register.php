<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="register.css">
        <link href="https://fonts.googleapis.com/css?family=Allerta|Nunito" rel="stylesheet">
    </head>
<body>
<?php

    $incorrect=0;

if (isset($_POST["submit"])){


    $data_missing = array(); //ARRAY TO KEEP NOTE OF ALL THE MISSING FIELDS


    /********************** FIRST NAME **********************/
    
    if (empty($_POST['fname'])){
 
        // Adds name to data missing array
        $data_missing[] = 'First Name';
 
    } 
    else {
 
        // Trim white space from the name and store the name
        // To convert str to lower Case
        // Then to convert 1st character to upper case
        $fname =ucwords(strtolower(trim($_POST['fname'])));
 
    }

    /********************** LAST NAME **********************/
 
    if (empty($_POST['lname'])){
 
        // Adds name to array
        $data_missing[] = 'Last Name';
 
    } 
    else {
 
        // Trim white space from the name and store the name
        $lname =ucwords(strtolower(trim($_POST['lname'])));
 
    }

    /********************** ID **********************/

    if (empty($_POST['id'])){
 
        // Adds name to array
        $data_missing[] = 'Batch ID';
 
    } 
    else {
 
        // Trim white space from the name and store the name
        $id = trim($_POST['id']);
 
    }

    /********************** EMAIL **********************/

    if (empty($_POST['email'])){
 
        // Adds name to array
        $data_missing[] = 'Email';
 
    } 
    else {
 
        // Trim white space from the name and store the name
        $email = trim($_POST['email']);
 
    }

    /********************** RANK **********************/

    if (empty($_POST['rank'])){
 
        // Adds name to array
        $data_missing[] = 'Rank';
 
    } 
    else {
 
        // Trim white space from the name and store the name
        $rank = trim($_POST['rank']);
 
    }

    /********************** PASSWORD **********************/

    if (empty($_POST['password'])){
 
        // Adds name to array
        $data_missing[] = 'Password';
 
    } 
    else {
 
        $password = $_POST['password'];
 
    }

    /********************** RE PASSWORD **********************/

    if (empty($_POST['repassword'])){
 
        // Adds name to array
        $data_missing[] = 'Re-enter Password';
 
    } 
    else {
 
        $repassword = $_POST['repassword'];
 
    }

    if (empty($data_missing)){ //IF ALL THE DATA HAS BEEN ENTERED


        $isPasswordOk=0; // 0=password not ok, 1=password ok

        if(strlen($password)>5){  // CHECK IF PASSWORD LONG ENOUGH

            if(strcmp($password,$repassword)==0){ //CHECKS IF THE PASSWORD MATCH

                 $options = [
                  'cost' => 10
                ];
                $password= password_hash($password, PASSWORD_BCRYPT, $options);

                //TO VERIFY password_verify('Entered passwrod', $password)

                $isPasswordOk=1;
            }
            else  $incorrect=1;
        }
        else $incorrect=2;

        
        if ($isPasswordOk==1) { 

            /********************** INSERTING INTO THE DATABASE **********************/
        
            require_once('../connect.php');
            
            $query = "INSERT INTO officer VALUES (?,?,?,?,?,?)";
            
            $stmt = mysqli_prepare($dbc, $query);
            
            mysqli_stmt_bind_param($stmt, "sssiss", $id, $fname, $lname, $rank, $email, $password);
            
            mysqli_stmt_execute($stmt);
            
            $affected_rows = mysqli_stmt_affected_rows($stmt);
            
            if($affected_rows == 1){
                
                session_start();

                $_SESSION["id"] = $id;
                header("Location: http://localhost:80/index_log.php");
                exit();
                
            } 
            else {
                $incorrect=3;   
            }

            mysqli_stmt_close($stmt);
                
            mysqli_close($dbc);
        }
        
    } 
    else { //IF SOME DATA IS NOT ENTERED
            $incorrect=4;
    }   
 }
?>
        <div class="navbar">
        <ul>
            <li><a href="http://localhost:80/index.html">Home</a></li>
            <li><a href="#">Criminal Records</a></li>
            <li><a href="#">About</a></li>
            <li style="float:right"><a href="http://localhost:80/login.php">Login</a></li>
            <li style="float:right"><a id="active" href="">Register</a></li>
        </ul>
        </div>
        <div class="bdy">
        <h1>C-Dex Registration</h1>

        <form id="name" action="http://localhost:80/register.php" method="post">
            <div>
                <span class="fn">First Name : </span> <input type="text" name="fname"  value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ?>" >
            </div>
            <div>
                <span class="ln">Last Name : </span><input type="text" name="lname" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ?>">
            </div>
            <div>
                <span class="email">Email-id : </span> <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
            </div>
            <div>
                <span class="rank">Rank : </span> <input type="text" name="rank" value="<?php echo isset($_POST['rank']) ? $_POST['rank'] : '' ?>">
            </div>
            <div>
                <span class="bnum">Badge No. : </span> <input type="text" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id '] : '' ?>">
            </div>
            <div>
                <span class="pass">Password : </span> <input type="password" name="password">
            </div>
            <div>
                <span class="rpass">Re-enter password : </span> <input type="password" name="repassword">
            </div>
            <div id="error_reg">
                <?php
                if ($incorrect==1){
                    echo "Passwords do not match";
                }
                else if ($incorrect==2){
                    echo "Password should be atleast 6 character long";
                }
                else if ($incorrect==3){
                    echo "This batch ID has already been regestered";
                }
                else if ($incorrect==4){
                    echo "You need to enter all the fields";
                }
                ?>
            </div>
            <div id="submit">
                <input type="submit" name="submit" value="Register">
            </div>
        </form>
        </div>
 
</body>
</html>