<?PHP
class Douban_Service_List_Get_Liked extends Douban_Service_Auth_Abstract
{
	public function run($params)
	{
		return $this->getList($params);
	}

	private function getList($params)
	{
		$conf = Douban_Config::single();
		$post['app_name'] = $conf['auth']['app'];
		$post['version'] = $conf['auth']['ver'];
		$post['user_id'] = static::$auth['user_id'];
		$post['token'] = static::$auth['token'];
		$post['expire'] = static::$auth['expire'];
		$curl = new Su_Curl($conf['list']['liked']);
		$data = $curl->rest($post);
		return $data['r'] === 0 ? $data['songs'] : false;
	}
}
