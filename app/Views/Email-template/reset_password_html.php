<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
    <style>
        body {
            background-color: #eee;
            font-family: Arial, Helvetica, sans-serif;
            }
    </style>
</head>

<body>
    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color: #fff" >
  <tbody>
    <tr>
      <td>&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="30"><img src="<?php echo getenv('ImageURL');?>public/assets/images/logo-app.png"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td width="30">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div>
        <div>Hi <?php echo $user_name; ?></div>
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div>
        <div><span style="font-size: 14px; color:#555; line-height: 25px">Your reset password request has been received.<br>
            Please Click the below link to reset your password
</span></div>
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><a style="font-size: 14px; color: #555; font-weight: bold" href="<?php echo base_url().'/reset_password/'.$token;?>">Click here to Reset Password</a></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div>
        <span style="font-size: 14px; color:#555; line-height: 20px">Thanks<br>Training Layer</span>
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div>
        <div></div>
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

</body>
</html>
