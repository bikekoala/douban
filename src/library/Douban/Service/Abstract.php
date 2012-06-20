<?PHP
abstract class Douban_Service_Abstract
{
	/*
	 * global auth info
	 */
	static $auth;

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
