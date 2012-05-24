<?PHP
class Douban_Action_Auth_Logout extends Douban_Action_Abstract
{
	public function run()
	{
		$this->auth['auth'] && $this->service('Auth_Logout');
		$this->setResponse();
	}
}
