<?PHP
abstract class Douban_Action_Abstract extends Su_Ctrl_Action
{
	protected $needAuth = true;
	protected $auth;

	public function execute()
	{
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
		if ( ! $this->needAuth && ! isset($params['is_auth'])) {
			$response['stat'] = null;
			$response['data'] = $params;
			$response['message'] = null;
		} else {
			$defaultAuth = $this->needAuth ? $this->auth['is_auth'] : null;
			$customAuth = isset($params['is_auth']) ? $params['is_auth'] : null;
			$isAuth = $defaultAuth || $customAuth;
			$response['stat'] = $isAuth;
			$response['data'] = isset($params['data']) ? $params['data'] : array();
			$response['message'] = $isAuth ? (isset($params['message']) ? $params['message'] : 'ok.') : 'Invalid auth.';
		}
		$this->response($response);
	}
}
