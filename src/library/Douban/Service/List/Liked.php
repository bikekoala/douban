<?PHP
class Douban_Service_List_Liked extends Douban_Service_List_Abstract
{
	public function run($params)
	{
		$start = $params['start'];
		$limit = $params['limit'];

		$list = $this->getStoreList($start, $limit);
		if (count($list) < $limit) {
			$onlineList = $this->getOnlineList();
			$storeList = $this->getStoreList();
			$newList = $this->sync($storeList, $onlineList);
			$list = array_slice(array_merge($list, $newList), 0, $limit);
		}
		return $list;
	}
}
