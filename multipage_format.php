<!--
-----------------------------------------------------------------------------------------------

                                    PHP CV GENERATOR

    @author PIYUSH KUMAR
    @date 13 MARCH 2020
    @purpose Webpage to generate multipage CV for CV_GEN Portal



-----------------------------------------------------------------------------------------------
-->

<?php
session_start();
if(!isset($_SESSION['user']) || !isset($_SESSION['id']) )
{
    header("location:login.php");
}

//  print_r($_SERVER['DOCUMENT_ROOT']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV_GEN</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<h1 class="heading"><a href="index.php">ULTIMATE CV GENERATOR</a></h1>
    <button><a class="register"href="register.php">REGISTER</a></button>
    <form method="post"> 
    <input id="logout" type="submit" name="logout" value="logout"/><h5 class="logoutQ"><?php echo "Not ".$_SESSION['user']."?";?></h5>
    </form>

<div class="cv_format_choice_outer">
        <h2 style="text-align:center;margin-top:210px;color:yellow">SELECT YOUR RESUME FORMAT EXTENSION:</h2>
        <div class="cv_format_choice">
            <form method="post">
            <input type="submit" name="pdf" value="PDF">
            </form>
            <form method="post">
            <input type="submit" name="odt" value="ODT">
            </form>
            <form method="post">
            <input type="submit" name="doc" value="DOC">
            </form>
            <form method="post">
            <input type="submit" name="docx" value="DOCX">
            </form>
        </div>
    </div>

<?php
// $d = getcwd();
// $user = posix_getpwuid(posix_getuid());
// print_r($user);
// $home = getenv("HOME");
// echo $home;

$conn = new PDO("pgsql:host=localhost;dbname=cv_gen_piyush", "postgres", "root");
    $uid = $_SESSION['id'];
    $query1 = "select * from piyush_user_basic_information where user_id=$uid";

    foreach($conn->query($query1) as $data)
        {
            // $user_name = $data;
            $user_first_name = $data['first_name'];
            $user_last_name = $data['last_name'];
            $user_email = $data['email'];
            $user_mobile = $data['mobile'];
            $user_photo_uri = $data['photo'];
            $user_address = $data['address'];
            $user_city = $data['city'];
            $user_country = $data['country'];
            $user_objective = $data['objective'];
            // print_r($data);
        }
