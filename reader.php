<?php
require('comments/Persistence.php');
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
	
	if(!file_exists("resources/$id.thread")) {
	echo "<script>location.replace('index.php');</script>";
	} else {
		require_once("config-types/yaml.php");
		$cfg = new YamlConfig("resources/$id.thread");
		$name = $cfg->get("Name");
		$title = $cfg->get("Title");
		$version =  = $cfg->get("Version");
		$dllink =  = $cfg->get("Download");
		$contents = $cfg->get("Text");
		require_once("parser.php");
		$parse = new Parser();
		$contents = $parse->parse($contents);
	}
}
if(!isset($id)) {
	echo "<script>location.replace('index.php');</script>";
}
?>
<html>
<head>
<title><?php echo $name . " version " . $version ?></title>
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
				<a href="/"><img src="images/logo.png" height="43" width="43"></img></a>
				<nav id="nav">
					<ul>
						<li><a href="signup/">Sign up</a></li>
						<li><a href="login/">Login</a></li>
					</ul>
			</nav>
</header>

<section id="one" class="wrapper style1">
<center><img src='images/<? echo $name ?>.png'></img><h3>Resource <?php echo $name . " version " . $version ?></h3></center><center><a class="button big special" href="<? echo $dllink?>">Download resource</a></center>
				<header class="major">
				 <div class="container">
					 <section class="special box">
					 <?php echo $contents ?>
					 <?php include 'ratings/hrat.php'?>
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
        foreach ($comments as &$comment) {
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
			
	</section>
	
</body>
<p><a href="http://boxofdevs.ml">© 2016 BoxManager - BoxOfDevs team.</a></p>
</html>
