<?PHP
class Douban_Service_Auth_Check extends Douban_Service_Auth_Abstract
{
	public function run($params)
	{
		$cookie = $_COOKIE[self::COOKIE_KEY];
		$stat['is_auth'] = isset($cookie);
		$stat['info'] = isset($cookie) ? $this->unserializeAuth($cookie) : array();
		return $stat;
	}
}
