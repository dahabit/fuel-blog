<?php
/**
 * Common Controller for the Frontend
 *
 * @package    PhoenixCMS
 *
 * @author     Weztec Limited
 * @license    Proprietary
 * @copyright  2012 Weztec Limited
 * @link       http://www.weztec.com
 *
 * @version    2.0
 * @author     Daniel Berry
 * @link       http://berrymediagroup.com
 * @email      daniel@berrymediagroup.com
 * @created    2/2/12 2:00 PM
 */

class Controller_Common extends Controller_Template
{
	protected $view = '';
	protected $data = array();

	/**
	 * @var string require_login
	 * always assume we need a valid login.
	 */
	public $require_login = true;

	/**
	 * @var string template
	 * set to null to allow for setting to instance of the theme class.
	 */
	public $template = null;

	/**
	 * perform routing/redirections to keep out of the before()
	 *
	 * @param $method
	 * @param $args
	 * @return mixed
	 */
	public function router($method, $args)
	{
		// redirect to login if login is required and no user exists
		if ($this->require_login === true and !Sentry::check()) {
			Response::redirect(Uri::create(Config::get('user.auth.login_url')));
		}

		// call the called method
		return call_user_func_array(array($this, 'action_' . $method), $args);
	}

	/**
	 * setup the class.
	 *
	 */
	public function before()
	{

		// load the default page template if none is defined
		if ( !$this->template instanceOf View)
		{
			$this->template = Theme::instance()->view('templates/default');
		}

		// must have this.
		parent::before();

		// if the user is logged in, let's assign the user object to a usable var.
		if (Sentry::check()) {
			$this->template->set_global('user', Sentry::user());
		}
	}

	/**
	 * @param null $response
	 * @return mixed
	 */
	public function after($response = null)
	{
		/*
		 * if no view has been assigned, let's create one!
		 * This takes the class name & method and assigns a view based on that.
		 */

		if (empty($this->view))
		{
			$module = Request::active()->module;
			$controller = Str::lower(preg_replace(array('/^Controller_/', '/_/'), array('', '/'), Inflector::denamespace(get_called_class())));
			$method = Request::active()->action;

			$this->view = "{$module}/{$controller}/{$method}";

			try
			{
				// assign the template content
				$this->template->content = Theme::instance()->view($this->view, $this->data);
			}
			catch(\ThemeException $e)
			{
				$this->template->content = View::forge($this->view, $this->data);
			}
		}

		return parent::after(null);
	}
}

/* end of /app/classes/controller/common.php */