<?PHP
abstract class Douban_Action_Abstract extends Su_Ctrl_Action
{
	protected $_needAuth = true;
	protected $_auth;

	public function execute()
	{
		$this->_auth = $this->service('Auth_Check');
		$this->run();
	}

	abstract public function run();

	public function service($serviceName, array $params = array())
	{
		$class = 'Douban_Service_' . $serviceName;
		return $class::getInstance()->run($params);
	}

	public function getAuthMessage($isAuth = null)
	{
		$isAuth = $this->_auth['is_auth'] || $isAuth;
		$data['is_auth'] = $isAuth;
		$data['message'] = $isAuth ? 'ok.' : 'Invalid auth.';
		return $data;
	}
}
