<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="10; url=http://localhost/laravel" />
    <title>
        Selamat datang
    </title>
    <style>
        progress {
            border-radius: 7px;
            height: 22px;
            box-shadow: 1px 1px 4px rgb(0, 48, 255);
        }
        progress::-webkit-progress-bar {
            background-color: #ffffff;
            border-radius: 7px;
        }
        progress::-webkit-progress-value {
            background-color: #000000;
            border-radius: 7px;
            box-shadow: 1px 1px 5px 3px rgb(0, 47, 255);
        }
        progress::-moz-progress-bar {
            /* style rules */
        }
        .footer {
            position: absolute;
            bottom: 0;
            height: 20px;
            width: 100%;
        }
    </style>
    <script>
        var timeleft = 10;
        var downloadTimer = setInterval(function(){
            if(timeleft <= 0){
                clearInterval(downloadTimer);
            }
            document.getElementById("progressBar").value = 10 - timeleft;
            timeleft -= 1;
        }, 1000);
    </script>
</head>
<body background="1.jpg" link="#000" alink="#017bf5" vlink="#000">
<br />
<h3 align="center">
    <img src="https://jdih.bssn.go.id/wp-content/uploads/2020/03/MASTER-LOGO-BSSN-2020-01.png" height="150px">
</h3>
<br /><br /><br /><br />
<h1 align="center">
    <font face="Lato" color="#017bf5" size="7">
        SELAMAT DATANG PESERTA PELATIHAN
    </font>
</h1>
<h3 align="center">
    <font face="Lato" color="#000" size="6">
        SOFTWARE QUALITY BSSN
    </font>
</h3>
<br />
<h3 align="center">
    <a href="https://pusdiklat.bssn.go.id/v1/">
        <font face="Lato" color="#000">GET STARTED</font>
    </a>
</h3>
<p align="center"><progress style="" value="0" max="10" id="progressBar"></progress></p>
</body>
<footer class="footer">Created by Septian EN</footer>
</html>
