<?PHP
class Douban_Service_Auth_Check extends Douban_Service_Auth_Abstract
{
	public function run($params)
	{
		$cookie = $_COOKIE[self::COOKIE_KEY];
		$stat['auth'] = isset($cookie);
		$stat['data'] = isset($cookie) ? $this->unserializeAuth($cookie) : array();
		return $stat;
	}
}
