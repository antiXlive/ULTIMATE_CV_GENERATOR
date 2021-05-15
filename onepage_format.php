<!--
-----------------------------------------------------------------------------------------------

                                    PHP CV GENERATOR

    @author PIYUSH KUMAR
    @date 12 MARCH 2020
    @purpose Webpage to generate singlepage CV for CV_GEN Portal



-----------------------------------------------------------------------------------------------
-->


<?php
session_start();
if(!isset($_SESSION['user']) || !isset($_SESSION['id']) )
{
    header("location:login.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV_GEN</title>
    <link rel="stylesheet" href="index.css">
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
$d = getcwd();

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
    $pdf->SetMargins(7, 17, 5);
    // $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','B',24);

    // HEADER

    $pdf->Cell(59 ,5,$user_first_name,0,0);
    $pdf->SetFont('Times','',18);
    $pdf->Cell(130 ,5,"OBJECTIVE",0,1);
    $pdf->Rect(66,22.5,125,0.11,'F');
    $pdf->SetXY(7,27);
    $pdf->SetFont('Times','B',24);
    // $pdf->SetXY(8,20);
    $pdf->Cell(57,3,$user_last_name,0,0);

    // $pdf->SetFont('Times','',18);
    // $pdf->Cell(130 ,5,"OBJECTIVE",1,1);
    // 
    $pdf->SetFont('Times','',14);
    $pdf->MultiCell(130,6,$user_objective,0,1);
    $multicellH = $pdf->getY();


    $pdf->Image($user_photo_uri,7,40,50,50);

    $pdf->SetFont('Times','',16);
    $pdf->setY($multicellH+55);
    $pdf->Cell(130 ,20,"CONTACT",0,1);
    $pdf->Rect(7,$multicellH+68,50,0.11,'F');
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(0,5,"Address:",0,1);
    $pdf->SetFont('Times','',11);
    $pdf->Cell(9,8,$user_address,0,1);
    $pdf->Cell(0,0,$user_city.', '.$user_country,0,1);

    $pdf->SetFont('Times','B',12);
    $pdf->Cell(130,23,"Phone:",0,1);
    $pdf->SetFont('Times','',11);
    $pdf->Cell(0,-10,$user_mobile,0,1);

    $pdf->SetFont('Times','B',12);
    $pdf->Cell(0,23,"Email:",0,1);
    $pdf->SetFont('Times','',11);
    $pdf->Cell(0,-10,$user_email,0,1);

    $pdf->SetFont('Times','',16);
    $pdf->Cell(0,30,"LANGUAGES:",0,1);
    $pdf->Rect(7,171.5,50,0.11,'F');
    $pdf->SetFont('Times','',12);
    $LH=180;
    foreach($user_language as $ul)
    {
        $pdf->SetXY(7,$LH);
        $pdf->Cell(0,-5,$ul,0,1);
        $LH+=7;
    }



    $pdf->SetFont('Times','',18);
    $pdf->SetXY(65,$multicellH+10);
    $pdf->Cell(130 ,20,"WORK EXPERIENCE",0,1);
    $pdf->Rect(66,$multicellH+24,125,0.11,'F');

    // $pdf->SetXY(7,90);
    // $pdf->Cell(57,113,'jkbkjbkj',1,0);
    $pdf->SetFont('Times','',14);
    $expH = 8;
    $expH1 = 6;
    // $pdf->SetXY(130,53);
    for($i=0;$i<count($user_title);$i++)
    {
        // $pdf->SetXY(65,$multicellH);
        $pdf->SetFont('Times','',15);
        $pdf->SetX(67);
        $pdf->Cell(90,$expH,$user_company[$i].', '.$user_title[$i].', '.$user_we_startyear[$i].'-'.$user_we_endyear[$i],0,1);
        $pdf->SetFont('Times','',13);
        $pdf->SetXY(75,$expH+70);
        $pdf->MultiCell(130,$expH1,$user_description[$i],0,1);
        $expH+=30;
        // $expH1+=10;
        $x1 = $pdf->getY();
    }

    $pdf->SetFont('Times','',18);
    $pdf->SetX(65);
    $pdf->Cell(130 ,30,"EDUCATION",0,1);
    $pdf->Rect(66,$x1+20,125,0.11,'F');
    $h=32;

    for($i=0;$i<count($user_degree);$i++)
    {
        // $h = 40;
        // $pdf->SetFont('Times','B',10);
        $pdf->SetFont('Times','',9);
        $pdf->SetX(185);
        $pdf->Cell(0,-1,$user_ed_startyear[$i].'-'.$user_ed_endyear[$i],0,1);
        $pdf->SetX(65);
        $pdf->SetFont('Times','',14);
        $pdf->Cell(0,10,$user_degree[$i].', '.$user_college[$i],0,1);
        $pdf->SetFont('Times','',10);
        $pdf->SetX(65);
        $pdf->Cell(0,.1,'GRADE : '.$user_grade[$i],0,1);
        $pdf->SetX(65);
        $pdf->Cell(0,8,$user_stream[$i],0,1);
        $h+=18;
        $x2 = $pdf->getY();
    }

    $pdf->SetFont('Times','',18);
    $pdf->SetX(65);
    $pdf->Cell(130 ,30,"ADDITIONAL SKILLS",0,1);
    $pdf->Rect(66,$x2+19,125,0.11,'F');
    for($i=0;$i<count($user_skill);$i++)
    {
        $pdf->SetX(65);
        // $pdf->SetFont('Times','B',14);
        $pdf->SetFont('Times','',14);
        $pdf->Cell(0,8,$user_skill[$i].'    ->  '.$user_level[$i],0,1);
        $x3 = $pdf->getY();
    }

    $pdf->SetFont('Times','',18);
    $pdf->SetX(65);
    $pdf->Cell(130 ,30,"REFERENCES",0,1);
    $pdf->Rect(66,$x3+19,125,0.11,'F');



    // $pdf->Cell(0,98,
    // HEADER
    // $pdf->Cell(0,10,$user_first_name." ".$user_last_name);
    // $pdf->SetFont('Times','',10);
    // $pdf->Cell(0,10,$user_email,0,1,'R');
    // $pdf->SetXY(170,10);
    // // $pdf->SetY(7.5);
    // $pdf->Cell(0,10,$user_email,0,1,'R');
    // $pdf->SetXY(170,15);
    // $pdf->Cell(0,10,$user_email,0,1,'R');
    // $pdf->SetXY(5,12);
    // $pdf->Cell(0,10,'IIIT Senapati, Manipur',0,1);
    // $pdf->SetXY(5,16);
    // $pdf->Cell(0,10,$user_city.", ".$user_country." | ".$user_mobile,0,1);
    // // HEADER END


    // // EDUCATION
    // $pdf->Cell(0,10,"EDUCATION",0,1);
    // $pdf->Rect(6,33.5,130,0.11,'F');
    // $pdf->Cell(0,-10,"LANGUAGE",0,0,'R');
    // $pdf->Rect(146,33.5,60,0.11,'F');
    // $h=32;
    // // $h1=72;
    // for($i=0;$i<count($user_degree);$i++)
    // {
    //     // $h = 40;
    //     $pdf->SetXY(5,$h);
    //     $pdf->SetFont('Times','B',10);
    //     $pdf->Cell(0,10,$user_degree[$i].', '.$user_college[$i].', '.$user_ed_startyear[$i].'-'.$user_ed_endyear[$i],0,1);
    //     $pdf->SetFont('Times','',10);
    //     $pdf->Cell(0,.1,$user_grade[$i],0,1);
    //     $pdf->Cell(0,8,$user_stream[$i],0,1);
        
    //     $h+=18;
    //     $pdf->SetXY(5,$h);
    //     $pdf->SetFont('Times','B',10);
    //     $pdf->Cell(0,10,$user_degree[$i].', '.$user_college[$i].', '.$user_ed_startyear[$i].'-'.$user_ed_endyear[$i],0,1);
    //     $pdf->SetFont('Times','',10);
    //     $pdf->Cell(0,.1,$user_grade[$i],0,1);
    //     $pdf->Cell(0,8,$user_stream[$i],0,1);
        
    //     $h+=18;

    // }
    // // EDUCATION END

    // $pdf->SetFont('Times','',10);

    // // LANGUAGE
    
    // // LANGUAGE END

    // // EXPERIENCE
    // // $EXMH =;
    // $pdf->Cell(0,15,"EXPERIENCE",0,1,'L');
    // $pdf->Rect(6,$h+10,130,.1,'F');

    // $expH = $h+10;
    // for($i=0;$i<count($user_title);$i++)
    // {
    //     $pdf->SetXY(5,$expH);
    //     $pdf->SetFont('Times','B',10);
    //     $pdf->Cell(0,10,$user_company[$i].', '.$user_title[$i].', '.$user_we_startyear[$i].'-'.$user_we_endyear[$i],0,1);
    //     $pdf->SetFont('Times','',10);
    //     $pdf->Cell(0,.01,$user_description[$i],0,1);
    //     $expH+=22;

    //     $pdf->SetXY(5,$expH);
    //     $pdf->SetFont('Times','B',10);
    //     $pdf->Cell(0,10,$user_company[$i].', '.$user_title[$i].', '.$user_we_startyear[$i].'-'.$user_we_endyear[$i],0,1);
    //     $pdf->SetFont('Times','',10);
    //     $pdf->Cell(0,.01,$user_description[$i],0,1);
    //     $expH+=22;
    // }
    // // EXPERIENCE END
    

    // $PMH = $expH+8;
    // // PROJECT START
    // $pdf->Cell(0,35,"PROJECT",0,1);
    // $pdf->Rect(6,$PMH,130,.1,'F');

    // // PROJECT END

    
    // // EDUCATION
    // // $pdf->Cell(0,10,"PROJECT",0,1);
    // // $pdf->Rect(5,$x,130,0.1,'F');
    if(isset($_POST['pdf']))
    {
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
    if(isset($_POST['logout']))
    {
        // session_start();
        unset($_SESSION['user']);
        unset($_SESSION['id']);
        session_destroy();
            
        // header("location: login.php");
    } 






        // echo "<h3>USER BASIC INFORMATION</h3> <br>";

        // echo "FIRST NAME:". $user_first_name."<br>";
        // echo "LAST NAME:".$user_last_name."<br>";
        // echo "EMAIL:".$user_email."<br>";
        // echo "MOBILE:".$user_mobile."<br>";
        // echo "ADDRESS:".$user_address."<br>";
        // echo "CITY:".$user_city."<br>";
        // echo "COUNTRY;".$user_country."<br>";
    
        // $query1 = "SELECT * from piyush_user_work_experience";

    //     $pdf = '<div class="main_container">
    //     <div style="float:left;padding-left:20px;height:150px;width:100%;border:1px solid black;">
    //         <h2 style="line-height:50px;"><'.$user_first_name. ' '  .$user_last_name.'</h2>
    //         <h5 style="line-height:4px;"><'/$user_address . ', ' . $user_city.'</h5>
    //         <h5 style="line-height:4px;"><'.$user_address . ', ' . $user_country . ' | ' . $user_mobile.'</h5>
    //         <br>
    //     </div><br>
    //         <div style="float:left;height:1550px;width:65%;border:1px solid red;">
    //             <h3>EDUCATION</h3>
    //         </div>

    //         <div style="float:right;height:1550px;width:35%;border:1px solid red;">

    //         </div>
    // </div>';

        

    ?>
    <!-- <div class="main_container">
        <div style="float:left;padding-left:20px;height:150px;width:100%;border:1px solid black;">
            <h2 style="line-height:50px;"><?php echo $user_first_name . ' ' . $user_last_name; ?></h2>
            <h5 style="line-height:4px;"><?php echo $user_address . ', ' . $user_city ;?></h5>
            <h5 style="line-height:4px;"><?php echo $user_address . ', ' . $user_country . ' | ' . $user_mobile;?></h5>
            <br>
        </div><br>
        <div style="display:flex">
            <div style="float:left;height:1550px;width:65%;border:1px solid red;">
                <h3>EDUCATION</h3>
                <hr>
            </div>

            <div style="float:right;height:1550px;width:35%;border:1px solid red;">

            </div>
        </div>
    </div> -->
</body>
</html>

<!-- fname
email
mobile
skype
blood group
github -->