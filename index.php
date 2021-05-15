<!--
-----------------------------------------------------------------------------------------------

                                    PHP CV GENERATOR

    @author PIYUSH KUMAR
    @date 12 MARCH 2020
    @purpose Homepage for CV_GEN Portal



-----------------------------------------------------------------------------------------------
-->






<?php
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['id'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en" style="background-color: #1a1a1d;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV GEN_PIYUSH</title>
    <link rel="stylesheet" href="index.css">
    <script type="text/javascript" src="jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        function toggleForm(evt, form) {
            forms = document.getElementsByClassName("form");
            for (i = 0; i < forms.length; i++) {
                forms[i].style.display = "none";
            }
            tabs = document.getElementsByClassName("tab");
            for (i = 0; i < tabs.length; i++) {
                tabs[i].className = tabs[i].className.replace("active_form_tab", "");
            }
            document.getElementById(form).style.display = "block";
            evt.currentTarget.className += " active_form_tab";
            console.log(form);
        }
        $(document).ready(function() {
            var add_work = $("#add_work");
            var add_education = $('#add_education');
            var add_language = $('#add_language');
            var add_skill = $('#add_skill');

            var add_work_div = $('.WE');
            var add_education_div = $('.ED');
            var add_language_div = $('.LG');
            var add_skill_div = $('.SK');

            var i = 1;
            var j = 1;
            var k = 1;
            var l = 1;

            $(add_work).click(function(e) {
                i++;
                $(add_work_div).append('<div>Title:<input type="text" name="title[]"><br>company:<input type="text" name="company[]"><br>startmonth:<input type="number" min="1" max="12" value="3" name="startmonth[]"><br>endmonth:<input type="number" min="1" max="12" value="3" name="endmonth[]"><br>startyear:<input type="number" min="1900" max="2099" value="2019" name="startyear[]"><br>endyear:<input type="number" min="1900" max="2099" value="2020" name="endyear[]"><br>description:<input type="text" name="description[]"><br><input type="button" name="remove_work" class="remove" value="remove this work experience"></div>');
            });
            $(add_work_div).on('click', '.remove', function(e) {
                $(this).parent('div').remove();
                i--;
            });

            $(add_education).click(function(e) {
                j++;
                $(add_education_div).append('<div>Degree:<input type="text" name="degree[]" placeholder="Enter Full Name of Degree"><br>Stream:<input type="text" name="stream[]" placeholder="Enter Full Name of Branch or Stream"><br>College:<input type="text" name="college[]" placeholder="Enter Full Name of College"><br>startmonth:<input type="number" min="1" max="12" value="3" name="startmonth[]"><br> endmonth:<input type="number" min="1" max="12" value="3" name="endmonth[]"><br>startyear:<input type="number" min="1900" max="2099" value="2019" name="startyear[]"><br>endyear:<input type="number" min="1900" max="2099" value="2020" name="endyear[]"><br>grade:<input type="text" name="grade[]" placeholder="e.g. 9 CPI/95%"><br><input type="button" name="remove_education" class="remove" value="remove this education"></div>');
            });
            $(add_education_div).on('click', '.remove', function(e) {
                $(this).parent('div').remove();
                j--;
            });

            $(add_language).click(function(e) {
                k++;
                $(add_language_div).append('<div>Language:<input type="text" name="language[]" placeholder="e.g. French"><br>Level: <select id="languagelevel" name="languagelevel[]"><option value="A1">A1</option><option value="A2">A2</option><option value="B">B</option><option value="C">C</option></select><br><input type="button" name="remove_language" class="remove" value="remove this language"></div>');
            });
            $(add_language_div).on('click', '.remove', function(e) {
                $(this).parent('div').remove();
                k--;
            });

            $(add_skill).click(function(e) {
                l++;
                $(add_skill_div).append('<div>Skill:<input type="text" name="skill[]" placeholder="e.g. Javascript"><br>Level: <select id="skilllevel" name="skilllevel[]"><option value="Expert">Expert</option><option value="Experienced">Experienced</option><option value="Beginner">Beginner</option><option value="Novice">Novice</option></select><input type="button" name="remove_skill" class="remove" value="remove this skill"> </div>');
            });
            $(add_skill_div).on('click', '.remove', function(e) {
                $(this).parent('div').remove();
                l--;
            });
        });
    </script>
    <style>
        .active_form_tab {
            background-color: #0bb6c2;
        }

        .form {
            display: none;
        }
    </style>
