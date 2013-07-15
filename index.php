<!DOCTYPE html>
<html>
<head>
<title>xlerb.com</title>
<link href='http://fonts.googleapis.com/css?family=Fauna+One' rel='stylesheet' type='text/css'>
<style>
body {
margin: 5% 20%;
font-family: 'Fauna One', 'Times New Roman', times, helvetica, sans-serif;
font-size: 12pt;
line-height: 1.8em;
}
h1 {
width: 80%;
text-align: right;
color: silver;
font-size: 100px;
line-hight: 100px;
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
text-decoration: underline;
}
span.desc {
display: none;
padding-left: 1em;
}
li:hover span.desc {
display: inline;
color: gray;
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
  <ul>
    <li>+1 (210) 446-9990
    <span class="desc">You can call me on this. It's my phone number.</span>
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
  </ul>
</body>
</html>
