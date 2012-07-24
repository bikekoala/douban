<?PHP
class Douban_Service_List_Liked extends Douban_Service_List_Abstract
{
	private $refreshLength = 4; // hours

	public function run($params)
	{
		$start = $params['start'];
		$limit = $params['limit'];

		$list = $this->getList($start, $limit);
		return $this->output($list);
	}

	private function getList($start, $limit)
	{
		$list = $this->getLocalList($start, $limit);
		if ($this->needRefresh($list)) {
			$onlineList = $this->getOnlineList();
			$this->refresh($onlineList);
			$list = $this->getLocalList($start, $limit);
		} elseif (count($list) < $limit) {
			$onlineList = $this->getOnlineList();
			$localList = $this->getLocalList();
			$newList = $this->sync($localList, $onlineList);
			$list = array_slice(array_merge($list, $newList), 0, $limit);
		}
		return $list;
	}

	private function needRefresh($list)
	{
		$need = true;
		if ( ! empty($list)) {
			$now = time();
			$local = strtotime($list[0]['mtime']);
			$length = $this->refreshLength * 3600;
			$need = $local+$length < $now;
		}
		return $need;
	}

	private function output($list)
	{
		$newList = array();
		foreach ($list as $val) {
			$song = array();
			$song['title'] = $val['title'];
			$song['artist'] = $val['artist'];
			$song['albumtitle'] = $val['albumtitle'];
			$song['public_time'] = $val['public_time'];
			$song['album'] = 'http://music.douban.com/subject/' . $val['aid'] . '/';
			$song['picture'] = $val['picture'];
			$song['url'] = $val['url'];
			$newList[] = $song;
		}
		return $newList;
	}
}