// echo $filename;
if(isset($_POST['logout']))
{
    // session_start();
    unset($_SESSION['user']);
    unset($_SESSION['id']);
    session_destroy();
        
    // header("location: login.php");
}

    $conn = new PDO("pgsql:host=localhost;dbname=cv_gen_piyush", "postgres", "root");
    $uid = $_SESSION['id'];
    $query1 = "select * from piyush_user_basic_information where user_id=$uid";

    foreach($conn->query($query1) as $data)
        {
            // $user_name = $data;
            $user_first_name = $data['first_name'];
            $user_last_name = $data['last_name'];
            $user_email = $data['email'];
            $user_mobile = $data['mobile'];
            $user_photo_uri = $data['photo'];
            $user_address = $data['address'];
            $user_city = $data['city'];
            $user_country = $data['country'];
            $user_objective = $data['objective'];
            // print_r($data);
        }

    $query2 = "SELECT * FROM piyush_user_work_experience where user_id=$uid";
    foreach($conn->query($query2) as $data)
        {
            $user_title[] =           $data['title'];
            $user_company[] =         $data['company'];
            $user_we_startmonth[] =   $data['startmonth'];
            $user_we_endmonth[] =     $data['endmonth'];
            $user_we_startyear[] =    $data['startyear'];
            $user_we_endyear[] =      $data['endyear'];
            $user_description[] =     $data['description'];
        }
    $query3 = "SELECT * FROM piyush_user_education where user_id=$uid";
    foreach($conn->query($query3) as $data)
        {
            $user_degree[]            =   $data['degree'];
            $user_stream[]           =   $data['stream'];
            $user_college[]           =   $data['college'];
            $user_ed_startmonth[]     =   $data['startmonth'];
            $user_ed_endmonth[]       =   $data['endmonth'];
            $user_ed_startyear[]      =   $data['startyear'];
            $user_ed_endyear []       =   $data['endyear'];
            $user_grade[]             =   $data['grade'];
        }
    $query4 = "SELECT * FROM piyush_user_languages where user_id=$uid";
    foreach($conn->query($query4) as $data)
        {
            $user_language[]  = $data['language'];
            $user_llevel[] = $data['level'];
        }
    $query5 = "SELECT * FROM piyush_user_skills where user_id=$uid";
    foreach($conn->query($query5) as $data)
        {
            $user_skill[] = $data['skill'];
            $user_level[] = $data['level'];
            // print_r($data);
        }
    ob_start();
    require('fpdf/fpdf.php');
    // require('fpdf/cellfit.php');
    $pdf = new FPDF('p', 'mm', 'A4');
    // $fpdf = new FPDF_CellFit();
    $pdf->SetMargins(7, 17, 7);
    // $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','B',28);

    $pdf->Image($user_photo_uri,15,15,50,50);

    $pdf->SetXY(75,25);
    $pdf->Cell(125,10,$user_first_name.' '.$user_last_name,0,0);
    $pdf->Rect(75,35.5,100,.6,'F');
    $pdf->SetFont('Times','',15);
    $pdf->SetXY(74,42);
    $pdf->MultiCell(120,7,$user_objective,0,1);
    $x = $pdf->getY();
    $pdf->SetFont('Times','B',17);
    $pdf->SetXY(10,79);
    $pdf->Cell(190,10,'EXPERIENCE',0,1);
    $pdf->Rect(10,$x+31,150,.6,'F');
    $EH =80;
    for($i=0;$i<count($user_title);$i++)
    {
        $pdf->SetFont('Times','B',20);
        $pdf->SetXY(8,$EH);
        $pdf->Cell(140,40,'<> ',0,0);
        $pdf->SetXY(20,$EH);
        $pdf->SetFont('Times','B',14);
        $pdf->Cell(140,40,$user_title[$i],0,1);
        $pdf->SetFont('Times','',11);
        $pdf->SetXY(20,$EH+25);
        $pdf->Cell(140,6,$user_we_startyear[$i].' - '.$user_we_endyear[$i],0,1);
        $pdf->SetXY(110,$EH+12);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,15,$user_company[$i],0,1);
        $pdf->SetXY(110,$EH+24);
        $pdf->SetFont('Times','',11);
        $pdf->MultiCell(0,5,$user_description[$i]."f that address is correct, here are three other things you can try:f that address is correct, here are three other things you can try:",0,1);
        $EH+=43;
    }

    $pdf->SetFont('Times','B',17);
    $pdf->SetXY(10,$EH+25);
    $pdf->Cell(190,10,'EDUCATION',0,1);
    $pdf->Rect(10,$EH+33,150,.6,'F');
    $x1 = $pdf->getY();
    $edx = $x1;
    for($i=0;$i<count($user_degree);$i++)
    {
        $pdf->SetFont('Times','B',20);
        $pdf->SetXY(8,$x1);
        $pdf->Cell(140,40,'<> ',0,0);
        $pdf->SetXY(20,$x1);
        $pdf->SetFont('Times','B',15);
        $pdf->Cell(140,40,$user_degree[$i],0,1);
        $pdf->SetFont('Times','',12);
        $pdf->SetXY(20,$x1+24);
        $pdf->Cell(140,6,$user_ed_startyear[$i].' - '.$user_ed_endyear[$i],0,1);
        $pdf->SetXY(110,$x1+10.5);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,15,$user_college[$i],0,1);
        $pdf->SetXY(110,$x1+24);
        $pdf->SetFont('Times','',11);
        $pdf->Cell(0,5,$user_stream[$i],0,1);
        $pdf->SetXY(110,$x1+30);
        $pdf->Cell(0,5,"GRADE : ".$user_grade[$i],0,1);
        $x1+=35;
        // $edx = $pdf->getY();
    }

    $pdf->SetFont('Times','B',17);
    $pdf->SetXY(10,$x1);
    $pdf->Cell(190,10,'CONTACT',0,1);
    $pdf->Rect(10,$x1+133,110,.6,'F');
    $pdf->Rect(10,25,150,.6,'F');
    $x2 = $pdf->getY();
    $pdf->SetFont('Times','',12);
    $pdf->SetX(13);
    $pdf->Cell(10,10,$user_address.", ".$user_city,0,1);
    $pdf->SetX(13);
    $pdf->Cell(10,3,$user_country,0,1);
    $pdf->SetXY(13,$x2+15);
    $pdf->Cell(10,10,$user_mobile,0,1);
    $pdf->SetXY(13,$x2+23);
    $pdf->Cell(10,10,$user_email,0,1);
    $x3  = $pdf->GetY();

    $pdf->SetFont('Times','B',17);
    $pdf->SetXY(10,$x3+20);
    $pdf->Cell(190,10,'SKILLS',0,1);
    $pdf->Rect(10,$x1+133,110,.6,'F');
    $pdf->Rect(10,$x3+28,150,.6,'F');
    for($i=0;$i<count($user_skill);$i++)
    {
        $pdf->SetX(13);
        $pdf->SetFont('Times','',13);
        $pdf->Cell(0,15,$user_skill[$i]."   -> ",0,0);
        $pdf->SetX(30);
        $pdf->Cell(0,15,$user_level[$i],0,1);
        $x4 = $pdf->getY();
    }

    $pdf->SetFont('Times','B',17);
    $pdf->SetXY(10,$x4+20);
    $pdf->Cell(190,10,'LANGUAGES',0,1);
    $pdf->Rect(10,$x4+28,150,.6,'F');
    for($i=0;$i<count($user_language);$i++)
    {
        $pdf->SetX(13);
        $pdf->SetFont('Times','',13);
        $pdf->Cell(0,15,$user_language[$i]."   -> ",0,0);
        $pdf->SetX(40);
        $pdf->Cell(0,15,$user_llevel[$i],0,1);
        $x4 = $pdf->getY();
    }
    if(isset($_POST['pdf']))
    {
    // $cd = getcwd();
    // $cd = $_SERVER['DOCUMENT_ROOT'];
    // $pdf->Output($filename,'F');
    $pdf->Output();
    ob_end_flush();
    }
if(isset($_POST['odt']))
{
    // $d = getcwd();
    // echo $d;
    $d= $d.'/'.$user_first_name;
    // $filename=$d."/test.pdf";
    // echo $d;
    $filename=$d.".odt";
    // echo $filename;
    echo"<h2 style='text-align:center;color:green'>Your CV has been saved in this module root directory ($filename)</h2>";
    $pdf->Output($filename,'F');
}

if(isset($_POST['doc']))
{
    // $d = getcwd();
    // echo $d;
    $d= $d.'/'.$user_first_name;
    // $filename=$d."/test.pdf";
    // echo $d;
    $filename=$d.".doc";
    // echo $filename;
    echo"<h2 style='text-align:center;color:green'>Your CV has been saved in this module root directory ($filename)</h2>";
    $pdf->Output($filename,'F');
}

if(isset($_POST['docx']))
{
    // $d = getcwd();
    // echo $d;
    $d= $d.'/'.$user_first_name;
    // $filename=$d."/test.pdf";
    // echo $d;
    $filename=$d.".docx";
    // echo $filename;
    echo"<h2 style='text-align:center;color:green'>Your CV has been saved in this module root directory ($filename)</h2>";
    $pdf->Output($filename,'F');
}
?>
    
</body>
</html>