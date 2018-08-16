<?php

namespace Comet;

/** 
 * Comet Server AdminNewsRemove API 
 * Remove news entry
 * 
 * You must supply administrator authentication credentials to use this API.
 * This API requires the Auth Role to be enabled.
 */
class AdminNewsRemoveRequest implements \Comet\NetworkRequest {
	
	/**
	 * Selected news item GUID
	 *
	 * @var string
	 */
	protected $NewsItem = null;
	
	/**
	 * Construct a new AdminNewsRemoveRequest instance.
	 *
	 * @param string $NewsItem Selected news item GUID
	 */
	public function __construct($NewsItem)
	{
		$this->NewsItem = $NewsItem;
	}
	
	/**
	 * Get the URL where this POST request should be submitted to.
	 *
	 * @return string
	 */
	public function Endpoint()
	{
		return '/api/v1/admin/news/remove';
	}
	
	/**
	 * Get the POST parameters for this request.
	 *
	 * @return string[]
	 */
	public function Parameters()
	{
		$ret = [];
		$ret["NewsItem"] = (string)($this->NewsItem);
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

