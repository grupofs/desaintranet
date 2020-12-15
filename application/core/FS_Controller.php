<?php

/**
 * Class FS_Controller
 */
class FS_Controller extends CI_Controller
{

	/**
	 * variable para responder los ajax
	 *
	 * @var array
	 */
	protected $result = ["status" => 500, "message" => "", "data" => []];

	/**
	 * VC_Controller constructor.
	 * @see initSystem
	 */
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Lima');
	}

}
