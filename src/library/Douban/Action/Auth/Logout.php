<?PHP
class Douban_Action_Auth_Logout extends Douban_Action_Abstract
{
	public function run()
	{
		$this->_isAuth && $this->service('Auth_Logout');

		$result['auth'] = $this->_isAuth;
		$result['message'] = $this->_isAuth ? Douban_Const::AUTH_SUCCESS : Douban_Const::AUTH_FAIL;

		$this->response($result);
		$this->format(Su_Const::FT_JSON);
	}
}
