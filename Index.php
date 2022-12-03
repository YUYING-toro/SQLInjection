<?php
include("Common/Header.php");
?>
<script type="text/javascript" src="jq.js"></script>
<body> 
    <div class="container"> 
        <h1>Log in </h1>
        <div class="row">
            <div class="col-md-10 text-center">
            <form action="index.php" method="post" >
            <table>
                <tr>
                    <th>Account</th>
                    <td><input type="text" name="account" value="<?php print_r($account); ?>" class="account"></td>
                
                </tr>
                <tr>
                    <th>Password</th>
                    <td><input type="password" name="password" value="<?php print_r($password); ?>" class="password"></td>
                </tr>
                <tr>

                    <td>
                        <input type="submit" name="submit" value="submit" class="btn-primary btn" style="margin-right: 1.5rem ">
                         <input type="submit" name="reset" value="Reset" class="btn-primary btn" >
                    </td>
                    <td>                    </td>
                </tr>
            </table>
        </form>
            </div>
        </div>
       <script type="text/javascript">

       </script>
    </div>
</body>

<?php
include("Common/Footer.php");
?>