<?php
namespace SharePoint\PHP\Client;
require_once('AuthenticationContext.php');
class NtlmAuthenticationContext extends AuthenticationContext{
	
	public function __construct($url, $username, $password){
		parent::__construct($url, false);
		Requests::enableNtlmAuthentication($username, $password);
	}
	
	public function acquireTokenForUser($username,$password){
		$result = Requests::ntlmAuth($this->url, $username, $password, true);
		$this->cookies = Requests::parseCookies($result);
	}
	
}