</head>

<body>
    <h1 class="heading"><a href="index.php">ULTIMATE CV GENERATOR</a></h1>
    <!-- <button><a class="register" href="register.php">REGISTER</a></button> -->
    <form method="post" style="position:absolute;top:4vh;right:1vw">
        <input style="border:1px solid red;background:red;color:#FFF;width:100px;height:30px;border-radius:2px;cursor:pointer" id="logout" type="submit" name="logout" value="Log Out" />
        <!-- <h5 class="logoutQ"><?php echo "Not " . $_SESSION['user'] . "?"; ?></h5> -->
    </form>



    <?php
    // echo"<h1>WELCOME $_SESSION[user]</h1>";
    // echo $_SESSION["id"];
    // echo getcwd();
    ?>

    <div style='margin-top:10vh;display:flex;height:auto;flex-direction:row;padding: 0 3vw'>
        <div style="width:30%;display:flex;flex-direction:column">
            <div class='tab active_form_tab' onclick="toggleForm(event, 'bi')" style="width:100%;padding-left:5%;display:flex;align-items:center;border:1px solid #3FB7C2;height:20%;cursor:pointer;">
                <h4 style="color:#FFF;">Basic Information</h4>
            </div>
            <div class='tab' onclick="toggleForm(event, 'we')" style="width:100%;padding-left:5%;display:flex;align-items:center;border:1px solid #3FB7C2;height:20%;cursor:pointer;">
                <h4 style="color:#FFF;">Work Experience</h4>
            </div>
            <div class='tab' onclick="toggleForm(event, 'ed')" style="width:100%;padding-left:5%;display:flex;align-items:center;border:1px solid #3FB7C2;height:20%;cursor:pointer;">
                <h4 style="color:#FFF;">Education</h4>
            </div>
            <div class='tab' onclick="toggleForm(event, 'lg')" style="width:100%;padding-left:5%;display:flex;align-items:center;border:1px solid #3FB7C2;height:20%;cursor:pointer;">
                <h4 style="color:#FFF;">Languages</h4>
            </div>
            <div class='tab' onclick="toggleForm(event, 'sk')" style="width:100%;padding-left:5%;display:flex;align-items:center;border:1px solid #3FB7C2;height:20%;cursor:pointer;">
                <h4 style="color:#FFF;">Skills</h4>
            </div>
        </div>
        <div style="width:70%;min-height:50vh;border:1px solid #3FB7C2;text-align:center;padding-top:3vh;">
            <form id='bi' class='form' style="display: block;" method="POST" enctype="multipart/form-data">
                <div style='margin-bottom:1%'>
                    <div style="display:inline-block;width:100px">
                        <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>First Name :</p>
                    </div>
                    <div style="display:inline-block">
                        <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="first_name" required>
                    </div>
                </div>
                <div style='margin-bottom:1%'>
                    <div style="display:inline-block;width:100px">
                        <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Last Name :</p>
                    </div>
                    <div style="display:inline-block">
                        <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="last_name" required>
                    </div>
                </div>
                <div style='margin-bottom:1%'>
                    <div style="display:inline-block;width:100px">
                        <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Email :</p>
                    </div>
                    <div style="display:inline-block">
                        <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="email" required>
                    </div>
                </div>
                <div style='margin-bottom:1%'>
                    <div style="display:inline-block;width:100px">
                        <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Mobile :</p>
                    </div>
                    <div style="display:inline-block">
                        <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="mobile" required>
                    </div>
                </div>
                <div style='margin-bottom:1%'>
                    <div style="display:inline-block;width:100px">
                        <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Address :</p>
                    </div>
                    <div style="display:inline-block">
                        <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="address" required>
                    </div>
                </div>
                <div style='margin-bottom:1%'>
                    <div style="display:inline-block;width:100px">
                        <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>City :</p>
                    </div>
                    <div style="display:inline-block">
                        <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="city" required>
                    </div>
                </div>
                <div style='margin-bottom:1%'>
                    <div style="display:inline-block;width:100px">
                        <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Country :</p>
                    </div>
                    <div style="display:inline-block">
                        <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="country" required>
                    </div>
                </div>
                <div style='margin-bottom:1%'>
                    <div style="display:inline-block;width:100px">
                        <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Objective :</p>
                    </div>
                    <div style="display:inline-block">
                        <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="objective" required>
                    </div>
                </div>
                <div style='margin-top:5vh;text-align:center;margin-bottom:30px'>
                    <input style='background-color:#3FB7C2;color:#FFF;border:none;width:150px;height:35px;border-radius:2px;cursor:pointer' type='submit' name='basic_information_form' value='SUBMIT'>
                </div>
            </form>

            <form id='we' class='form' method="POST" enctype="multipart/form-data">
                <div class="WE">
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Title :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="title[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Company :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="company[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Start Month :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="startmonth[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Start Year :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="startyear[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>End Month :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="endmonth[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>End Year :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="endyear[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Description :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="description[]" required>
                        </div>
                    </div>
                </div>
                <div style='margin-top:5vh;text-align:center;margin-bottom:30px'>
                    <input style='background-color:#3FB7C2;color:#FFF;border:none;width:150px;height:35px;border-radius:2px;cursor:pointer' type='submit' name='basic_information_form' value='SUBMIT'>
                </div>
                <input type="button" name="add_work" id="add_work" value="Add another work experience">
            </form>
            <form id='ed' class='form' method="POST" enctype="multipart/form-data">
                <div class="WE">
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Degree :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="title[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Stream :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="company[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>College :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="startmonth[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Start Month :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="startmonth[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Start Year :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="startyear[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>End Month :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="endmonth[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>End Year :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="endyear[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Grade :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="description[]" required>
                        </div>
                    </div>
                </div>
                <div style='margin-top:5vh;text-align:center;margin-bottom:30px'>
                    <input style='background-color:#3FB7C2;color:#FFF;border:none;width:150px;height:35px;border-radius:2px;cursor:pointer' type='submit' name='basic_information_form' value='SUBMIT'>
                </div>
                <input type="button" name="add_work" id="add_work" value="Add another work experience">
            </form>
            <form id='lg' class='form' method="POST" enctype="multipart/form-data">
                <div class="WE">
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Language :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="title[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Level :</p>
                        </div>
                        <div style="display:inline-block">
                            <select id="languagelevel" name="languagelevel[]" style="width:200px;color:#000">
                                <option style="color:#000" value="A1">A1</option>
                                <option style="color:#000" value="A2">A2</option>
                                <option style="color:#000" value="B">B</option>
                                <option style="color:#000" value="C">C</option>
                            </select>
                        </div>
                    </div>
                    <div style='margin-top:5vh;text-align:center;margin-bottom:30px'>
                        <input style='background-color:#3FB7C2;color:#FFF;border:none;width:150px;height:35px;border-radius:2px;cursor:pointer' type='submit' name='basic_information_form' value='SUBMIT'>
                    </div>
                    <input type="button" name="add_work" id="add_work" value="Add another work experience">
                </div>
            </form>
            <form id='sk' class='form' method="POST" enctype="multipart/form-data">
                <div class="WE">
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Language :</p>
                        </div>
                        <div style="display:inline-block">
                            <input style='border:1px solid #3FB7C2;width:200px;color:#000;display:inline-block' type="text" name="title[]" required>
                        </div>
                    </div>
                    <div style='margin-bottom:1%'>
                        <div style="display:inline-block;width:100px">
                            <p style='color:#3FB7C2;margin:0;text-align:left;display:inline-block'>Skill :</p>
                        </div>
                        <div style="display:inline-block">
                            <select id="skilllevel" name="skilllevel[]" style="width:200px;color:#000">
                                <option style="color:#000" value="Expert">Expert</option>
                                <option style="color:#000" value="Experienced">Experienced</option>
                                <option style="color:#000" value="Beginner">Beginner</option>
                                <option style="color:#000" value="Novice">Novice</option>
                            </select>
                        </div>
                    </div>
                    <div style='margin-top:5vh;text-align:center;margin-bottom:30px'>
                        <input style='background-color:#3FB7C2;color:#FFF;border:none;width:150px;height:35px;border-radius:2px;cursor:pointer' type='submit' name='basic_information_form' value='SUBMIT'>
                    </div>
                    <input type="button" name="add_work" id="add_work" value="Add another work experience">
                </div>
            </form>
        </div>
    </div>

    <div class="cv_format_choice_outer" style="margin-top: 10vh;">
        <h3>SELECT YOUR RESUME FORMAT:</h3>
        <div style="display: flex;flex-wrap:wrap;justify-content:center;align-self:center;width:90%;margin:0 auto">
            <a href="onepage_format.php" style="text-decoration: none;">
                <div class="cv_format_choice_block" style="border-radius: 5px;padding:10% 5%">
                    <h4 style="color:#0bb6c2">ONE PAGE</h4>
                    <p style="font-size:13px;color:red;">Fill up all the details before accessing this</p>
                </div>
            </a>
            <a href="multipage_format.php" style="text-decoration: none;">
                <div class="cv_format_choice_block" style="border-radius: 5px;padding:10% 5%">
                    <h4 style="color:#0bb6c2">MULTI PAGE</h4>
                    <p style="font-size:13px;color:red;">Fill up all the details before accessing this</p>
                </div>
            </a>
            <a href="#" style="text-decoration: none;">
                <div class="cv_format_choice_block" style="border-radius: 5px;padding:10% 5%">
                    <h4 style="color:#0bb6c2">EUROPASS</h4>
                    <p style="font-size:13px;color:#1ccf76;">THIS FEATURE IS IN DEVELOPMENT PHASE</p>
                </div>
            </a>
            <a href="#" style="text-decoration: none;">
                <div class="cv_format_choice_block" style="border-radius: 5px;padding:10% 5%">
                    <h4 style="color:#0bb6c2">TRADITIONAL</h4>
                    <p style="font-size:13px;color:#1ccf76;">THIS FEATURE IS IN DEVELOPMENT PHASE</p>
                </div>
            </a>
        </div>
    </div>

    <!-- <div class="cv_format_choice_outer">
        <h2>UPDATE YOUR DETAILS:</h2>
        <div class="cv_format_choice_outer">
            <div class="cv_format_choice">
                <form method="post">
                    <input type="submit" name="ubasic" value="Basic Information">
                </form>
                <form method="post">
                    <input type="submit" name="uwork" value="Work Experience">
                </form>
                <form method="post">
                    <input type="submit" name="ueducation" value="Education">
                </form>
                <form method="post">
                    <input type="submit" name="ulanguage" value="Languages">
                </form>
                <form method="post">
                    <input type="submit" name="uskill" value="SKILLS">
                </form>
            </div>
        </div>
    </div> -->


    <?php
    $conn = new PDO("pgsql:host=localhost;dbname=cv_gen_piyush", "postgres", "root");
    if (isset($_POST['logout'])) {
        session_start();
        unset($_SESSION['user']);
        unset($_SESSION['id']);
        session_destroy();

        // header("location: login.php");
    }
    if (isset($_FILES['photo'])) {
        $errors = array();
        $file_name = $_FILES['photo']['name'];
        // $file_size =$_FILES['photo']['size'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        // $file_type=$_FILES['photo']['type'];
        // print_r($_FILES['photo']);
        $cd = getcwd();
        // echo $cd;
        mkdir("$cd/user_photos/", 0777);
        $dir = "$cd/user_photos/";
        move_uploaded_file($file_tmp, $dir . $file_name);
        // echo $dir.$file_name;
        $photo_uri = $dir . $file_name;;
    }

    if (isset($_POST['basic_information_form'])) {
        $id = $_SESSION['id'];
        $first_name  = $_POST['first_name'];
        $last_name   = $_POST['last_name'];
        $email       = $_POST['email'];
        $mobile      = $_POST['mobile'];
        $address     = $_POST['address'];
        $city        = $_POST['city'];
        $country     = $_POST['country'];
        $objective  = $_POST['objective'];

        // print_r($photo_uri);
        // print_r($first_name);
        // print_r($last_name);
        // print_r($email);
        // print_r($mobile);
        // print_r($address);
        // print_r($city);
        // print_r($country);
        // print_r($objective);

        $query1 = "INSERT INTO piyush_user_basic_information values($id, '$first_name', '$last_name', '$email', $mobile, '$photo_uri', '$address', '$city', '$country', '$objective')";
        // echo $query1;
        foreach ($conn->query($query1) as $data) {
        }
    }

    if (isset($_POST['work_experience_form'])) {
        $id = $_SESSION['id'];
        $title = $_POST['title'];
        $company = $_POST['company'];
        $we_startmonth = $_POST['startmonth'];
        $we_endmonth = $_POST['endmonth'];
        $we_startyear = $_POST['startyear'];
        $we_endyear = $_POST['endyear'];
        $description = $_POST['description'];

        print_r($id);
        print_r($title);
        print_r($company);
        print_r($we_startmonth);
        print_r($we_endmonth);
        print_r($we_startyear);
        print_r($we_endyear);
        print_r($description);

        echo count($title);

        for ($i = 0; $i < count($title); $i++) {
            echo $i;
            $query2 = "INSERT INTO piyush_user_work_experience values($id, '$title[$i]', '$company[$i]', $we_startmonth[$i], $we_endmonth[$i], $we_startyear[$i], $we_endyear[$i], '$description[$i]')";
            echo $query2;
            foreach ($conn->query($query2) as $data) {
            }
        }

        // print_r($title);
        // print_r($company);
        // print_r($startmonth);
        // print_r($endmonth);
        // print_r($startyear);
        // print_r($endyear);
        // print_r($description);
    }

    if (isset($_POST['education_form'])) {
        $id = $_SESSION['id'];
        $degree      = $_POST['degree'];
        $stream      = $_POST['stream'];
        $college     = $_POST['college'];
        $ed_startmonth  = $_POST['startmonth'];
        $ed_endmonth    = $_POST['endmonth'];
        $ed_startyear   = $_POST['startyear'];
        $ed_endyear     = $_POST['endyear'];
        $grade       = $_POST['grade'];

        // print_r($id);
        // print_r($degree);
        // print_r($stream);
        // print_r($college);
        // print_r($ed_startmonth);
        // print_r($ed_endmonth);
        // print_r($ed_startyear);
        // print_r($ed_endyear);
        // print_r($grade);

        for ($i = 0; $i < count($degree); $i++) {
            $query3 = "INSERT INTO piyush_user_education values($id, '$degree[$i]', '$stream[$i]', '$college[$i]', $ed_startmonth[$i], $ed_endmonth[$i], $ed_startyear[$i], $ed_endyear[$i], '$grade[$i]')";
            foreach ($conn->query($query3) as $data) {
            }
        }
    }

    if (isset($_POST['language_form'])) {
        $id = $_SESSION['id'];
        $language  = $_POST['language'];
        $llevel = $_POST['languagelevel'];

        // print_r($language);
        // print_r($llevel);

        for ($i = 0; $i < count($language); $i++) {
            $query4 = "INSERT INTO piyush_user_languages values($id, '$language[$i]', '$llevel[$i]')";
            foreach ($conn->query($query4) as $data) {
            }
        }
    }

    if (isset($_POST['skill_form'])) {
        $id = $_SESSION['id'];
        $skill  = $_POST['skill'];
        $slevel  = $_POST['skilllevel'];

        // print_r($skill);
        // print_r($slevel);

        for ($i = 0; $i < count($slevel); $i++) {
            $query5 = "INSERT INTO piyush_user_skills values($id,'$skill[$i]', '$slevel[$i]')";
            foreach ($conn->query($query5) as $data) {
            }
        }
    }

    if (isset($_POST['ubasic'])) {
        $uid = $_SESSION['id'];
        $query1 = "SELECT * from piyush_user_basic_information where user_id=$uid";
        foreach ($conn->query($query1) as $data) {
            // print_r($data);
            $ufirst_name  = $data['first_name'];
            // echo $ufirst_name;
            $last_name   = $data['last_name'];
            $email       = $data['email'];
            $mobile      = $data['mobile'];
            $address     = $data['address'];
            $city        = $data['city'];
            $country     = $data['country'];
            $objective  = $data['objective'];
        }
        echo "<div class='basic_information' id='basic_information'>";
        echo "<h3>Basic Information</h3><br>";
        echo "<form method='POST' enctype='multipart/form-data'>";
        echo "first name:<input type='text' name='first_name' value='$ufirst_name'><br>";
        echo "last name:<input type='text' name='last_name' value='$last_name'><br>";
        echo "email:<input type='email' name='email' value='$email'><br>";
        echo "mobile:<input type='text' name='mobile' value='$mobile'><br>";
        echo "photo:<input type='file'name='photo'/><br>";
        echo "address:<input type='text' name='address' value='$address'><br>";
        echo "city:<input type='text' name='city' value='$city'><br>";
        echo "country:<input type='text' name='country' value='$country'><br>";
        echo "objective:<input type='text' name='objective' value='$objective' placeholder='Enter your Short Objective'><br>";
        echo "<input type='submit' class='form_submit_button' name='ubasic_information_form' value='UPDATE'>";
        echo "</form>";
        echo "</div>";

        // if(isset($_POST['ubasic_information_form']))
        // {
        //     $query1 = "SELECT * from piyush_user_basic_information";   
        // }


    }
    ?>

</body>

</html>