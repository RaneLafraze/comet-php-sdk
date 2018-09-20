<?php

/**
 * Copyright (c) 2018 Comet Licensing Ltd.
 * Please see the LICENSE file for usage information.
 * 
 * SPDX-License-Identifier: MIT
 */

namespace Comet;

/** 
 * Comet Server AdminPoliciesNew API 
 * Create a new policy object
 * 
 * You must supply administrator authentication credentials to use this API.
 * This API requires the Auth Role to be enabled.
 */
class AdminPoliciesNewRequest implements \Comet\NetworkRequest {
	
	/**
	 * The policy data
	 *
	 * @var \Comet\GroupPolicy
	 */
	protected $Policy = null;
	
	/**
	 * Construct a new AdminPoliciesNewRequest instance.
	 *
	 * @param \Comet\GroupPolicy $Policy The policy data
	 */
	public function __construct(GroupPolicy $Policy)
	{
		$this->Policy = $Policy;
	}
	
	/**
	 * Get the URL where this POST request should be submitted to.
	 *
	 * @return string
	 */
	public function Endpoint()
	{
		return '/api/v1/admin/policies/new';
	}
	
	/**
	 * Get the POST parameters for this request.
	 *
	 * @return string[]
	 */
	public function Parameters()
	{
		$ret = [];
		$ret["Policy"] = $this->Policy->toJSON();
		return $ret;
	}
	
	/**
	 * Decode types used in a response to this request.
	 * Use any network library to make the request.
	 *
	 * @param int $responseCode HTTP response code
	 * @param string $body HTTP response body
	 * @return \Comet\CreateGroupPolicyResponse 
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
			if ($carm->Status !== 200) {
				throw new \Exception("Error " . $carm->Status . ": " . $carm->Message);
			}
		}
		
		// Parse as CreateGroupPolicyResponse
		$ret = \Comet\CreateGroupPolicyResponse::createFrom(isset($decoded) ? $decoded : []);
		
		return $ret;
	}
	
}

