<?php
include("Common/Header.php");
?>

<?php

$accountInput = $_POST['account'];
$passwdInput = $_POST['password'];

// implement php code to prevent SQL injection: use PDO - PHP Data Object

if (isset($accountInput)) {

    //validate if $accountInput contains any special character
    if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $accountInput)) {

        try {

            $dbh = new PDO('mysql:host=localhost;dbname=sql_injection_example', 'user', 'password');

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare the SQL statement
            $q = "SELECT username 
                FROM users
                WHERE id = :id";
            // Prepare the SQL query string.
            $sth = $dbh->prepare($q);
            // Bind parameters to statement variables.
            $sth->bindParam(':id', $id);
            // Execute statement.
            $sth->execute();
            // Set fetch mode to FETCH_ASSOC to return an array indexed by column name.
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            // Fetch result.
            $result = $sth->fetchColumn();
            /**
             * HTML encode our result using htmlentities() to prevent stored XSS and print the
             * result to the page
             */
            print(htmlentities($result));

            //Close the connection to the database.
            $dbh = null;
        } catch (PDOException $e) {

            error_log('PDOException - ' . $e->getMessage(), 0);

            http_response_code(500);
            die('Error establishing connection with database');
        }
    } else {

        // return this message if there's issue with the input string
        http_response_code(400);
        die('Error processing bad or malformed request');
    }
}

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
                            <td><input type="text" name="account" class="account" id="account"></td>

                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input type="text" name="password" class="password" id="password"></td>
                        </tr>
                        <tr>

                            <td>
                                <input type="submit" name="submit" value="submit" class="btn-primary btn" style="margin-right: 1.5rem ">
                                <input type="reset" name="reset" value="Reset" class="btn-primary btn" onclick="clearInput()">
                            </td>
                            <td>
                                <small style="display: none; color:red" id="errorMessage">The input cannot contain any special characters</small>
                            </td>
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
        passwdInput.innerHTML = "sdfsdf";
    }

    // Evenlistener when the submit btn is clicked: see if it contains any special characters
    let form = document.getElementById("Form");

    function containsSpecialChars(str) {
        const specialChars = `\`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~`;

        const result = specialChars.split('').some(specialChar => {
            if (str.includes(specialChar)) {
                return true;
            }

            return false;
        });

        return result;
    }

    form.addEventListener('submit', function(event) {

        console.log("Submit btn clicked");

        if (containsSpecialChars(accountInput.innerText) || containsSpecialChars(passwdInput.innerText)) {

            event.preventDefault();
            document.getElementById("errorMessage").style.display = "inline";
        }
    })
</script>

<?php
include("Common/Footer.php");
?>
