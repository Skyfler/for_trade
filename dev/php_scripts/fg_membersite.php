<?PHP
require_once("class.phpmailer.php");
require_once("formvalidator.php");

header("access-control-allow-origin: https://lp.sigfxpro.com");

$includeSentEmailsInResponse = false;

class FGMembersite
{
	var $admin_email;
	var $from_address;

	var $username;
	var $pwd;
	var $database;
	var $tablename;
	var $connection;
	var $rand_key;

	var $error_message;
	var $error_message_arr = [];

	//-----Initialization -------
	function FGMembersite()
	{
		$this->sitename = 'YourWebsiteName.com';
		$this->rand_key = '0iQx5oBk66oVZep';
	}

	function InitDB($host,$uname,$pwd,$database,$tablename)
	{
		$this->db_host  = $host;
		$this->username = $uname;
		$this->pwd  = $pwd;
		$this->database  = $database;
		$this->tablename = $tablename;

	}
	function SetAdminEmail($email)
	{
		$this->admin_email = $email;
	}

	function SetWebsiteName($sitename)
	{
		$this->sitename = $sitename;
	}

	function SetRandomKey($key)
	{
		$this->rand_key = $key;
	}

	//-------Main Operations ----------------------
	function RegisterUser()
	{
		if(!isset($_POST['submitted']))
		{
		   return false;
		}

		$formvars = array();

		if(!$this->ValidateRegistrationSubmission())
		{
			return false;
		}

		$this->CollectRegistrationSubmission($formvars);

		if(!$this->SaveToDatabase($formvars))
		{
			return false;
		}

		if(!$this->SendUserConfirmationEmail($formvars))
		{
			return false;
		}

		$this->SendAdminIntimationEmail($formvars);

		return true;
	}

	function ConfirmUser()
	{
		if(empty($_GET['code'])||strlen($_GET['code'])<=10)
		{
			// $this->HandleError("Please provide the confirm code");
			$this->HandleErrorObj((object) ['type' => 'param', 'name' => 'code', 'code' => 'invalid', 'error' => "Please provide the confirm code"]);
			return false;
		}
		$user_rec = array();
		if(!$this->UpdateDBRecForConfirmation($user_rec))
		{
			return false;
		}

		$this->SendUserWelcomeEmail($user_rec);

		$this->SendAdminIntimationOnRegComplete($user_rec);

		return true;
	}

	function Login()
	{
		// if(empty($_POST['username']))
		// {
		//     $this->HandleError("UserName is empty!");
		//     return false;
		// }

		if(empty($_POST['email']))
		{
			// $this->HandleError("UserName is empty!");
			$this->HandleErrorObj((object) ['type' => 'input', 'name' => 'email', 'code' => 'invalid', 'error' => "Email is empty!"]);
			return false;
		}

		if(empty($_POST['password']))
		{
			// $this->HandleError("Password is empty!");
			$this->HandleErrorObj((object) ['type' => 'input', 'name' => 'password', 'code' => 'invalid', 'error' => "Password is empty!"]);
			return false;
		}

		$email = trim($_POST['email']);
		$password = trim($_POST['password']);

		if(!isset($_SESSION)){ session_start(); }
		if(!$this->CheckLoginInDB($email, $password))
		{
			return false;
		}

		$_SESSION[$this->GetLoginSessionVar()] = $email;

		return true;
	}

	function CheckLogin()
	{
		 if(!isset($_SESSION)){ session_start(); }

		 $sessionvar = $this->GetLoginSessionVar();

		 if(empty($_SESSION[$sessionvar]))
		 {
			return false;
		 }
		 return true;
	}

	function UserFullName()
	{
		return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
	}

	function UserEmail()
	{
		return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
	}

	function LogOut()
	{
		session_start();

		$sessionvar = $this->GetLoginSessionVar();

		$_SESSION[$sessionvar]=NULL;

		unset($_SESSION[$sessionvar]);
	}

	function EmailResetPasswordLink()
	{
		if(empty($_POST['email']))
		{
			// $this->HandleError("Email is empty!");
			$this->HandleErrorObj((object) ['type' => 'input', 'name' => 'email', 'code' => 'invalid', 'error' => "Email is empty!"]);
			return false;
		}
		$user_rec = array();
		if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
		{
			return false;
		}
		if(false === $this->SendResetPasswordLink($user_rec))
		{
			return false;
		}
		return true;
	}

