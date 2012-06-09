<?PHP
class Douban_Service_List_Liked extends Douban_Service_Auth_Abstract
{
	public function run($params)
	{
		$start = $params['start'];
		$limit = $params['limit'];

		// read from db
		$list = $this->getList($start, $limit);
		exit;
		if (count($list) < $limit) {
			$list = $this->syncList($start, $limit);
		}
		return $list;
	}

	private function syncList($start, $limit)
	{
		// get online song list
		$conf = Douban_Config::single();
		$post['user_id'] = static::$auth['user_id'];
		$post['token'] = static::$auth['token'];
		$post['expire'] = static::$auth['expire'];
		$post['app_name'] = $conf['auth']['app'];
		$post['version'] = $conf['auth']['ver'];
		$post['count'] = $conf['list']['max'];
		$curl = new Su_Curl($conf['list']['liked']);
		$data = $curl->rest($post);
		$list = $data['r'] === 0 ? $data['songs'] : false;

		if ($list) {
			// merge

		} else {
			return  false;	
		}
	}

	private function getList($start, $limit)
	{
	}
}
