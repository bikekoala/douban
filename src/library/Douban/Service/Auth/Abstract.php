<?PHP
abstract class Douban_Service_Auth_Abstract extends Douban_Service_Abstract
{
	/**
	 * the key of cookie
	 */
	const COOKIE_KEY = 'suauth';
	/**
	 * 验证auth信息完整性的字符串 
	 */
	const SERIAL_SECRET = 'Let life be beautiful like summer flowers';

	/**
	 * cookie des加密的key
	 */
	const ENCRYPT_KEY 	= 'sukaifm';

	public function unserializeAuth($auth)
	{
		$auth = Su_Func::encrypt($auth, self::ENCRYPT_KEY, 'DECODE');
		$tmps = explode('|', $auth);
		if (count($tmps) != 7)  {
			throw new Su_Exc('Invalid suauth.', 400);
		}
		$arr['user_id'] = $tmps[0];
		$arr['user_name'] = $tmps[1];
		$arr['token'] = $tmps[2];
		$arr['expire'] = $tmps[3];
		$arr['ip'] = $tmps[4];
		$arr['timestamp'] = $tmps[5];
		if (crc32(implode('|', $arr) . self::SERIAL_SECRET) != $tmps[6]) {
			throw new Su_Exc('Auth validate fail.', 400);
		}
		return $arr;
	}

	public function serializeAuth($auth)
	{
		$auth[] = Su_Func::ip();
		$auth[] = time();
		$str = implode('|', $auth); 
		$str = $str . '|' . crc32($str . self::SERIAL_SECRET);
		return Su_Func::encrypt($str, self::ENCRYPT_KEY);
	}
}
