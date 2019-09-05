<?php
/**
 * lsys wechat api
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS\Wechat;
/**
 * 默认系统异常处理
 * @author lonely
 *
 */
class Exception extends \Exception {
	/**
	 * Creates a new translated exception.
	 *
	 *     throw new Exception('Something went terrible wrong');
	 *
	 * @param   string          $message    error message
	 * @param   array           $variables  translation variables
	 * @param   integer|string  $code       the exception code
	 * @param   Exception       $previous   Previous exception
	 * @return  void
	 */
	public function __construct($message = "", $code = 0, \Exception $previous = NULL)
	{
		// Pass the message and integer code to the parent
		parent::__construct($message, (int) $code, $previous);
		// Save the unmodified code
		// @link http://bugs.php.net/39615
		$this->code = $code;
	}
}