	function ResetPassword()
	{
		if(empty($_GET['email']))
		{
			// $this->HandleError("Email is empty!");
			$this->HandleErrorObj((object) ['type' => 'param', 'name' => 'email', 'code' => 'invalid', 'error' => "Email is empty!"]);
			return false;
		}
		if(empty($_GET['code']))
		{
			// $this->HandleError("reset code is empty!");
			$this->HandleErrorObj((object) ['type' => 'param', 'name' => 'code', 'code' => 'invalid', 'error' => "reset code is empty!"]);
			return false;
		}
		$email = trim($_GET['email']);
		$code = trim($_GET['code']);

		if($this->GetResetPasswordCode($email) != $code)
		{
			// $this->HandleError("Bad reset code!");
			$this->HandleErrorObj((object) ['type' => 'param', 'name' => 'code', 'code' => 'invalid', 'error' => "Bad reset code!"]);
			return false;
		}

		$user_rec = array();
		if(!$this->GetUserFromEmail($email,$user_rec))
		{
			return false;
		}

		$new_password = $this->ResetUserPasswordInDB($user_rec);
		if(false === $new_password || empty($new_password))
		{
			// $this->HandleError("Error updating new password");
			$this->HandleErrorObj((object) ['type' => 'db', 'action' => 'update', 'code' => 'failed', 'error' => "Error updating new password"]);
			return false;
		}

		if(false == $this->SendNewPassword($user_rec,$new_password))
		{
			// $this->HandleError("Error sending new password");
			$this->HandleErrorObj((object) ['type' => 'mailer', 'code' => 'failed', 'error' => "Error sending new password"]);
			return false;
		}
		return true;
	}

	function ChangePassword()
	{
		if(!$this->CheckLogin())
		{
			// $this->HandleError("Not logged in!");
			$this->HandleErrorObj((object) ['type' => 'session', 'name' => 'login', 'code' => 'failed', 'error' => "Not logged in!"]);

			return false;
		}

		if(empty($_POST['oldpwd']))
		{
			// $this->HandleError("Old password is empty!");
			$this->HandleErrorObj((object) ['type' => 'input', 'name' => 'oldpwd', 'code' => 'invalid', 'error' => "Old password is empty!"]);
			return false;
		}
		if(empty($_POST['newpwd']))
		{
			// $this->HandleError("New password is empty!");
			$this->HandleErrorObj((object) ['type' => 'input', 'name' => 'newpwd', 'code' => 'invalid', 'error' => "New password is empty!"]);
			return false;
		}

		$user_rec = array();
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
		{
			return false;
		}

		$pwd = trim($_POST['oldpwd']);

		if($user_rec['password'] != md5($pwd))
		{
			// $this->HandleError("The old password does not match!");
			$this->HandleErrorObj((object) ['type' => 'input', 'name' => 'oldpwd', 'code' => 'invalid', 'error' => "The old password does not match!"]);
			return false;
		}
		$newpwd = trim($_POST['newpwd']);

		if(!$this->ChangePasswordInDB($user_rec, $newpwd))
		{
			return false;
		}
		return true;
	}

	//-------Public Helper functions -------------
	function GetSelfScript()
	{
		return htmlentities($_SERVER['PHP_SELF']);
	}

	function SafeDisplay($value_name)
	{
		if(empty($_POST[$value_name]))
		{
			return'';
		}
		return htmlentities($_POST[$value_name]);
	}

	function RedirectToURL($url)
	{
		header("Location: $url");
		exit;
	}

	function GetSpamTrapInputName()
	{
		return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
	}

	function GetErrorMessage()
	{
		if(empty($this->error_message))
		{
			return '';
		}
		$errormsg = nl2br(htmlentities($this->error_message));
		return $errormsg;
	}

	function GetErrorMessageArr()
	{
		if(empty($this->error_message_arr))
		{
			return [];
		}
		// $errormsg = nl2br(htmlentities($this->error_message));
		return $this->error_message_arr;
	}

	function GenerateResponceObj($valid){
		$resObj = (object) [];

		if (isset($valid) && !!$valid === true) {
			$resObj->success = true;
		} else {
			$resObj->success = false;
		}

		$resObj->errors = $this->GetErrorMessageArr();

		return $resObj;
	}

