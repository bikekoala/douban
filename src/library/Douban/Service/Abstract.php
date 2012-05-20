<?PHP
class Douban_Service_Abstract
{
	public static function getInstance()
	{
		static $instance;
		if ( ! $instance instanceof self) {
			$self = get_called_class();
			$instance = new $self();
		}
		return $instance;
	}
}
