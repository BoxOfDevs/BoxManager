<html>
<head>
<title>Deletaing installation folder...</title>
<link rel="icon" href="favicon.png" />
<script src="/js/jquery.min.js"></script>
<script src="/js/skel.min.js"></script>
<script src="/js/skel-layers.min.js"></script>
<script src="/js/init.js"></script>
<link rel="stylesheet" href="/css/skel.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" href="/css/style-xlarge.css" />
</head>
<body>
<p>Please wait until deleting is finished...</p>
<?php
rmdir("../install");
?>
</body>
</html>