	function findReferer() {
		$refsArr = array(
			"facebook." => '1',
			"twitter." => '2',
			"google." => '3' ,
			"vk." => '4' ,
			"bing." => '5' ,
			"yandex." => '6' ,
			"instagram." => '11',
			"youtube." => '12'
		);

		if (isset($_SERVER['HTTP_REFERER'])) {
			$referringPage = parse_url( $_SERVER['HTTP_REFERER'] );
			if ( isset( $referringPage['host'] )) {
				$referringHost = $referringPage['host'];
				foreach ($refsArr as $key => $value) {
					if (strpos(strtolower($referringHost),$key) !== false) {
						return $value;
					}
				}
			}
		}

		return false;
	}

	//-------Private Helper functions-----------

	function HandleError($err)
	{
		$this->error_message .= $err."\r\n";
	}

	function HandleErrorObj($errObj)
	{
		array_push($this->error_message_arr, $errObj);
	}

	function HandleDBError($err)
	{
		// $this->HandleError($err."\r\n mysqlerror:".mysql_error());
		$this->HandleErrorObj((object) ['type' => 'db', 'action' => '', 'code' => 'mysql_error', 'error' => $err." mysqlerror: ".mysql_error()]);
	}

	function GetFromAddress()
	{
		if(!empty($this->from_address))
		{
			return $this->from_address;
		}

		$host = $_SERVER['SERVER_NAME'];

		$from ="nobody@$host";
		return $from;
	}

	function GetFromName()
	{
		return 'Администрация SigFXpro';
	}

	function GetLoginSessionVar()
	{
		$retvar = md5($this->rand_key);
		$retvar = 'usr_'.substr($retvar,0,10);
		return $retvar;
	}

	function CheckLoginInDB($email,$password)
	{
		if(!$this->DBLogin())
		{
			// $this->HandleError("Database login failed!");
			$this->HandleErrorObj((object) ['type' => 'db', 'action' => 'login', 'code' => 'failed', 'error' => "Database login failed!"]);
			return false;
		}
		$email = $this->SanitizeForSQL($email);
		$pwdmd5 = md5($password);
		$qry = "SELECT email, password FROM $this->tablename WHERE email='$email' AND password='$pwdmd5' AND confirmcode='y'";

		$result = mysql_query($qry,$this->connection);

		if(!$result || mysql_num_rows($result) <= 0)
		{
			// $this->HandleError("Error logging in. The username or password does not match");
			// $this->HandleErrorObj((object) ['type' => 'sesion', 'name' => 'login', 'code' => 'failed', 'error' => "Error logging in. The email or password does not match"]);
			$this->HandleErrorObj((object) ['type' => 'input', 'name' => 'email', 'code' => 'invalid', 'error' => "Error logging in. The email or password does not match"]);
			return false;
		}

		$row = mysql_fetch_assoc($result);


		// $_SESSION['name_of_user']  = $row['name'];
		$_SESSION['email_of_user'] = $row['email'];

		return true;
	}

	function UpdateDBRecForConfirmation(&$user_rec)
	{
		if(!$this->DBLogin())
		{
			// $this->HandleError("Database login failed!");
			$this->HandleErrorObj((object) ['type' => 'db', 'action' => 'login', 'code' => 'failed', 'error' => "Database login failed!"]);
			return false;
		}
		$confirmcode = $this->SanitizeForSQL($_GET['code']);

		$result = mysql_query("SELECT email FROM $this->tablename WHERE confirmcode='$confirmcode'",$this->connection);
		if(!$result || mysql_num_rows($result) <= 0)
		{
			// $this->HandleError("Wrong confirm code.");
			$this->HandleErrorObj((object) ['type' => 'param', 'name' => 'code', 'code' => 'invalid', 'error' => "Wrong confirm code."]);
			return false;
		}
		$row = mysql_fetch_assoc($result);
		// $user_rec['name'] = $row['name'];
		$user_rec['email']= $row['email'];
		$user_rec['password'] = $this->GenerateNewPassword();

		$qry = "UPDATE $this->tablename SET confirmcode='y', password='".md5($user_rec['password'])."' WHERE confirmcode='$confirmcode'";

		if(!mysql_query( $qry ,$this->connection))
		{
			$this->HandleDBError("Error inserting data to the table\nquery:$qry");
			return false;
		}
		return true;
	}

	function ResetUserPasswordInDB($user_rec)
	{
		$new_password = $this->GenerateNewPassword();

		if(false == $this->ChangePasswordInDB($user_rec,$new_password))
		{
			return false;
		}
		return $new_password;
	}

