<?PHP
class Douban_Action_List_Get_Liked extends Douban_Action_Abstract
{
	public function run()
	{
		$request = $this->filter();
		$list = $this->service('List_Get_Liked', $request);
		$this->setResponse(array('data' => $list));
	}
	
	private function filter()
	{
		$start = is_numeric($this->request['start']) ? (int) $this->request['start'] : null;
		$limit = is_numeric($this->request['limit']) ? (int)$this->request['limit'] : null;
		return compact('start', 'limit');
	}
}
