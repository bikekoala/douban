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
		$start = is_numeric($this->request['start']) ? (int) $this->request['start'] : $this->start;
		$limit = is_numeric($this->request['limit']) ? (int)$this->request['limit'] : $this->limit;
		return compact('start', 'limit');
	}
}
