<?php
function login() {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if(!$this -> checkLoginInDB($username, $password)) {
		return false;
	}

	// server should keep session data for AT LEAST 1 hour
	ini_set('session.gc_maxlifetime', 7200);
	// each client should remember their session id for EXACTLY 1 hour
	session_set_cookie_params(7200);
	session_start();

	$_SESSION[$this -> getLoginSessionVar()] = $username;

	return true;
}

function checkLoginInDB($username, $password) {
	if(!$this -> DBLogin()) {
		$this -> HandleError("Database login failed.");
		return false;
	}

	$username = $this -> SanitizeForSQL($username);
	$pwdhash = hash('SHA512', $password);
	$qry = "SELECT username FROM $this->login ".
			" WHERE username='$username' AND password='$pwdhash' ";
}
