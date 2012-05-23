<?PHP
class Douban_Service_Auth_Logon extends Douban_Service_Auth_Abstract
{
	public function run($params)
	{
		$auth = $this->doAuth($params) && $this->cookie($auth);
		return $auth;
	}

	private function doAuth($params)
	{
		$conf = Douban_Config::single();
		$post['email'] = $params['username'];
		$post['password'] = $params['password'];
		$post['app_name'] = $conf['auth']['app'];
		$post['version'] = $conf['auth']['ver'];
		$curl = new Su_Curl($conf['auth']['api']);
		$data = json_decode($curl->post($post), true);
		return $data['r'] == 0 ? $data : false;
	}

	private function cookie($data)
	{
		$auth[] = $data['user_id'];
		$auth[] = $data['user_name'];
		$auth[] = $data['token'];
		$auth[] = $data['expire'];
		$auth = $this->serializeAuth($auth);
		Su_Func::cookie(self::COOKIE_KEY, $auth, 60*60*24*30, '');
	}
}
