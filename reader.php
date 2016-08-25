<?php
require('comments/Persistence.php');
require('login/fg_membersite.php');
$comment_post_ID = 1;
$db = new Persistence();
$comments = $db->get_comments($comment_post_ID);
$has_comments = (count($comments) > 0);
 /* ____            __  __                                   
 * | __ )  _____  _|  \/  | __ _ _ __   __ _  __ _  ___ _ __ 
 * |  _ \ / _ \ \/ / |\/| |/ _` | '_ \ / _` |/ _` |/ _ \ '__|
 * | |_) | (_) >  <| |  | | (_| | | | | (_| | (_| |  __/ |   
 * |____/ \___/_/\_\_|  |_|\__,_|_| |_|\__,_|\__, |\___|_|   
 *                                          |___/     
 */
error_reporting(-1);
if (isset($_GET["thread"])) {
	$id = htmlspecialchars($_GET["thread"]);
	if(!isset($_GET["isWaiting"])) {
		if(!file_exists("resources/$id.json")) {
			echo "<script>location.replace('index.php');</script>";
		}
	} else {
		if(!file_exists("waiting-resources/$id.json")) {
			echo "<script>location.replace('index.php');</script>";
		}
	}
}
if(!isset($id)) {
	echo "<script>location.replace('index.php');</script>";
}
?>
<html>
<head>
<title><?php echo $infos->Name . " version " . $infos->Version ?></title>
<link rel="stylesheet" href="/css/skel.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" href="/css/style-xlarge.css" />
<script src="/js/jquery.min.js"></script>
<script src="/js/skel.min.js"></script>
<script src="/js/skel-layers.min.js"></script>
<script src="/js/init.js"></script>
</head>
<body>
<header id="header" class="skel-layers-fixed">
				<a href="<?php echo json_decode(file_get_contents("configs/config.json"), true)["Site Main"] ?>"><img src="images/logo.png" height="43" width="43"></img><?php echo json_decode(file_get_contents("configs/config.json"))->{"Site Name"}; ?></a>
				<nav id="nav">
					<ul>
					<?php
					if($fgmembersite->CheckLogin()){
						echo <<<A
<li><a href="signup/">Sign up</a></li>
<li><a href="login/">Login</a></li>
A
					} else {
						echo <<<A
<li>Welcome back, {$fgmembersite->UserFullName()}</li>
<li><a href="add/">Add resource</a></li>
A
					}
					?>
					</ul>
			</nav>
</header>

