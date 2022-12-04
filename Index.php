<?php
include("Common/Header.php");
?>
<script type="text/javascript" src="jq.js"></script>

<body>
    <div class="container">
        <h1>Log in </h1>
        <div class="row">
            <div class="col-md-10 text-center">
                <form action="index.php" method="post" id="Form">
                    <table>
                        <tr>
                            <th>Account</th>
                            <td><input type="text" name="account" value="<?php print_r($account); ?>" class="account" id="account"></td>

                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input type="password" name="password" value="<?php print_r($password); ?>" class="password" id="password"></td>
                        </tr>
                        <tr>

                            <td>
                                <input type="submit" name="submit" value="submit" class="btn-primary btn" style="margin-right: 1.5rem ">
                                <input type="reset" name="reset" value="Reset" class="btn-primary btn" onclick="clearInput()">
                            </td>
                            <td> </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <script type="text/javascript">

        </script>
    </div>
</body>

<!--User input validation using JavaScript -->
<script>
    // Eventlistener when the rest btn is clicked:
    let accountInput = document.getElementById("account");
    let passwdInput = document.getElementById("password");

    function clearInput() {
        accountInput.innerHTML = "";
        passwdInput.innerHTML = "";
    }

    // Evenlistener when the submit btn is clicked: see if it contains any special characters
    let form = document.getElementById("Form");

    form.addEventListener('submit', function(event) {

        let format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

        if (!format.test(accountInput.innerText) || !format.test(passwdInput.innerText)) {

            // prevent the form from submitting if it contains any special charcters
            event.preventDefault();
        }
    })
</script>

<?php
include("Common/Footer.php");
?>
