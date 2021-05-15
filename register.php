<!DOCTYPE html>
<html lang="en" style="background-color: #1a1a1d;">
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
            <input style='background-color:#3FB7C2;color:#FFF;border:none;width:150px;height:35px;border-radius:2px;cursor:pointer' type='submit' name='register' value='Register'>
        </div>
            <a style='text-decoration:none;margin:0 auto;color:#ffeb3b;' href="login.php">LOGIN</a>        
    </form>
</div>

    <?php
    if(isset($_POST['register']))
    {
        $user = $_POST['username'];
        $user_password = $_POST['password'];

        $conn = new PDO('pgsql:host=localhost;dbname=cv_gen_piyush', 'postgres', 'root');
        $query1 = "select username from piyush_registered_users";
        $registered_users = array();

        foreach($conn->query($query1) as $data)
        {
            $registered_users[] = $data['username'];
        }

        $spam_check = array_search($user,$registered_users);

        if($spam_check == FALSE)
        {
            $query2 = "INSERT into piyush_registered_users(username, userpassword) values('$user','$user_password')";
            foreach($conn->query($query2) as $data)
            {}
            echo"USER REGISTERED";
            echo"<a href='login.php'>LOGIN</a>";
        }
        else
        {
            echo"USER ALREADY REGISTERED";
        }
    }
    ?>
</body>
</html>