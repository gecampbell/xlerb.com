<!DOCTYPE html>
<html>
<head>
<title>xlerb.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Fauna+One' rel='stylesheet' type='text/css'>
<style>
body {
margin: 5% 20%;
font-family: 'Fauna One', 'Times New Roman', times, helvetica, sans-serif;
font-size: 12pt;
line-height: 1.8em;
background: #eee;
}
h1 {
width: 80%;
text-align: right;
color: silver;
font-size: 48pt;
line-height: 48pt;
position: absolute;
left: 0;
bottom: 0;
letter-spacing: -8px;
}
ul {
list-style: none;
margin: 0;
padding: 0;
}
address {
font-style: normal;
margin-bottom: 2em;
}
address:first-line {
font-size: 16pt;
color: darkred;
}
a, a:visited {
color: gray;
text-decoration: none;
}
a:hover {
color: black;
}
span.desc {
display: none;
padding-left: 1em;
text-transform: lowercase;
font-family: helvetica, arial, sans-serif;
font-size: 10pt;
}
li:hover span.desc {
display: inline;
color: gray;
}
hr {
margin-top: 1em;
border-top: 1px #ccc dotted;
}
@media screen and (max-device-width: 480px){
    body {
    margin: 5px;
    }
    h1 {
    width: 100%;
    right: 10px;
    }
}
</style>
</head>
<body>
  <h1>xlerb.com</h1>
  <address>
  Glen Campbell<br>
  18211 Apache Springs Dr.<br>
  San Antonio, Texas 78259-3606
  </address>
  <hr>
  <ul>
    <li>+1 (210) 446-9990
    <span class="desc">You can call me on this. It's my phone number.</span>
    </li>
    <li><a href='m&#97;i&#108;to&#58;gle&#37;&#54;E&#64;x%6Cerb%2Eco&#109;'>glen&#64;xlerb&#46;&#99;om</a>
    <span class="desc">Please don't send me spam.</spam>
    </li>
    <li><a href="http://twitter.com/glenc" title="Twitter">Twitter</a>
    <span class="desc">Things I say in 140 characters or less.</span>
    </li>
    <li><a href="http://glen-campbell.com" title="My blog">Blog</a>
    <span class="desc">Things I say, usually in more than 140 characters.</span>
    </li>
    <li><a href="http://fb.me/glen.campbell" title="Facebook">Facebook</a>
    <span class="desc">This is where I post pictures of my drunken orgies.</span>
    </li>
    <li><a href="http://flickr.glen-campbell.com" title="Flickr">Photos</a>
    <span class="desc">This is where I post pictures of things other than
    drunken orgies.</span>
    </li>
    <li><a href="http://orts.pw" title="Tumblr">Tumblr</a>
    <span class="desc">This is where other stuff goes. You know, stuff.</span>
    </li>
    <li>Information
    <span class="desc">
    <?php
    echo $_SERVER['REMOTE_ADDR'];
    echo ' &bull; ';
    echo gethostname();
    ?>
    </span>
    </li>
    <hr>
	<p>Subscribe to my mailing list</p>
    <form action="/subscribe.php" method="post">
    	<input type="text" name="email"></input>
    </form>
  </ul>
</body>
</html>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-38736191-5', 'xlerb.com');
  ga('send', 'pageview');

</script>