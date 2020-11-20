
    <?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/7d81fb84da.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" th:href="@{/css/style.css}" href="../static/css/stylea.css">
    <title>ATS</title>
    <style type="text/css">
        body {
            background: url(../static/img/showcase.jpg) no-repeat center center/cover;
        }
        .body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
        }
        .container {
            width: 1000px;
            position: relative;
            display: flex;
            justify-content: space-between;
        }
        .container .card {
            position: relative;
        }
        .container .card .face {
            width: 300px;
            height: 200px;
            transition: 0.5s;
        }
        .container .card .face.face1 {
            position: relative;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
            transform: translateY(100px);
        }
        .container .card:hover .face.face1{
            transform: translateY(0px);
            background: #2b59a2;
        }
        .container .card .face.face1 .content {
            opacity: 0.2;
            transform: 0.5s;
        }
        .container .card:hover .face.face1 .content {
            opacity: 1;
        }
        .container .card .face.face1 .content img {
            max-width: 100px;
            margin-left: 1.5rem;
            /* border: 1px solid #fff; */
        }
        .container .card .face.face1 .content h3 {
            text-align: center;
            font-size: 1.5rem;
        }
        .container .card .face.face2 {
            position: relative;
            background: #fff;
            display: flex;
            justify-content: center; 
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
            transform: translateY(-100px);
        }
        .container .card:hover .face.face2 {
            transform: translateY(0px);
        }
        .container .card .face.face2 .content p {
            margin: 0;
            padding: 0;
        }
        .container .card .face.face2 .content a {
            margin: 15px 0 0;
            display: inline-block;

            text-decoration: none;
            font-weight: 900;
            color: #333;
            padding: 5px;
            border: 1px solid #333; 
        }
        .container .card .face.face2 .content a:hover {
            background: #333;
            color: #fff;
        }
    </style>
</head>
<body>


    <div class="body">

        <div class="container">
            <div class="card">
                <div class="face face1">
                    <div class="content">
                        <img src="../static/img/support.png">
                        <!-- system admin user -->
                        <h3>System Admin</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>Privileges include: Updating blank stock, creating office manager and travel advisor account, generating reports, sytem backup and restore</p>
                        <a href="systemadmin/home.php" class="btn" style="width: 100%; text-align:center;">Log In</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="face face1">
                    <div class="content">
                        <img src="../static/img/work.png">
                          <!-- office manager user -->
                        <h3>Office Manager</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>Privileges include: Assigning blanks, setting and updating commission rates and discount, accessing and generating reports</p>
                        <a href="officemanager/home.php" class="btn" style="width: 100%; text-align:center;">Log In</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="face face1">
                    <div class="content">
                      <!-- travel advisor user -->
                        <img src="../static/img/customer-service.png">
                        <h3>Travel Advisor</h3>
                    </div>
                </div>
                <div class="face face2">
                    <div class="content">
                        <p>Priveleges include: Selling and cancellation of tickets, creating customer account, generate and access of reports</p>
                        <a href="traveladvisor/home.php" class="btn" style="width: 100%; text-align:center;">Log In</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</body>
</html>