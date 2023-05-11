<?php
include "includes/header.php";
include "includes/navbar.php";
?>
<div class="hero">
    <div class="selector">
        <div id="selectField">
            <p id="selectText">Select Your Interested Field</p>
            <img src="media/images/arrow.png" id="arrowicon">
        </div>
        <ul id="list" class="hide">
            <li class="options">
                <img src="media/images/student1.png">
                <p>Student</p>
            </li>
            <li class="options">
                <img src="media/images/account.png">
                <p>Accountant</p>
            </li>
            <li class="options">
                <img src="media/images/advisor.png">
                <p>Advisor</p>
            </li>
            <li class="options">
                <img src="media/images/register.png">
                <p>Regsitrar</p>
            </li>
            <li class="options">
                <img src="media/images/admin.jpg">
                <p>Admin</p>
            </li>
        </ul>
    </div>
    <button class="submit-btn" onclick="redirectLogin()">Submit</button>
</div>
<script>
    var selectField = document.getElementById("selectField");
    var selectText = document.getElementById("selectText");
    var options = document.getElementsByClassName("options");
    var list = document.getElementById("list");
    var arrowicon = document.getElementById("arrowicon");
    var loginPath = document.getElementsByClassName("loginPath");

    selectField.onclick = function () {
        list.classList.toggle("hide");
        arrowicon.classList.toggle("rotate");
    }
    for (option of options) {
        option.onclick = function () {
            selectText.innerHTML = this.textContent;
            currentLogin = this.textContent;
            list.classList.toggle("hide");
            arrowicon.classList.toggle("rotate");
        }
    }

    function redirectLogin() {
        if (currentLogin.match("Student")) {
            window.location.href = "/coursereg/students/stuLogin.php";
        }
        else if (currentLogin.match("Accountant")) {
            window.location.href = "/coursereg/accdept/accLogin.php";
        }
        else if (currentLogin.match("Advisor")) {
            window.location.href = "/coursereg/advisordept/advLogin.php";
        }
        else if (currentLogin.match("Regsitrar")) {
            window.location.href = "/coursereg/registerdept/regLogin.php";
        }
        else if (currentLogin.match("Admin")) {
            window.location.href = "/coursereg/admin/adminlogin.php";
        }
    }
</script>
<?php
include "includes/footer.php";
?>