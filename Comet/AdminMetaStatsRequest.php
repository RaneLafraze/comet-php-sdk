<?php

namespace Comet;

/** 
 * Comet Server AdminMetaStats API 
 * Get Comet Server historical statistics
 * 
 * You must supply administrator authentication credentials to use this API.
 */
class AdminMetaStatsRequest implements \Comet\NetworkRequest {
	
	/**
	 * Construct a new AdminMetaStatsRequest instance.
	 *
	 */
	public function __construct()
	{
	}
	
	/**
	 * Get the URL where this POST request should be submitted to.
	 *
	 * @return string
	 */
	public function Endpoint()
	{
		return '/api/v1/admin/meta/stats';
	}
	
	/**
	 * Get the POST parameters for this request.
	 *
	 * @return string[]
	 */
	public function Parameters()
	{
		$ret = [];
		return $ret;
	}
	
	/**
	 * Decode types used in a response to this request.
	 * Use any network library to make the request.
	 *
	 * @param int $responseCode HTTP response code
	 * @param string $body HTTP response body
	 * @return \Comet\StatResult[] An array with int keys. 
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
		
		// Parse as map[int64]StatResult
		$val_0 = [];
		foreach($decoded as $k_0 => $v_0) {
			$phpk_0 = (int)($k_0);
			$phpv_0 = \Comet\StatResult::createFrom(isset($v_0) ? $v_0 : []);
			$val_0[$phpk_0] = $phpv_0;
		}
		$ret = $val_0;
		
		return $ret;
	}
	
}

