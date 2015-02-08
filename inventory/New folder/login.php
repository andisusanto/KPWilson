<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>

    <link rel="stylesheet" type="text/css" href="css/weefer_inventory.css">
    <link type="text/css" rel="stylesheet" href="jquery/formValidation/css/validationEngine.jquery.css"/>
    <script src="jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="jquery/formValidation/js/jquery.validationEngine.js" type="text/javascript"></script>
    <script src="jquery/formValidation/js/languages/jquery.validationEngine-en.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#frmLogIn").validationEngine();
        });
    </script>
  </head>
  <body>
  
  <div class="logincontainer">
  <div class="loginarea">
    <form method="post" action="processlogin.php" id="frmLogIn">
      <table width="300" height="333" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td height="10" colspan="2" style="border-bottom:3px solid #000"><div class="logo"><img src="images/logo.png" width="200" /></div></td>
          </tr>
          <tr>
            <td height="48">UserName</td>
            <td><input type="text" name="txtUserName" class="validate[required]" placeholder="UserName"/></td>
          </tr>
          <tr>
            <td height="51">Password</td>
            <td><input type="password" name="txtPassword" class="validate[required]" placeholder="Password"/></td>
          </tr>
          <tr>
            <td height="51">&nbsp;</td>
           
            <td><input type="submit" name="login" id="login" value="Login" /></td>
          </tr>
        </table>
  </form>
  </div>
</div>
  </body>
</html>