	function GenerateNewPassword()
	{
		return substr(md5(uniqid()),0,10);
	}

	function ChangePasswordInDB($user_rec, $newpwd)
	{
		$newpwd = $this->SanitizeForSQL($newpwd);

		$qry = "UPDATE $this->tablename SET password='".md5($newpwd)."' WHERE  id_user=".$user_rec['id_user']."";

		if(!mysql_query( $qry ,$this->connection))
		{
			$this->HandleDBError("Error updating the password \nquery:$qry");
			return false;
		}
		return true;
	}

	function GetUserFromEmail($email,&$user_rec)
	{
		if(!$this->DBLogin())
		{
			// $this->HandleError("Database login failed!");
			$this->HandleErrorObj((object) ['type' => 'db', 'action' => 'login', 'code' => 'failed', 'error' => "Database login failed!"]);
			return false;
		}
		$email = $this->SanitizeForSQL($email);

		$result = mysql_query("Select * from $this->tablename where email='$email'",$this->connection);

		if(!$result || mysql_num_rows($result) <= 0)
		{
			// $this->HandleError("There is no user with email: $email");
			$this->HandleErrorObj((object) ['type' => 'input', 'name' => 'email', 'code' => 'invalid', 'error' => "There is no user with email: $email"]);
			return false;
		}
		$user_rec = mysql_fetch_assoc($result);


		return true;
	}

	function SendUserWelcomeEmail(&$user_rec)
	{
		$mailer = new PHPMailer();

		$mailer->CharSet = 'utf-8';

		// $mailer->AddAddress($user_rec['email'],$user_rec['name']);
		$mailer->AddAddress($user_rec['email'],'');

		$mailer->Subject = "Добро пожаловать на ".$this->sitename;

		$mailer->From = $this->GetFromAddress();
		$mailer->FromName = $this->GetFromName();

		$mailer->Body ="<p>Здравствуйте<br><br>".
		"Ваша регистрация на сайте ".$this->sitename." прошла успешно.<br>".
		"Ваш пароль: " . $user_rec['password'] . "<br><br>".
		"С уважением,<br>".
		"Администрация сайта<br>".
		"$this->sitename</p>";

		$mailer->IsHTML(true);

		if (isset($includeSentEmailsInResponse) && $includeSentEmailsInResponse === true) $this->HandleErrorObj((object) ['type' => 'mailer', 'code' => 'sent', 'error' => $mailer->Body]);

		if(!$mailer->Send())
		{
			// $this->HandleError("Failed sending user welcome email.");
			$this->HandleErrorObj((object) ['type' => 'mailer', 'code' => 'failed', 'error' => "Failed sending user welcome email."]);
			return false;
		}
		return true;
	}

	function SendAdminIntimationOnRegComplete(&$user_rec)
	{
		if(empty($this->admin_email))
		{
			return false;
		}
		$mailer = new PHPMailer();

		$mailer->CharSet = 'utf-8';

		$mailer->AddAddress($this->admin_email);

		$mailer->Subject = "Регистрация завершена: " . $user_rec['email'];

		$mailer->From = $this->GetFromAddress();
		$mailer->FromName = $this->GetFromName();

		$mailer->Body ="<p>Новый пользователь был зарегистрирован на сайте ".$this->sitename."<br>".
		"Email address: ".$user_rec['email']."</p>";

		$mailer->IsHTML(true);

		if (isset($includeSentEmailsInResponse) && $includeSentEmailsInResponse === true) $this->HandleErrorObj((object) ['type' => 'mailer', 'code' => 'sent', 'error' => $mailer->Body]);

		if(!$mailer->Send())
		{
			return false;
		}
		return true;
	}

	function GetResetPasswordCode($email)
	{
	   return substr(md5($email.$this->sitename.$this->rand_key),0,10);
	}

