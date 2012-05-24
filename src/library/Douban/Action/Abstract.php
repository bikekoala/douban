<?PHP
abstract class Douban_Action_Abstract extends Su_Ctrl_Action
{
	protected $needAuth = true;
	protected $auth;

	public function execute()
	{
		$this->format(Su_Const::FT_JSON);
		$this->auth = $this->service('Auth_Check');
		$this->run();
	}

	abstract public function run();

	public function service($serviceName, array $params = array())
	{
		$class = 'Douban_Service_' . $serviceName;
		return $class::getInstance()->run($params);
	}

	public function setResponse(array $params = array())
	{
		if ( ! $this->needAuth && ! isset($params['auth'])) {
			$content['auth'] = null;
			$content['data'] = $params;
			$content['error'] = null;
		} else {
			$defaultAuth = $this->needAuth ? $this->auth['auth'] : null;
			$customAuth = isset($params['auth']) ? $params['auth'] : null;
			$isAuth = $defaultAuth || $customAuth;
			$content['auth'] = $isAuth;
			$content['data'] = isset($params['data']) ? $params['data'] : array();
			$content['error'] = $isAuth ? (isset($params['error']) ? $params['error'] : 'ok.') : 'Invalid auth.';
		}
		$this->response($content);
	}
}
