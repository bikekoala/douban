<?PHP
class Douban_Service_List_Liked extends Douban_Service_List_Abstract
{
	public function run($params)
	{
		$start = $params['start'];
		$limit = $params['limit'];

		$list = $this->getLocalList($start, $limit);
		if (count($list) < $limit) {
			$onlineList = $this->getOnlineList();
			$LocalList = $this->getLocalList();
			$newList = $this->sync($LocalList, $onlineList);
			$list = array_slice(array_merge($list, $newList), 0, $limit);
		}
		return $list;
	}
}