	function SendResetPasswordLink($user_rec)
	{
		$email = $user_rec['email'];

		$mailer = new PHPMailer();

		$mailer->CharSet = 'utf-8';

		// $mailer->AddAddress($email,$user_rec['name']);
		$mailer->AddAddress($email,'');

		$mailer->Subject = "Запрос на восстановление паролья на сайте ".$this->sitename;

		$mailer->From = $this->GetFromAddress();
		$mailer->FromName = $this->GetFromName();

		$link = $this->GetAbsoluteURLFolder().
				'/resetpwd.php?email='.
				urlencode($email).'&code='.
				urlencode($this->GetResetPasswordCode($email));

		$mailer->Body ="<p>Добрый день<br><br>".
		"Мы получили запрос на восстановление пароля на сайте ".$this->sitename."<br>".
		"Для восстановления пароля необходимо перейти по ссылке:<br>".
		"$link<br><br>".
		"<strong>В случае, если Вы не отправляли запрос на восстановление, просто проигнорируйте это сообщение.</strong><br><br>".
		"С Уважением<br>".
		"Администрация сайта<br>".
		"$this->sitename</p>";

		$mailer->IsHTML(true);

		if (isset($includeSentEmailsInResponse) && $includeSentEmailsInResponse === true) $this->HandleErrorObj((object) ['type' => 'mailer', 'code' => 'sent', 'error' => $mailer->Body]);

		if(!$mailer->Send())
		{
			return false;
		}
		return true;
	}

	function SendNewPassword($user_rec, $new_password)
	{
		$email = $user_rec['email'];

		$mailer = new PHPMailer();

		$mailer->CharSet = 'utf-8';

		// $mailer->AddAddress($email,$user_rec['name']);
		$mailer->AddAddress($email,'');

		$mailer->Subject = "Ваш новый пароль для ".$this->sitename;

		$mailer->From = $this->GetFromAddress();
		$mailer->FromName = $this->GetFromName();

		$mailer->Body ="<p>Еще раз здравствуйте<br><br>".
		"Ваш пароль был восстановлен успешно<br>".
		"Пароли на нашем сайте генерируются автоматически, Ваш новый пароль:<br><strong>$new_password</strong><br>".
		"<br>".
		"Благодарим за пользование нашим сайтом,<br>".
		"Администрация сайта<br>".
		$this->sitename . "</p>";

		$mailer->IsHTML(true);

		if (isset($includeSentEmailsInResponse) && $includeSentEmailsInResponse === true) $this->HandleErrorObj((object) ['type' => 'mailer', 'code' => 'sent', 'error' => $mailer->Body]);

		if(!$mailer->Send())
		{
			return false;
		}
		return true;
	}

