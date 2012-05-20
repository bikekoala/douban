<?PHP
abstract class Douban_Action_Abstract extends Su_Ctrl_Action
{
	protected $_needAuth = true;
	protected $_isAuth;

	public function execute()
	{
		$this->_isAuth = $this->_needAuth ? $this->service('Auth_Check') : true;
		$this->run();
	}

	abstract public function run();

	public function service($serviceName, array $params = array())
	{
		$class = 'Douban_Service_' . $serviceName;
		return $class::getInstance()->run($params);
	}
}
