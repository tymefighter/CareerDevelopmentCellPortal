<?php
    session_start();
?>
<html>
    <head>
        <title>CDC Home Page</title>
        <link rel="stylesheet" href="../css_files/common.css">
        <link rel="stylesheet" href="../css_files/register_common.css">
        <script src='../javascript/automate_button.js'></script>
        <script src='../javascript/validate_form.js'></script>
    </head>
    <body>
        <ul class="nav">
            <li class="nav"><a href='../html/home.html' class="nav">Home</a></li>
            <li class="nav"><a href='https://iitpkd.ac.in' class="nav">IIT Palakkad</a></li>
            <li class="nav"><a href="../html/companies.html" class="nav">Companies</a></li>
            <li class="nav"><a href="../html/projects.html" class="nav">Projects</a></li>
            <li class="nav"><a href="../html/research.html" class="nav">Research</a></li>
            <li class="nav"><a href="../html/news.html" class="nav">News</a></li>
            <li class="nav"><a href="../php/login.php" class="nav">Login</a></li>
            <li class="nav"><a href="../php/register.php" class="nav">Register</a></li>
            <li id="nav_button">
                <div class="cont" onclick="clickMenuButton(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </li>
        </ul>
        <h2 class="heading_common">Register Student</h2>

        <form name="reg_student" action="../php/process_registration.php" onsubmit="return validateRegStudent()" method="post" id="login_form">
          
            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>
            
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label for="re_password"><b>Re-Enter Password</b></label>
                <input type="password" placeholder="Enter Password" name="re_password" required>

                <label for="student_code"><b>Enter Student Code</b></label>
                <input type="password" placeholder="Enter Student Code" name="student_code" required>

                <label for="roll_number"><b>Enter Roll Number</b></label>
                <input type="text" placeholder="Enter Roll Number" name="roll_number" required>

                <label for="name"><b>Enter Full Name</b></label>
                <input type="text" placeholder="Enter Full Name" name="name" required>

                <br><br>
                <label for="nationality"><b>Nationality: </b></label>
                <select name="nationality" class="drop_down">
                    <option value="Indian">Indian</option>
                    <option value="Nigerian">Nigerian</option>
                </select>

                <br><br>
                <label for="dob"><b>Date Of Birth: </b></label>
                <input type="date" placeholder="yyyy-mm-dd" name="dob" class="date" required>

                <br><br>
                <label for="gender"><b>Gender: </b></label>
                <select name="gender" class="drop_down">
                    <option value="F">Female</option>
                    <option value="M">Male</option>
                    <option value="O">Other</option>
                </select>
                
                <br><br>
                <label for="tenth_percentage"><b>Tenth Percentage</b></label>
                <input type="number" placeholder="Enter Tenth Percentage" name="tenth_percentage" min="0" max="100" class="number" step="0.01" required>

                <br><br>
                <label for="tenth_board"><b>Tenth Board</b></label>
                <select name="tenth_board" class="drop_down">
                    <option value="CBSE">CBSE</option>
                    <option value="ICSE">ICSE</option>
                </select>

                <br><br>
                <label for="twelfth_percentage"><b>Twelfth Percentage</b></label>
                <input type="number" placeholder="Enter Twelfth Percentage" name="twelfth_percentage" min="0" max="100" class="number" step="0.01" required>

                <br><br>
                <label for="twelfth_board"><b>Twelfth Board</b></label>
                <select name="twelfth_board" class="drop_down">
                    <option value="CBSE">CBSE</option>
                    <option value="ICSE">ICSE</option>
                </select>

                <br><br>
                <label for="JEE_main_rank"><b>JEE Main Rank</b></label>
                <input type="number" placeholder="Enter JEE Main Rank" name="JEE_main_rank" min="1" class="number" required>

                <br><br>
                <label for="JEE_advanced_rank"><b>JEE Advanced Rank</b></label>
                <input type="number" placeholder="Enter JEE Advanced Rank" name="JEE_advanced_rank" min="1" class="number" required>

                <br><br>
                <label for="bldg_name"><b>Building Name</b></label>
                <input type="text" placeholder="Enter Building Name" name="bldg_name" required>

                <label for="street_name"><b>Street</b></label>
                <input type="text" placeholder="Enter Street" name="street_name" required>

                <label for="district"><b>District</b></label>
                <input type="text" placeholder="Enter District" name="district" required>

                <label for="state"><b>State</b></label>
                <input type="text" placeholder="Enter State Name" name="state" required>

                <label for="country"><b>Country</b></label>
                <input type="text" placeholder="Enter Country Name" name="country" required>

                <label for="pincode"><b>Pincode</b></label>
                <input type="text" placeholder="Enter Pincode" name="pincode" required>

                <label for="phone_1"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter Phone Number" name="phone_1" required>

                <label for="phone_2"><b>Alternate Phone Number</b></label>
                <input type="text" placeholder="You May Enter An Alternate Phone Number" name="phone_2" required>

                <button type="submit" id="login_button">Register</button>
            </div>
            
        </form>
        <a href="../html/home.html" id="cancel_button">Cancel</a>
        <br>
        <br>
        <div class="container" style="background-color:#f1f1f1">
            <br>
            <br>
        </div>
    </body>
</html>