	function ValidateRegistrationSubmission()
	{
		//This is a hidden input field. Humans won't fill this field.
//		if(!empty($_POST[$this->GetSpamTrapInputName()]) )
//		{
//			//The proper error is not given intentionally
//			// $this->HandleError("Automated submission prevention: case 2 failed");
//			$this->HandleErrorObj((object) ['type' => 'other', 'error' => "Automated submission prevention: case 2 failed"]);
//			return false;
//		}

		$validator = new FormValidator();
		$validator->addValidation("first_name","req","Please fill in First Name");
		$validator->addValidation("last_name","req","Please fill in Last Name");
		$validator->addValidation("email","email","The input for Email should be a valid email value");
		$validator->addValidation("email","req","Please fill in Email");
		$validator->addValidation("codeNum","req","Phone Country Code is requred");
		$validator->addValidation("phonenum","req","Please fill in Phone");
		// $validator->addValidation("password","req","Please fill in Password");


		$fullNum = (isset($_POST['codeNum']) && isset($_POST['phonenum'])) ?  $_POST['codeNum'] . $_POST['phonenum'] : false;
		$phoneExists = true;
		if ($fullNum) {
			if (!$this->ConfirmUsePhoneNum($fullNum)) {
				$phoneExists = false;
			}
		}

		if(!$validator->ValidateForm() || !$phoneExists)
		{
			$error='';
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err)
			{
				// $error .= $inpname.':'.$inp_err."\n";
				$this->HandleErrorObj((object) ['type' => 'input', 'name' => $inpname, 'error' => $inp_err]);
			}
			if (!$phoneExists) {
				// $error .= 'phonenum:Phone does not exist'."\n";
				$this->HandleErrorObj((object) ['type' => 'input', 'name' => 'phonenum', 'error' => 'Phone does not exist']);
			}
			// $this->HandleError($error);
			return false;
		}
		return true;
	}

	function ConfirmUsePhoneNum($fullNum)
	{
		$curl = curl_init();

		$apiKey = '369cf28d46cc04fb6b3219b039c7c58f';

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://apilayer.net/api/validate?access_key=$apiKey&number=$fullNum",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
			// $this->HandleError("cURL Error #:" . $err);
			$this->HandleErrorObj((object) ['type' => 'curl', 'code' => 'failed', 'error' => $err]);

			return false;
		} else {
			$res = json_decode($response);

			if ($res->valid) {
				return true;
			} else {
				return false;
			}
		}
	}

	function CollectRegistrationSubmission(&$formvars)
	{
		$formvars['first_name'] = $this->Sanitize($_POST['first_name']);
		$formvars['last_name'] = $this->Sanitize($_POST['last_name']);
		$formvars['email'] = $this->Sanitize($_POST['email']);
		$formvars['username'] = $this->Sanitize($_POST['username']);
		// $formvars['password'] = $this->Sanitize($_POST['password']);
		$formvars['codeNum'] = $this->Sanitize($_POST['codeNum']);
		$formvars['phonenum'] = $this->Sanitize($_POST['phonenum']);
	}

	function SendUserConfirmationEmail(&$formvars)
	{
		$mailer = new PHPMailer();

		$mailer->CharSet = 'utf-8';

		// $mailer->AddAddress($formvars['email'],$formvars['name']);
		$mailer->AddAddress($formvars['email'],'');

		$mailer->Subject = "Подтверждение регистрации на сайте ".$this->sitename;

		$mailer->From = $this->GetFromAddress();
		$mailer->FromName = $this->GetFromName();

		$confirmcode = $formvars['confirmcode'];

		$confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;

		$mailer->Body ="<p>Добрый день<br><br>".
		"Благодарим за регистрацию на сайте ".$this->sitename."<br>".
		"Для продолжения пользования сайтом, пожалуйста подтвердите Вашу учетную запись, перейдя по ссылке.<br>".
		"$confirm_url<br><br>".
		"С уважением,<br>".
		"Администрация сайта<br>".
		"$this->sitename</p>";

		$mailer->IsHTML(true);

		if (isset($includeSentEmailsInResponse) && $includeSentEmailsInResponse === true) $this->HandleErrorObj((object) ['type' => 'mailer', 'code' => 'sent', 'error' => $mailer->Body]);

		if(!$mailer->Send())
		{
			// $this->HandleError("Failed sending registration confirmation email.");
			$this->HandleErrorObj((object) ['type' => 'mailer', 'code' => 'failed', 'error' => "Failed sending registration confirmation email."]);
			return false;
		}
		return true;
	}
	function GetAbsoluteURLFolder()
	{
		$scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
		$scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
		return $scriptFolder;
	}

	function SendAdminIntimationEmail(&$formvars)
	{
		if(empty($this->admin_email))
		{
			return false;
		}
		$mailer = new PHPMailer();

		$mailer->CharSet = 'utf-8';

		$mailer->AddAddress($this->admin_email);

		$mailer->Subject = "Новый пользователь ".$formvars['email'];

		$mailer->From = $this->GetFromAddress();
		$mailer->FromName = $this->GetFromName();

		$mailer->Body ="<p>Новый пользователь был зарегистрирован на сайте ".$this->sitename."<br>".
		"Email address: ".$formvars['email']."</p>";

		$mailer->IsHTML(true);

		if (isset($includeSentEmailsInResponse) && $includeSentEmailsInResponse === true) $this->HandleErrorObj((object) ['type' => 'mailer', 'code' => 'sent', 'error' => $mailer->Body]);

		if(!$mailer->Send())
		{
			return false;
		}
		return true;
	}

	function SaveToDatabase(&$formvars)
	{
		if(!$this->DBLogin())
		{
			// $this->HandleError("Database login failed!");
			$this->HandleErrorObj((object) ['type' => 'db', 'action' => 'login', 'code' => 'failed', 'error' => "Database login failed!"]);
			return false;
		}
		if(!$this->Ensuretable())
		{
			return false;
		}
		if(!$this->IsFieldUnique($formvars,'email'))
		{
			// $this->HandleError("This email is already registered");
			$this->HandleErrorObj((object) ['type' => 'input', 'name' => 'email', 'code' => 'invalid', 'error' => "This email is already registered"]);
			return false;
		}

		// if(!$this->IsFieldUnique($formvars,'username'))
		// {
		//     $this->HandleError("This UserName is already used. Please try another username");
		//     return false;
		// }
		if(!$this->InsertIntoDB($formvars))
		{
			// $this->HandleError("Inserting to Database failed!");
			$this->HandleErrorObj((object) ['type' => 'db', 'action' => 'insert', 'code' => 'failed', 'error' => "Inserting to Database failed!"]);
			return false;
		}
		return true;
	}

	function IsFieldUnique($formvars,$fieldname)
	{
		$field_val = $this->SanitizeForSQL($formvars[$fieldname]);
		$qry = "SELECT email FROM $this->tablename WHERE $fieldname='".$field_val."'";
		$result = mysql_query($qry,$this->connection);
		if($result && mysql_num_rows($result) > 0)
		{
			return false;
		}
		return true;
	}

	function DBLogin()
	{

		$this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);

		if(!$this->connection)
		{
			$this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
			return false;
		}
		if(!mysql_select_db($this->database, $this->connection))
		{
			$this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
			return false;
		}
		if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
		{
			$this->HandleDBError('Error setting utf8 encoding');
			return false;
		}
		return true;
	}

	function Ensuretable()
	{
		$result = mysql_query("SHOW COLUMNS FROM $this->tablename");
		if(!$result || mysql_num_rows($result) <= 0)
		{
			return $this->CreateTable();
		}
		return true;
	}

	function CreateTable()
	{
		$qry = "Create Table $this->tablename (".
				"id_user INT NOT NULL AUTO_INCREMENT ,".
				"first_name VARCHAR( 128 ) NOT NULL ,".
				"last_name VARCHAR( 128 ) NOT NULL ,".
				"email VARCHAR( 64 ) NOT NULL ,".
				"phone_number VARCHAR( 16 ) NOT NULL ,".
				"password VARCHAR( 32 ) NOT NULL ,".
				"confirmcode VARCHAR(32) ,".
				"PRIMARY KEY ( id_user )".
				")";

		if(!mysql_query($qry,$this->connection))
		{
			$this->HandleDBError("Error creating the table \nquery was\n $qry");
			return false;
		}
		return true;
	}

	function InsertIntoDB(&$formvars)
	{

		$confirmcode = $this->MakeConfirmationMd5($formvars['email']);

		$formvars['confirmcode'] = $confirmcode;

		$insert_query = 'insert into '.$this->tablename.'(
				first_name,
				last_name,
				email,
				phone_number,
				confirmcode
				)
				values
				(
				"' . $this->SanitizeForSQL($formvars['first_name']) . '",
				"' . $this->SanitizeForSQL($formvars['last_name']) . '",
				"' . $this->SanitizeForSQL($formvars['email']) . '",
				"' . $this->SanitizeForSQL($formvars['codeNum']) . $this->SanitizeForSQL($formvars['phonenum']) . '",
				"' . $confirmcode . '"
				)';
		if(!mysql_query( $insert_query ,$this->connection))
		{
			$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			return false;
		}
		return true;
	}
	function MakeConfirmationMd5($email)
	{
		$randno1 = rand();
		$randno2 = rand();
		return md5($email.$this->rand_key.$randno1.''.$randno2);
	}
	function SanitizeForSQL($str)
	{
		if( function_exists( "mysql_real_escape_string" ) )
		{
			  $ret_str = mysql_real_escape_string( $str );
		}
		else
		{
			  $ret_str = addslashes( $str );
		}
		return $ret_str;
	}

 /*
	Sanitize() function removes any potential threat from the
	data submitted. Prevents email injections or any other hacker attempts.
	if $remove_nl is true, newline chracters are removed from the input.
	*/
	function Sanitize($str,$remove_nl=true)
	{
		$str = $this->StripSlashes($str);

		if($remove_nl)
		{
			$injections = array('/(\n+)/i',
				'/(\r+)/i',
				'/(\t+)/i',
				'/(%0A+)/i',
				'/(%0D+)/i',
				'/(%08+)/i',
				'/(%09+)/i'
				);
			$str = preg_replace($injections,'',$str);
		}

		return $str;
	}
	function StripSlashes($str)
	{
		if(get_magic_quotes_gpc())
		{
			$str = stripslashes($str);
		}
		return $str;
	}
}
/*
	Registration/Login script from HTML Form Guide
	V1.0

	This program is free software published under the
	terms of the GNU Lesser General Public License.
	http://www.gnu.org/copyleft/lesser.html


This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

For updates, please visit:
http://www.html-form-guide.com/php-form/php-registration-form.html
http://www.html-form-guide.com/php-form/php-login-form.html

*/
?>
