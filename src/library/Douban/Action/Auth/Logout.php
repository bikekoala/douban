<?PHP
class Douban_Action_Auth_Logout extends Douban_Action_Abstract
{
	public function run()
	{
		if ($this->_auth['is_auth']) {
			$stat = $this->service('Auth_Logout');
		} else {
			$stat = $this->getAuthMessage();
		}
		$this->response($stat);
		$this->format(Su_Const::FT_JSON);
	}
}
