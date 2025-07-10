<?php
session_start();
if(!isset($_SESSION['user_type'])){
header('Location:login.php');

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dynamic Car wash</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
*
{
    margin: 0;
    padding: 0;
    border: none;
    outline: none;
    box-sizing: border-box;
    font-family: "poppins" , sans-serif;
}
body{
    display:flex;
}
.sidebar{
    position: sticky;
    top:0;
    left: 0;
    bottom: 0;
    width: 85px;
    height: 100vh;
    padding: 0 1.7rem;
    color:#fff;
    overflow:hidden;
    transition: all 0.5s linear;
    background: rgba(113, 99, 186, 255);
}
.sidebar:hover{
    width: 240px;
    transition: 0.5s;
}
.logo
{
    height: 80px;
    padding: 16px;
}
.menu
{
    height: 88%;
    position: relative;
    list-style: none;
    padding: 0;
}
.menu li{
    padding: 1rem;
    margin: 8px 0;
    border-radius: 8px;
    transition: all 0.5s ease-in-out;
}
.menu li:hover,
.active{
    width:auto;
    background: #e0e0e058;
}
.menu a{
    color:#fff;
    font-size: 14px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}
.menu a i{
    font-size: 1.2rem;
}
.logout{
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
}
/*main body section*/
.main--content
{
    position: relative;
    background: #ebe9e9;
    width:100%;
    padding: 1rem;
}

.header--wrapper img{
    width: 50px;
    height: 50px;
    cursor: pointer;
    border-radius: 50%;
}

.header--wrapper{
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    background: #fff;
    border-radius: 10px;
    padding: 10px 2rem;
    margin-bottom: 1rem;
}
.header--title{
    color:rgba(113, 99, 186, 255)
}
.user--info{
    display:flex;
    align-items: center;
    gap: 1rem;
}

.search--box{
    background: rgb(237 237 237);
    border-radius: 15px;
    color: rgba(113, 99, 186, 255);
    display:flex;
    align-items: center;
    gap: 5px;
    padding: 4px 12px;
}

.search--box input{
    background: transparent;
    padding: 10px;
}

.search--box i{
    font-size: 1.2em;
    cursor: pointer;
    transition: all 0.5s ease-out;
}
.search--box i:hover{
     transform: scale(1.2);
}

</style>

<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active"><a href="about.html"><i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li><a href=""><i class="fas fa-user"></i>
                    <span>Profile</span></a>
            </li>
            <li><a href="#"><i class="fas fa-chart-bar"></i>
                    <span>Statistics</span></a>
            </li>
            <li><a href="#"><i class="fas fa-tachometer-alt"></i>
                    <span>Manage Staff</span></a>
            </li>
            <li><a href="#"><i class="fas fa-question-circle"></i>
                    <span>FAQ</span></a>
            </li>
            <li><a href="#"><i class="fas fa-cog"></i>
                    <span>Settings</span></a>
            </li>
            <li class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span
                    ></a>
            </li>
        </ul>
        
    </div>
    
<div class="main--content">
        <div class="header--wrapper">
                <div class="header--title">
                    
                        <span>User</span>
                        <h2>Dashboard</h2>

                </div>
                
                <div class="user--info">
                        <div class="search--box">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" placeholder="search">
                </div>
                <img src="" alt="">
                </div>

        </div>
<div>  <li class="sss"><a href="about.html"><i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li></div>
</div>
</body>

</html>