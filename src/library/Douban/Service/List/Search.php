<?PHP
class Douban_Service_List_Search extends Douban_Service_List_Abstract
{
	public function run($params)
	{
		$query = strtolower($params['query']);
		$list = $this->searchLocal($query);
		if (empty($list)) {
			$onlineList = $this->getOnlineList();
			$localList = $this->getLocalList();
			$newList = $this->sync($localList, $onlineList);
			$list = $this->searchOnline($query, $newList);
		}
		return $list;
	}

	private function searchLocal($query)
	{
		$uid = static::$auth['user_id'];
		return Douban_Entity_Songs::single()->search($uid, $query);
	}

	private function searchOnline($query, $list)
	{
		$songs = array();
		foreach ($list as $val) {
			$line = sprintf("%s@%s@%s", $val['title'] ,$val['artist'] ,$val['albumtitle']);
			false !== strpos(strtolower($line), $query) && $songs[] =$val;
		}
		return $songs;
	}
}
