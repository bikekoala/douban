<?PHP
class Douban_Action_List_Liked extends Douban_Action_Abstract
{
	private $start = 0;
	private $limit = 10;

	public function run()
	{
		$request = $this->filter();
		$list = $this->service('List_Liked', $request);
		$this->setResponse(array('data' => $list));
	}
	
	private function filter()
	{
		$start = (int) $this->request['start'];
		$limit = (int) $this->request['limit'];
		$start = $start > 0 ? $start : $this->start;
		$limit = $limit > 0 ? $limit : $this->limit;
		return compact('start', 'limit');
	}
}
