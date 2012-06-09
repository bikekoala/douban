<?PHP
class Douban_Entity_Songs extends Douban_Entity_Abstract
{
	protected $table = 'songs';

	protected function getList($uid)
	{
		$sql = "SELECT * FROM {$this->table} WHERE `uid` = {$uid}";
		$sth = $this->pdo->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC); 
		try {
			$sth->execute();
			return $sth->fetchAll();
		} catch (PDOException $e) {
			throw new Exception($e->getMessage(), 500);
		}
	}

	protected function getCount($uid)
	{
		$sql = "SELECT COUNT(*) FROM {$this->table} WHERE `uid` = {$uid}";
		try {
			return $this->pdo->query($sql);
		} catch (PDOException $e) {
			throw new Exception($e->getMessage(), 500);
		}
	}

	protected function insert($uid, $list)
	{
		// prepare
		$mtime = date('Y-m-d H:i:s');
		$params = array();
		foreach ($list as $song) {
			$song['uid'] = $uid;
			$song['mtime'] = $mtime;
			$params[] = $song;
		}
		// relation
		$fields['uid'] = 'uid';
		$fields['sid'] = 'sid';
		$fields['aid'] = 'aid';
		$fields['title'] = 'title';
		$fields['artist'] = 'artist';
		$fields['albumtitle'] = 'albumtitle';
		$fields['company'] = 'company';
		$fields['album'] = 'album';
		$fields['subtype'] = 'subtype';
		$fields['picture'] = 'picture';
		$fields['url'] = 'url';
		$fields['mtime'] = 'mtime';
		// gen sql
		$sql = sprintf("INSERT INTO `%s`(%s) VALUE ", $table, implode(',', array_keys($fields)));
		foreach ($params as $song) {
			$str = '';
			foreach ($fields as $field) {
				$str .= sprintf("'%s'," $song[$field]);
			}
			$sql .= sprintf("(%s),", substr($str, 0, -1));
		}
		$sql = substr($sql, 0, -1);
		// batch insert
		$sth = $this->pdo->prepare($sql);
		try {
			return $sth->execute();
		} catch (PDOException $e) {
			throw new Exception($e->getMessage(), 500);
		}
	}
	
	protected  function del($uid, $sid = null)
	{
		$sql = "DELETE FROM {$this->table} WHERE `uid` = {$uid}";
		if ($sid) {
			$sql .= sprintf(" AND `sid` IN (%s)", implode(',', $sid));
		}
		$sth = $this->pdo->prepare($sql);
		try {
			return $sth->execute();
		} catch (PDOException $e) {
			throw new Exception($e->getMessage(), 500);
		}
	}

	public static function single()
	{
		static $instance;
		return $instance ? $instance : ($instance = new self());
	}
}
