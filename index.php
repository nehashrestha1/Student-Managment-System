<?php
error_reporting(0);
session_start();
session_destroy();
if($_SESSION['message'])
{
    $message=$_SESSION['message'];
    echo "<script type = 'text/javascript'>
    alert['message'];
    </script>" ;
}
$host="localhost";

$user="root";

$password="";

$db="collegeproject";


$data=mysqli_connect($host,$user,$password,$db);
$sql="SELECT * FROM teacher";
$sql=mysqli_query($data,$sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student Management System</title>
        <link rel="stylesheet"  href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <nav>
        <label class="logo">
            
            Gupteshwor Mahadev Multiple Campus
        </label>
        <ul>
            <a href="">Home</a>
            
            <a href="login.php"class = "btn btn-success">Login</a>
        </ul>
        </nav>
        <center>
        <div class="section1">
            <label class="img_text">Show them what you are capable of</label>
        <img class="main_img" src="gmmc1.jpg">
        </div>
        </center>
<div class = "container">
    <div class="row">
        <div class="col-md-4">
            <img class="welcome_img" src="gmmc.jpg">
        </div>
        <div class="col-md-8">
            <h1>Welcome to Gupteshwor Mahadev Multiple Campus</h1>
            <p>Personalities, political activists, religious people and enthusiastic social campaigners, who are dedicated to develop the community as the center of academic excellence. The campus runs under the patronship of Gupteshwor Mahadev Cave. This Campus is solely a non-profit community-based public Campus affiliated to Tribhuvan University and QAA certified.Since, it is a non-profit making campus exclusively devoted to the overall development of the nation, there have been incredibly positive responses and interests towards this institution from students and guardians alike.</p>
            
        </div>
    </div>
</div>

<center>
    <h1>Our Coordinators and Campus Chief</h1>
</center>
<div class="container">
<div class="row">
    <div class="col-sm-8">
        <img class= "teachers "src="cf1.jpg" >
        <p>I heartily welcome you new-comers from schools far and near across the nation at this college. Hunting for an ideal college in your pursuance for higher education is of course a matter of great trials and tribulations. You are obsessed with the only wish to serendipity a college that can accomplish your life’s career-related schoolings and accomplishments.

On this ground, with solemn assurance, I wish to say that you’ve eventually spotted the college that assures to dissipate you with the values and associations essential to meet the national as well as global levels of academic and career development skills. I should say GMMC shall definitely prove to you your desired and best selection for you can see the educational highlights from the very outset of your enrolment here.
<br>Campus Chief:Dharmaraj Baral</p>
    </div>
    <br>
        <div class="col-md-5">
            <img class="teacher" src="bim.jpg">
            <p>The Bachelor of Information Management (BIM) programme is a four year (eight semester) programme of Tribhuvan University offering an integrated IT and Management Courses. This course is envisaged to enable students to develop skill in information technology, and at the same time make them able to understand the professional expertise while they occupy decision making positions.<br>Coordinator:Suresh Baral</p>
        </div>
        <br>
        <div class="col-md-4">
            <img class="teacher" src="bhm.jpg">
            <p>The primary objective of our BHM course is to produce competent and highly skilled professionals who can lead and manage various aspects of the hospitality sector. Our program aims to foster a deep understanding of hospitality management principles, culinary arts, customer service, hotel operations, and event management. Students will be exposed to both theoretical knowledge and practical experiences to develop their critical thinking, problem-solving, and interpersonal skills, which are essential for success in this field.<br> Coordinator:Jiten Thapa</p>
        </div>
        
    <br>
        <div class="col-md-4">
            <img class="teacher" src="bbs.jpg">
            <p>The College also runs Bachelor in Business Studies (BBS) programme. The main objective of this programme is to produce middle-level managerial manapower for the organizations like: Banks, finance, insurance companies, business houses and so on. Moreover, BBS graduates of GMMC are expected to create employment opportunity to others after graduation. During the academic tenure, students are simulated with their probable working areas with regular visits to the financial institutions, business houses, media houses, industrial states and so on. <br>Coordinator:Durganath Paudel</p>
        </div>
        <br>
         
      <div class="col-md-4">
            <img class="teacher" src="mbs.jpg">
            <p>The Master’s in Business Studies (MBS) program is a postgraduate degree offered by many universities and colleges in Nepal. It is a popular choice for students interested in pursuing careers in business, management, finance, and related fields. The MBS program typically covers a wide range of subjects, including Accounting, Marketing, Finance, and General Management.

Since 2018, GMMC has implemented the MBS program, and consistently, our students have achieved top positions in various semesters within Gandaki province. As our program follows a semester-based approach, we prioritize collaborative learning over individual learning. Our teaching and learning methods distinguish us from other institutions, making us a prominent establishment in Pokhara Metropolitan City. Moreover, certain students have been honored by the Pokhara Commercial Union for achieving the highest overall marks. <br>Coordinator:Rajkumar Subedi</p>
        </div>
        <br>
        <div class="col-md-4">
            <img class="teacher" src="acf.jpg">
            <p>Intially, the campus ran with Bachelor in Education (B.Ed.) programme considering the overwhelming need of the people of Chhorepatan and the surrounding areas. This programme prepares students to be able to teach at school level. Moreover, the program demands students’ deeper knowledge in pedagogy so they have to involve in different activities related to teaching and learning upon graduating.<br> Coordinator:Ramji Paudel</p>
        </div>
        <br>
</div>
<center>
    <h1>Our Courses</h1>
</center>
<div class="container">
<div class="row">
        <div class="col-md-4">
            <img class="teacher" src="bim2.jpg">
            <h3>Bachelor of Information Management</h3>
        </div>
        <div class="col-md-4">
            <img class="teacher" src="bhm2.jpg">
            <h3>Bachelor of Hotel Management</h3>
        </div>    
        
        
        <div class="col-md-4">
            <img class="teacher" src="bbs3.jpg">
            <h3>Bachelor of Business Studies</h3>
        </div>

        
       
           
        </div>
        
        

</div>
<footer>
    <div class="footer-content">
    <h2 class="footer_text">Copyright 2023 | Gupteshwor Mahadev Multiple Campus (GMMC) | All Rights Reserved </h2>
    </div>
</footer>
    </body>
</html>