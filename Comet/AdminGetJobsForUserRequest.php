<?php

namespace Comet;

/** 
 * Comet Server AdminGetJobsForUser API 
 * Get jobs (for user)
 * The jobs are returned in an unspecified order.
 * 
 * You must supply administrator authentication credentials to use this API.
 * This API requires the Auth Role to be enabled.
 */
class AdminGetJobsForUserRequest implements \Comet\NetworkRequest {
	
	/**
	 * Selected username
	 *
	 * @var string
	 */
	protected $TargetUser = null;
	
	/**
	 * Construct a new AdminGetJobsForUserRequest instance.
	 *
	 * @param string $TargetUser Selected username
	 */
	public function __construct($TargetUser)
	{
		$this->TargetUser = $TargetUser;
	}
	
	/**
	 * Get the URL where this POST request should be submitted to.
	 *
	 * @return string
	 */
	public function Endpoint()
	{
		return '/api/v1/admin/get-jobs-for-user';
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
		return $ret;
	}
	
	/**
	 * Decode types used in a response to this request.
	 * Use any network library to make the request.
	 *
	 * @param int $responseCode HTTP response code
	 * @param string $body HTTP response body
	 * @return \Comet\BackupJobDetail[] 
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
		
		// Try to parse as error format
		if (array_key_exists('Status', $decoded) && array_key_exists('Message', $decoded)) {
			$carm = \Comet\APIResponseMessage::createFrom($decoded);
			if ($carm->Status !== 0 || $carm->Message != "") {
				throw new \Exception("Error " . $carm->Status . ": " . $carm->Message);
			}
		}
		
		// Parse as []BackupJobDetail
		$val_0 = [];
		for($i_0 = 0; $i_0 < count($decoded); ++$i_0) {
			$val_0[] = \Comet\BackupJobDetail::createFrom(isset($decoded[$i_0]) ? $decoded[$i_0] : []);
		}
		$ret = $val_0;
		
		return $ret;
	}
	
}

