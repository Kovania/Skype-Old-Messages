<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Skype Old Messages</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body onload="Check();">
<div class="container clearfix">
<center><img src='assets/img/loading.gif' height='50px' class="loading"></center>
<div class="nodb">
<center>Fichier main.db introuvable</center><br><br>
Emplacement du fichier :<br><br>
Windows 7, 8, 10 : <i>C:\Users\<b>UserName</b>\AppData\Roaming\Skype\<b>SkypeUserName</b>\main.db</i><br>
Windows XP : <i>C:\Documents and Settings\<b>UserName</b>\Application Data\Skype\<b>SkypeUserName</b>\main.db</i><br>
Mac OS : <i>~/Library/Application Support/Skype/<b>SkypeUserName</b>/main.db</i><br>
Linux : <i>~/.Skype/<b>SkypeUserName</b>/main.db</i><br><br>
Copier ce fichier dans le dossier : <i>Amfphp</i>
</div>
<div class="people-list" id="people-list">
<div class="search">
<input type="text" placeholder="Recherche..." />
<i class="fa fa-search"></i>
</div>
<ul class="list">
</ul>
</div>
<div class="chat">
<div class="chat-header clearfix">
<div class="chat-about">
<div class="chat-with"></div>
<div class="chat-num-messages"></div>
</div>
</div> 
<div class="chat-history">
<ul class="chaat">
</ul>
</div> 
</div> 
</div> 
<script src='assets/js/scripts.js'></script>
<script src='assets/js/jquery.min.js'></script>
<script src='assets/js/list.min.js'></script>
</body>
</html>