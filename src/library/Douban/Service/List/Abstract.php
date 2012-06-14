<?PHP
class Douban_Service_List_Liked extends Douban_Service_Abstract
{
	public function getOnlineList()
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
		return $data['r'] === 0 ? $data['songs'] : array();
	}

	public function getStoreList($start = null, $limit = null)
	{
		$uid = static::$auth['user_id'];
		return Douban_Entity_Songs::single()->getList($uid, $start, $limit);
	}

	public function sync($storeList, $onlineList)
	{
		$storeSid = array();
		foreach ($storeList as $val) {
			$storeSid[] = $val['sid'];
		}
		$onlineSid = array();
		foreach ($onlineList as $val) {
			$onlineSid[] = $val['sid'];	
		}

		// add like songs
		$addList = array_diff($onlineSid, $storeSid);
		$newList = $this->add($addList, $onlineList);
		// del unlike songs
		$delList = array_diff($storeSid, $onlineSid);
		$this->del($delList);	

		return $newList;
	}

	public function add($sid, $list)
	{
		$arr = array();
		foreach ($sid as $id) {
			foreach ($list as $info) {
				if( $id === $info['sid']) {
					$arr[] = $info;
				}
			}
		}
		if ( ! empty($arr)) {
			$uid = static::$auth['user_id'];
			Douban_Entity_Songs::single()->insert($uid, $arr);
		}
		return $arr;
	}

	public function del($sid)
	{
		if ( ! empty($sid)) {
			$uid = static::$auth['user_id'];
			Douban_Entity_Songs::single()->del($uid, $sid);
		}
	}
}
