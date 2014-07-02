<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class User{
	
	private	$tablename = 'user';

	function create_user($arrayForm){
		unset($arrayForm['pass1']);
        $arrayForm['login'] = trim(htmlentities($arrayForm['login']));
        $arrayForm['email'] = trim(htmlentities($arrayForm['email']));
        $arrayForm['real_name'] = trim(htmlentities($arrayForm['real_name']));
		$arrayForm['password'] = md5($arrayForm['password']);
		$arrayForm['status'] = 'inactivate';
		$arrayForm['points'] = 0;
		$arrayForm['role'] = "user";
		$arrayForm['created'] = "NOW()";
		$arrayForm['activate'] = 0;
		$dbclass = Database::dbase();
        $exception = $dbclass->write_table($this->tablename,$arrayForm);
     if($exception != null ){
           $this->activate($arrayForm['email'],$arrayForm['real_name']);
         $_SESSION['alert'] = "<script>alert('Activation code send your e-mail')</script>
		 <meta http-equiv='refresh' content='0; ".URL."login/?confirm=0&email=".$_POST['email']."'>";
         }
     else{
            $_SESSION['alert'] = "<script>alert('Login or e-mail created !')</script>";
        }
	}
	
	private function gen_pass($numb){
		$arr = array('a','b','c','d','e','f',  
                 'g','h','i','j','k','l',  
                 'm','n','o','p','r','s',  
                 't','u','v','x','y','z',  
                 'A','B','C','D','E','F',  
                 'G','H','I','J','K','L',  
                 'M','N','O','P','R','S',  
                 'T','U','V','X','Y','Z',  
                 '1','2','3','4','5','6',  
                 '7','8','9','0');
		$pass = "";
		for($i=1; $i<=$numb; $i++){
			$pass .= $arr[array_rand($arr,1)];
		}
		return $pass;
	}
	
    function activate($email, $user_name, $code = null){
		$dbclass = Database::dbase();
		if($code == null){
			$active = md5($this->gen_pass(8));
			$dbclass ->ubdate_table($this->tablename,array('activate'=>$active),array('email'=>$email));
			$this->send_email($email, $user_name, $active);
		}
		else {
			$user_val = $dbclass ->search_db($this->tablename,array('password', 'login', 'activate'),array('email' => $email, 'status'=>'inactivate'), ' and ');
			if(empty($user_val)){
				$_SESSION['alert'] = "<script>alert('Activation code is already used, login again !')</script> \n
										<meta http-equiv='refresh' content='0;".URL."login/?login'>";
				
			}
			else{
				if($code == $user_val[0]['activate']){
					$dbclass ->ubdate_table($this->tablename,array('status'=>'activate'),array('email'=>$email));
					$this->login_user($user_val[0]['login'],$user_val[0]['password']);
				}
				else{
					$_SESSION['alert'] = "<script>alert('Activated code not corect')</script>";
				}
			}
		}
    }
	
	function send_email($email, $user_name, $code, $login = 0){
		$mailer = new Sendmail();
		if($login === 0){
			$mailer -> activate_mail($email, $user_name, $code);
		}
		else{
			$mailer -> recovery($email, $user_name, $code, $login);
		}
	}
	
	function recovery_pass($email,$login){
		$dbclass = Database::dbase();
		$user_val = $dbclass ->search_db($this->tablename,array('status','real_name'),array('email' => $email,'login'=>$login), ' and ');
		if(empty($user_val) or $user_val[0]['status'] == 'delete'){
			$_SESSION['alert'] = "<script>alert('Login or e-mail is not corect')</script>\n
										<meta http-equiv='refresh' content='0;".URL."login/?recovery=0'>";
		}
		else{
			if($user_val[0]['status'] == 'inactivate'){
				$_SESSION['alert'] = "<script>alert('Your account is not activated')</script>\n
										<meta http-equiv='refresh' content='0;".URL."login/?confirm=0&email=$email'>";
			}
			elseif($user_val[0]['status'] == 'blocked'){
				$_SESSION['alert'] = "<script>alert('Your account is blocked administrator')</script>\n
										<meta http-equiv='refresh' content='0;".URL."login/?recovery=0'>";
			}
			else{
				$newpass = $this->gen_pass(8);
				$dbclass->ubdate_table($this->tablename,array('password'=>md5($newpass)),array('email'=>$email));
				$this->send_email($email, $user_val[0]['real_name'], $newpass, $login);
				$_SESSION['alert'] = "<script>alert('Your new password sended e-mail')</script> \n
										<meta http-equiv='refresh' content='0;".URL."login/?login'>";
			}
		}
	}
	
	function edit_user($post){
		$param = array();
		$seting = array();
		foreach($post as $key=>$value){
			if($value != null){
				if($key == 'id'){
					$param[$key] = $value;
				}
				elseif($key == 'password'){
					$seting[$key] = md5($value);
					$this->send_email($post['email'],$post['real_name'],$post['password'],$post['login']);
				}
				else{
					$seting[$key] = $value;
				}
			}
		}
		$dbclass = Database::dbase();
        $dbclass->ubdate_table($this->tablename, $seting, $param);
	}
	
	function login_user($user,$password){
		$dbclass = Database::dbase();
		$user_val= $dbclass->search_db($this->tablename,array('password', 'real_name', 'role', 'status', 'email', 'points', 'created', 'id'),array('login' => $user));

		if(!empty($user_val)){
			if($password == $user_val[0]['password']){
				if($user_val[0]['status'] == 'activate'){
					$_SESSION['user']['real_name'] = $user_val[0]['real_name'];
					$_SESSION['user']['email'] = $user_val[0]['email'];
					$_SESSION['user']['login'] = $user;
					$_SESSION['user']['points'] = $user_val[0]['points'];
					$_SESSION['user']['created'] = $user_val[0]['created'];
					$_SESSION['role'] = $user_val[0]['role'];
					$_SESSION['user']['id'] = $user_val[0]['id'];
					$_SESSION['user']['password'] = $user_val[0]['password'];
					$_SESSION['alert'] = ($user_val[0]['role'] == 'user')?"<meta http-equiv='refresh' content='0;".URL."user/?my_account'>":
																		"<meta http-equiv='refresh' content='0;".URL."admin/'>";
				}
				elseif($user_val[0]['status'] == 'inactivate'){
				$_SESSION['alert'] = "<script>alert('Your account is not activated')</script>\n
										<meta http-equiv='refresh' content='0;".URL."login/?confirm=0&email=".$user_val[0]['email']."'>";
				}
				elseif($user_val[0]['status'] == 'blocked'){
				$_SESSION['alert'] = "<script>alert('Your account is blocked administrator')</script>\n
										<meta http-equiv='refresh' content='0;".URL."login/?login'>";
				}
				else{
					$_SESSION['alert'] = "<script>alert('Login or password is not corect')</script>\n
					<meta http-equiv='refresh' content='0;".URL."login/?login'>";
				}
			}
			else{
                $_SESSION['alert'] = "<script>alert('Login or password is not corect')</script>\n
					<meta http-equiv='refresh' content='0;".URL."login/?login'>";
			}
		}
		else
                $_SESSION['alert'] = "<script>alert('Login or password is not corect')</script>\n
					<meta http-equiv='refresh' content='0;".URL."login/?login'>";
	}

	function logout_user(){
		session_unset();
		$_SESSION['alert'] = "<meta http-equiv='refresh' content='0;".URL."'>";
	}
}