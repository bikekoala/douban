<?PHP
class Douban_Service_Auth_Logout extends Douban_Service_Auth_Abstract
{
	public function run($params)
	{
		return Su_Func::cookie(self::COOKIE_KEY, null, -5, '');
	}
}