<section id="one" class="wrapper style1">
<center><img src='images/<? echo $infos->Name ?>.png'></img><h3>Resource <?php echo $infos->Name . " version " . $infos->Version ?></h3></center><center><a class="button big special" href="<? if(json_decode(file_get_contents("configs/config.json"), true)["Anyone dl"] and !$fgmembersite->CheckLogin()) { echo "login/login.php?msg=You must be logged to do this action."} else { echo $infos->Download } ?>">Download resource</a></center>
				<header class="major">
				 <div class="container">
					 <section class="special box">
					 <?php requires("Codes/Codes.php");echo (new Codes())->toHTML($infos->Text); ?>
					 </section>
				</div>
			</header>
				 <div class="container">
					 <section class="special box">
					 <h2>Ratings</h2><hr/>
					 <?php 
					 foreach($infos->Ratings as $p => $rate) {
						 $r = "";
						 for($i = 1; $i <= $rate[0]; $i++) {
							 $r .= "★";
						 }
						 for($i = 5; $i > $rate[0]; $i--) {
							 $r .= "☆";
						 }
						 echo "<h2>" . $p . ": " . $r . "</h2><br><h3>" . $rate[1] . "</h3><hr>";
					 }; 
					 ?>
					 </section>
					 <section class="special box">
					 <h2>Leave a review !</h2><hr/>
					 <?php if($fgmembersite->CheckLogin()) {
						 echo <<<A
<input type='text' id='review' placeholder='Enter a review' size=40 maxlenght=140 onKeyUP='document.getElementById(\"charleft\").innerHTML=140 - document.getElementById(\"review\").value.length;'></input><p><span id='Star1' onclick='stars = 1;s1.innerHTML=\"★\";s2.innerHTML=\"☆\";s3.innerHTML=\"☆\";s4.innerHTML=\"☆\";s5.innerHTML=\"☆\";'>★</span><span id='Star2' onclick='stars = 2;s1.innerHTML=\"★\";s2.innerHTML=\"★\";s3.innerHTML=\"☆\";s4.innerHTML=\"☆\";s5.innerHTML=\"☆\";'>★</span><span id='Star3' onclick='stars = 3; s1.innerHTML=\"★\";s2.innerHTML=\"★\";s3.innerHTML=\"★\";s4.innerHTML=\"☆\";s5.innerHTML=\"☆\";'>★</span><span id='Star4' onclick='stars = 4;s1.innerHTML=\"★\";s2.innerHTML=\"★\";s3.innerHTML=\"★\";s4.innerHTML=\"★\";s5.innerHTML=\"☆\";'>☆</span><span id='Star5' onclick='stars = 5;s1.innerHTML=\"★\";s2.innerHTML=\"★\";s3.innerHTML=\"★\";s4.innerHTML=\"★\";s5.innerHTML=\"★\";'>☆</span><p id='charleft' style='color: green;'>140</p><button class='download' onclick='location=\"review.php?r=\" + document.getElementById(\"review\").value + \"&id=<?php echo $id; ?>&s=\" + stars'><br>Submit</button></h3><script>s1 = document.getElementById('Star1');s2 = document.getElementById('Star2');s3 = document.getElementById('Star3');s4 = document.getElementById('Star4');s5 = document.getElementById('Star5');</script>
A;
					 } else {
						 echo "<a href='login.php'><button>Login to review !</button></a>";
					 }
					 </section>
				</div>
			</header>
</section>
<section id="comments" class="body">
	  
	  <header>
			<h2>Comments</h2>
		</header>

    <ol id="posts-list" class="hfeed<?php echo($has_comments?' has-comments':''); ?>">
      <li class="no-comments">Be the first to add a comment.</li>
      <?php
        foreach ($comments as $comment) {}
          ?>
          <li><article id="comment_<?php echo($comment['id']); ?>" class="hentry">	
    				<footer class="post-info">
    					<abbr class="published" title="<?php echo($comment['date']); ?>">
    						<?php echo( date('d F Y', strtotime($comment['date']) ) ); ?>
    					</abbr>

    					<address class="vcard author">
    						By <a class="url fn" href="#"><?php echo($comment['comment_author']); ?></a>
    					</address>
    				</footer>

    				<div class="entry-content">
    					<p><?php echo($comment['comment']); ?></p>
    				</div>
    			</article></li>
          <?php
        }
      ?>
		</ol>
		
		<div id="respond">

      <h3>Leave a Comment</h3>

      <form action="commments/post_comment.php" method="post" id="commentform">

        <label for="comment_author" class="required">Your name</label>
        <input type="text" name="comment_author" id="comment_author" value="" tabindex="1" required="required">
        
        <label for="email" class="required">Your email</label>
        <input type="email" name="email" id="email" value="" tabindex="2" required="required">

        <label for="comment" class="required">Your message</label>
        <textarea name="comment" id="comment" rows="10" tabindex="4"  required="required"></textarea>

        <input type="hidden" name="comment_post_ID" value="<?php echo($comment_post_ID); ?>" id="comment_post_ID" />
        <input name="submit" type="submit" value="Submit comment" />
        
      </form>
      
    </div>
		<button class="big special button" onClick="location.replace('moderation-queue.php?approve=<?php echo $id; ?>'">Approve resource !</button>	
	</section>
	
</body>
<p><a href="http://boxofdevs.com">© 2016 BoxManager - BoxOfDevs team.</a></p>
</html>
