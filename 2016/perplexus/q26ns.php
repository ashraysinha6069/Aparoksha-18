<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user'])!="")
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
$active=$userRow['active'];
if($active==0)
{
		header("Location: verify.php");
}

$score=$userRow['score'];
$qs_ans=$userRow['qs_ans'];

if($score!=250 && $qs_ans!=25)
{
  header("Location: play.php");
}


$ques=mysql_query("SELECT * FROM ques WHERE ques_id=26");
$quesRow=mysql_fetch_array($ques);
$q26=$quesRow['q_ans'];

if(isset($_POST['q26_submit']))
{
	$q26_ans = mysql_real_escape_string($_POST['q26_ans']);
	$q26_ans=trim($q26_ans);
	$q26_ans=md5($q26_ans);
	$q26_ans=trim($q26_ans);

	if($q26_ans==$q26)
	{
		$q26_score=10;
		if(mysql_query("UPDATE users SET score=260,qs_ans=26 WHERE user_id=".$_SESSION['user']))
    		{
      			?>
      			<script>alert('successfully submitted');</script>
      			<?php
			header("Location: play.php");
    		}
		else
		{
			?>
      			<script>alert('query problem');</script>
      			<?php	
		}
	}
	else
	{
		
      			?>
      			<script>alert('wrong answer');</script>
      			<?php
	}	
}	
		
?>

<html>
<head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
         <link type="text/css" rel="stylesheet" href="css/general.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

<body>
<header>
      
     <ul id="nav-mobile" class="side-nav fixed">
       
       <li> <img src ="images/bg.png" height = "200" width = "200" margin-left="0">
                 </li>
        
        <li class="bold"><a href="play.php" class="waves-effect waves-grey">Play</a></li>
        <li class="bold"><a href="Leaderboard.php" class="waves-effect waves-grey">Leaderboard</a></li>
        
          
           
          
        </li>
        <li class="bold"><a href="rules.php" class="waves-effect waves-grey">Rules</a></li>
        <li class="bold"><a href="logout.php" class="waves-effect waves-grey">Logout</a></li>
      </ul>
    </header>
    <div id ="snow">
    </div>
    <div class="container">
    <div class="row">
  <div id="test1" class="col s12 m9"><br>
	
  

        <img id = "mainimg" class="materialboxed initialized" height="400" width="650" src="images/q27605.jpg" ><br>
	       
	<div class="row">
    <form method="post" class="col s12 ">
      <div class="row">
        <div class="input-field  col  s12 m6" id = "mainfield">
          <input placeholder="Enter text" id="q26_ans" name="q26_ans" type="text" class="validate white-text">
          <label for="q26_ans">Answer</label>
        </div>
 <button class="btn waves-effect waves-light btn-large black" type="submit" name="q26_submit" id ="mainbutton" ><i class="material-icons right">send</i>
  </button>
  </div>
    </form>
  </div></div>
  </div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
<script src = "JS/1.js"> </script>
</body>
