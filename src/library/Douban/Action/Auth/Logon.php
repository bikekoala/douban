<?PHP
class Douban_Action_Auth_Logon extends Douban_Action_Abstract
{
	protected $_needAuth = false;

	public function run()
	{
		$params = $this->_filter();
		$stat = $params ? $this->service('Auth_Logon', $params) : false;;
		$this->response($stat);
		$this->format(Su_Const::FT_JSON);
	}
	
	private function _filter()
	{
		$username = $this->request->filter('username', FILTER_SANITIZE_STRING, null, INPUT_POST);
		$password = $this->request->filter('password', FILTER_SANITIZE_STRING, null, INPUT_POST);
		if ($username && $password) {
			return compact('username', 'password');
		}
	}
}
