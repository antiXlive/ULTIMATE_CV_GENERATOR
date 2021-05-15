<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Gen</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<h1 class="heading" style='margin-top:10vh'><a href="index.php">ULTIMATE CV GENERATOR</a></h1>
<div style="border:1px solid #3FB7C2;width:max-content;display:flex;align-self:center;padding:15vh 15vw;margin:0 auto;margin-top:100px;border-radius:6px;box-sizing:border-box;text-align:center">
    <form method='post'>
        <div style='margin-bottom:10%'>
            <div>
                <p style='color:#3FB7C2;margin:0;text-align:left'>USERNAME :</p>
            </div>
            <div>
                <input style='border:1px solid #3FB7C2;width:200px;color:#FFF' type="text" name="username" required>
            </div>
        </div>
        <div>
            <div>
                <p style='color:#3FB7C2;margin:0;text-align:left'>PASSWORD :</p>
            </div>
            <div>
                <input style='border:1px solid #3FB7C2;width:200px;color:#FFF' type="password" name="password" required>
            </div>
        </div>
        <div style='margin-top:10vh;text-align:center;margin-bottom:30px'>
            <input style='background-color:#3FB7C2;color:#FFF;border:none;width:150px;height:35px;border-radius:2px;cursor:pointer' type='submit' name='login' value='Login'>
        </div>
            <a style='text-decoration:none;margin:0 auto;color:#ffeb3b;' href="register.php">REGISTER</a>        
    </form>
</div>

    <?php
    session_start();
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $userpassword = $_POST['password'];
        echo gettype($username);
        echo gettype($userpassword);
        $conn = new PDO('pgsql:host=localhost;dbname=cv_gen_piyush', 'postgres', 'root');
        $query1 = "select username,userpassword from piyush_registered_users";

        $current_users = array();
        $users_password = array();

        foreach($conn->query($query1) as $data)
        {
            $current_users[] = $data['username'];
            $users_password[] = $data['userpassword'];
        }
        if(array_search($username, $current_users) === FALSE)
        {
            echo"USER NOT REGISTERED";
            echo"<a href='register.php'>REGISTER</a>";
        }
        elseif(array_search($userpassword, $users_password) >= 0)
        {
            $query2 = "select id from piyush_registered_users where username='$username' and userpassword='$userpassword'";
            foreach($conn->query($query2) as $data)
            {
             $user_id = $data['id'];   
            }
            $_SESSION['id'] = $user_id;
            $_SESSION['user'] = $username;
            header("location: index.php");
        }
        elseif(array_search($userpassword, $users_password) === FALSE)
        {
            echo"WRONG PASSWORD";
        }
    }
    

    ?>
</body>
</html>