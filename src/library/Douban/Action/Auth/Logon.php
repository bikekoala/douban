<?PHP
class Douban_Action_Auth_Logon extends Douban_Action_Abstract
{
	protected $needAuth = false;

	public function run()
	{
		$request = $this->filter();
		$request && $isAuth = $this->service('Auth_Logon', $request);
		$this->setResponse(array('auth' => $isAuth));
		$this->format(Su_Const::FT_JSON);
	}
	
	private function filter()
	{
		$username = $this->request->filter('username', FILTER_SANITIZE_STRING, null, INPUT_POST);
		$password = $this->request->filter('password', FILTER_SANITIZE_STRING, null, INPUT_POST);
		if ($username && $password) {
			return compact('username', 'password');
		}
	}
}
