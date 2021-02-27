<?php
/**
* @author John Smith <john@smith.com>
* @package WebServices
* @subpackage Authentication
* @copyright John Smith and Son
* @license http://www.johnsmith.com/copyright/license.html Not Free
*/
/**
* <i>AuthAccounts</i> class
*
* This class implements the login method needed to handle
* actual user authentication. It extends <i>Authentication</i>
* and implements the <i>Accountable</i> interface.
*
* @package WebServices
* @subpackage Authentication
* @see Authentication
* @author John Smith <john@smith.com>
* @version 0.3
* @since r12
*/
class AuthAccounts extends Authentication{
	/**
	* Reference to <i>Users</i> object
	* @access private
	* @var users
	*/
	private $users;
	/**
	* AuthAccounts constructor
	*
	* Instantiates a new {@link User} object and stores a reference
	* in the {@link users} property.
	*
	* @see User
	* @access public
	* @return void
	*/
	public function __construct(){
		$this->users = new Users();
	}
	/**
	* login method
	*
	* Uses the reference {@link User} class to handle
	* user validation.
	*
	* @see User
	* @todo Decide which validate method to user instead of both
	* @access public
	* @param string $user account user name
	* @param string $password account password
	* @return boolean
	*/
	public function login($user, $password){
		if (empty($user) || empty($password)) {
			return false;
		} else {
			// ��������� ����� ��� ������ ���������. ������ �������� ���.
			// ����������� ����� ������ User ��� ��������� ��������
			$firstValidation = Users::validate($user, $password);
			// '���������' ����� ������ User validate<username>($password)
			$userLoginFunction = 'validate' . $user;
			$secondValidation = $this->users->$userLoginFunction($password);
			return ($firstValidation && $secondValidation);
		}
	}
}
?>