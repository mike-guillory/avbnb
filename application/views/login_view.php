<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="css/abv-bs.css" />
	<!-- ------------------------------------------------------------- -->
	<!-- http://phpgurukul.com/how-to-encrypt-password-on-client-side/ -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
	<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
	<script>
		function encrypt()
		{
			var pass=document.getElementById('password').value;
			// var hide=document.getElementById('hide').value;
			if(pass=="")
			{
			document.getElementById('err').innerHTML='Error:Password is missing';
			return false;
			}
			else
			{
			// document.getElementById("hide").value = document.getElementById("password").value;
			var hash = CryptoJS.MD5(pass);
			document.getElementById('password').value=hash;
			return true;
			}
		}
	</script>
	<!-- --------------------------------------------------------------- -->
	<!-- --------------------------------------------------------------- -->
</head>
<body style="margin: 0 auto">
<h3 style="text-align: center; margin-top: 100px; margin-bottom: -150px">Arbourview Website Adminstration</h3>
	<div class="grad1" style="height: 300px; width: 400px; margin: 200px auto; color: #fff; box-shadow: 5px 5px 10px 1px #555; border-radius: 5px">
		<div style="width: 300px; margin: 0 auto; padding-top: 20px">
			<!-- <p style="margin-bottom: -30px; font-size: .8em">Administrator</p> -->
			<h1>Login</h1>

			<?php echo form_open('admin'); ?>
				<div>
					<!-- http://phpgurukul.com/how-to-encrypt-password-on-client-side/ -->
					<form class="form-signin" method="post" name="signin" id="signin">
						<input type="text"  name="userName" id="userName" placeholder="User Name" value=""  />
						<input type="password"  name="password" id="password" placeholder="Password" value=""  />
						<!-- <input type="hidden" name="hide" id="hide" /> -->
						<div style="color:red" id="err"></div>
						<input type="submit" name="login"  type="submit" onclick="return encrypt()" value="LOGIN"  >
					</form>
					<!-- ---------------------------------------------------------------- -->
				</div>
			<?php echo form_close(); ?>

			
		</div>
	</div>

	<div class="loginErrors"><?php 

							// Show validation_errors() if form doesn't validate.
							echo validation_errors();

							// Show $loginFailed if form validates, but login information is incorrect.
							if(isset($loginFailed))
							{
								echo $loginFailed;
							} 

						?>
	</div>
</body>
</html>