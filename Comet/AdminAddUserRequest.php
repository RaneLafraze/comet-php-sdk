<?php

namespace Comet;

/** 
 * Comet Server AdminAddUser API 
 * Add a new user account
 * 
 * You must supply administrator authentication credentials to use this API.
 * This API requires the Auth Role to be enabled.
 */
class AdminAddUserRequest implements \Comet\NetworkRequest {
	
	/**
	 * New account username
	 *
	 * @var string
	 */
	protected $TargetUser = null;
	
	/**
	 * New account password
	 *
	 * @var string
	 */
	protected $TargetPassword = null;
	
	/**
	 * If set to 1, store and keep a password recovery code for the generated user (>= 18.3.9) (optional)
	 *
	 * @var int|null
	 */
	protected $StoreRecoveryCode = null;
	
	/**
	 * Construct a new AdminAddUserRequest instance.
	 *
	 * @param string $TargetUser New account username
	 * @param string $TargetPassword New account password
	 * @param int $StoreRecoveryCode If set to 1, store and keep a password recovery code for the generated user (>= 18.3.9) (optional)
	 */
	public function __construct($TargetUser, $TargetPassword, $StoreRecoveryCode = null)
	{
		$this->TargetUser = $TargetUser;
		$this->TargetPassword = $TargetPassword;
		$this->StoreRecoveryCode = $StoreRecoveryCode;
	}
	
	/**
	 * Get the URL where this POST request should be submitted to.
	 *
	 * @return string
	 */
	public function Endpoint()
	{
		return '/api/v1/admin/add-user';
	}
	
	/**
	 * Get the POST parameters for this request.
	 *
	 * @return string[]
	 */
	public function Parameters()
	{
		$ret = [];
		$ret["TargetUser"] = (string)($this->TargetUser);
		$ret["TargetPassword"] = (string)($this->TargetPassword);
		if ($this->StoreRecoveryCode !== null) {
			$ret["StoreRecoveryCode"] = (string)($this->StoreRecoveryCode);
		}
		return $ret;
	}
	
	/**
	 * Decode types used in a response to this request.
	 * Use any network library to make the request.
	 *
	 * @param int $responseCode HTTP response code
	 * @param string $body HTTP response body
	 * @return \Comet\APIResponseMessage 
	 * @throws Exception
	 */
	public static function ProcessResponse($responseCode, $body)
	{
		// Require expected HTTP 200 response
		if ($responseCode !== 200) {
			throw new Exception("Unexpected HTTP " . intval($responseCode) . " response");
		}
		
		// Decode JSON
		$decoded = \json_decode($body, true);
		if (\json_last_error() != \JSON_ERROR_NONE) {
			throw new Exception("JSON decode failed: " . \json_last_error_msg());
		}
		
		// Parse as CometAPIResponseMessage
		$ret = \Comet\APIResponseMessage::createFrom(isset($decoded) ? $decoded : []);
		
		return $ret;
	}
	
}

