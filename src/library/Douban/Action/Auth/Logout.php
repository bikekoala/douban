<?PHP
class Douban_Action_Auth_Logout extends Douban_Action_Abstract
{
	public function run()
	{
		$this->auth['is_auth'] && $this->service('Auth_Logout');
		$this->setResponse();
		$this->format(Su_Const::FT_JSON);
	}
}
