<?php

namespace Comet;

/** 
 * Comet Server AdminAccountRegenerateTotp API 
 * Generate a new TOTP secret
 * The secret is returned as a `data-uri` image of a QR code. The new secret is immediately applied to the current admin account.
 * 
 * You must supply administrator authentication credentials to use this API.
 */
class AdminAccountRegenerateTotpRequest implements \Comet\NetworkRequest {
	
	/**
	 * Construct a new AdminAccountRegenerateTotpRequest instance.
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
		return '/api/v1/admin/account/regenerate-totp';
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
	 * @return \Comet\TotpRegeneratedResponse 
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
		
		// Parse as TotpRegeneratedResponse
		$ret = \Comet\TotpRegeneratedResponse::createFrom(isset($decoded) ? $decoded : []);
		
		return $ret;
	}
	
}

