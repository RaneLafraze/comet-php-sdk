<?php

namespace Comet;

/** 
 * Comet Server AdminAccountU2fSubmitChallengeResponse API 
 * Register a new FIDO U2F token
 * 
 * You must supply administrator authentication credentials to use this API.
 */
class AdminAccountU2fSubmitChallengeResponseRequest implements \Comet\NetworkRequest {
	
	/**
	 * Associated value from AdminAccountU2fRequestRegistrationChallenge API
	 *
	 * @var string
	 */
	protected $U2FChallengeID = null;
	
	/**
	 * U2F response data supplied by hardware token
	 *
	 * @var string
	 */
	protected $U2FClientData = null;
	
	/**
	 * U2F response data supplied by hardware token
	 *
	 * @var string
	 */
	protected $U2FRegistrationData = null;
	
	/**
	 * U2F response data supplied by hardware token
	 *
	 * @var string
	 */
	protected $U2FVersion = null;
	
	/**
	 * Optional description of the token
	 *
	 * @var string
	 */
	protected $Description = null;
	
	/**
	 * Construct a new AdminAccountU2fSubmitChallengeResponseRequest instance.
	 *
	 * @param string $U2FChallengeID Associated value from AdminAccountU2fRequestRegistrationChallenge API
	 * @param string $U2FClientData U2F response data supplied by hardware token
	 * @param string $U2FRegistrationData U2F response data supplied by hardware token
	 * @param string $U2FVersion U2F response data supplied by hardware token
	 * @param string $Description Optional description of the token
	 */
	public function __construct($U2FChallengeID, $U2FClientData, $U2FRegistrationData, $U2FVersion, $Description)
	{
		$this->U2FChallengeID = $U2FChallengeID;
		$this->U2FClientData = $U2FClientData;
		$this->U2FRegistrationData = $U2FRegistrationData;
		$this->U2FVersion = $U2FVersion;
		$this->Description = $Description;
	}
	
	/**
	 * Get the URL where this POST request should be submitted to.
	 *
	 * @return string
	 */
	public function Endpoint()
	{
		return '/api/v1/admin/account/u2f/submit-challenge-response';
	}
	
	/**
	 * Get the POST parameters for this request.
	 *
	 * @return string[]
	 */
	public function Parameters()
	{
		$ret = [];
		$ret["U2FChallengeID"] = (string)($this->U2FChallengeID);
		$ret["U2FClientData"] = (string)($this->U2FClientData);
		$ret["U2FRegistrationData"] = (string)($this->U2FRegistrationData);
		$ret["U2FVersion"] = (string)($this->U2FVersion);
		$ret["Description"] = (string)($this->Description);
		return $ret;
	}
	
	/**
	 * Decode types used in a response to this request.
	 * Use any network library to make the request.
	 *
	 * @param int $responseCode HTTP response code
	 * @param string $body HTTP response body
	 * @return \Comet\APIResponseMessage 
	 * @throws \Exception
	 */
	public static function ProcessResponse($responseCode, $body)
	{
		// Require expected HTTP 200 response
		if ($responseCode !== 200) {
			throw new \Exception("Unexpected HTTP " . intval($responseCode) . " response");
		}
		
		// Decode JSON
		$decoded = \json_decode($body, true);
		if (\json_last_error() != \JSON_ERROR_NONE) {
			throw new \Exception("JSON decode failed: " . \json_last_error_msg());
		}
		
		// Try to parse as error format
		$isCARMDerivedType = (array_key_exists('Status', $decoded) && array_key_exists('Message', $decoded));
		if ($isCARMDerivedType) {
			$carm = \Comet\APIResponseMessage::createFrom($decoded);
			if ($carm->Status !== 0 || $carm->Message != "") {
				throw new \Exception("Error " . $carm->Status . ": " . $carm->Message);
			}
		}
		
		// Parse as CometAPIResponseMessage
		$ret = \Comet\APIResponseMessage::createFrom(isset($decoded) ? $decoded : []);
		
		return $ret;
	}
	
}

