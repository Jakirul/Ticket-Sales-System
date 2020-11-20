<meta charset="UTF-8">
<!-- allows it to make the site mobile friendly -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- imports the icons from fontawesome -->
<script src="https://kit.fontawesome.com/7d81fb84da.js" crossorigin="anonymous"></script>
<!-- links the html file to the css. php echo time stops php from not updating the css everytime i change the code. before, i had the issue where php wouldn't update my css code
regardless of changing it. adding this has fixed it. -->
<link rel="stylesheet" href="../../static/css/style.css?<?php echo time(); ?>" />