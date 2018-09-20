<?php

/**
 * Copyright (c) 2018 Comet Licensing Ltd.
 * Please see the LICENSE file for usage information.
 * 
 * SPDX-License-Identifier: MIT
 */

namespace Comet;

class DestinationStatistics {
	
	/**
	 * @var \Comet\SizeMeasurement
	 */
	public $ClientProvidedSize = null;
	
	/**
	 * @var \Comet\ContentMeasurement
	 */
	public $ClientProvidedContent = null;
	
	/**
	 * @var string
	 */
	public $LastSuccessfulDeepVerify_GUID = "";
	
	/**
	 * @var int
	 */
	public $LastSuccessfulDeepVerify_StartTime = 0;
	
	/**
	 * @var int
	 */
	public $LastSuccessfulDeepVerify_EndTime = 0;
	
	/**
	 * Preserve unknown properties when dealing with future server versions.
	 *
	 * @see DestinationStatistics::RemoveUnknownProperties() Remove all unknown properties
	 * @var array
	 */
	private $__unknown_properties = [];
	
	/**
	 * Replace the content of this DestinationStatistics object from a PHP array.
	 * The data could be supplied from an API call after json_decode(..., true); or generated manually.
	 *
	 * @param array $decodedJsonObject Object data as PHP array
	 * @return void
	 */
	protected function inflateFrom(array $decodedJsonObject)
	{
		$this->ClientProvidedSize = \Comet\SizeMeasurement::createFrom(isset($decodedJsonObject['ClientProvidedSize']) ? $decodedJsonObject['ClientProvidedSize'] : []);
		
		$this->ClientProvidedContent = \Comet\ContentMeasurement::createFrom(isset($decodedJsonObject['ClientProvidedContent']) ? $decodedJsonObject['ClientProvidedContent'] : []);
		
		if (array_key_exists('LastSuccessfulDeepVerify_GUID', $decodedJsonObject)) {
			$this->LastSuccessfulDeepVerify_GUID = (string)($decodedJsonObject['LastSuccessfulDeepVerify_GUID']);
			
		}
		if (array_key_exists('LastSuccessfulDeepVerify_StartTime', $decodedJsonObject)) {
			$this->LastSuccessfulDeepVerify_StartTime = (int)($decodedJsonObject['LastSuccessfulDeepVerify_StartTime']);
			
		}
		if (array_key_exists('LastSuccessfulDeepVerify_EndTime', $decodedJsonObject)) {
			$this->LastSuccessfulDeepVerify_EndTime = (int)($decodedJsonObject['LastSuccessfulDeepVerify_EndTime']);
			
		}
		foreach($decodedJsonObject as $k => $v) {
			switch($k) {
			case 'ClientProvidedSize':
			case 'ClientProvidedContent':
			case 'LastSuccessfulDeepVerify_GUID':
			case 'LastSuccessfulDeepVerify_StartTime':
			case 'LastSuccessfulDeepVerify_EndTime':
				break;
			default:
				$this->__unknown_properties[$k] = $v;
			}
		}
	}
	
	/**
	 * Coerce a plain PHP array into a new strongly-typed DestinationStatistics object.
	 *
	 * @param array $decodedJsonObject Object data as PHP array
	 * @return DestinationStatistics
	 */
	public static function createFrom(array $decodedJsonObject)
	{
		$retn = new DestinationStatistics();
		$retn->inflateFrom($decodedJsonObject);
		return $retn;
	}
	
	/**
	 * Coerce a JSON string into a new strongly-typed DestinationStatistics object.
	 *
	 * @param string $JsonString Object data as JSON string
	 * @return DestinationStatistics
	 */
	public static function createFromJSON($JsonString)
	{
		$decodedJsonObject = json_decode($JsonString, true);
		if (\json_last_error() != \JSON_ERROR_NONE) {
			throw new \Exception("JSON decode failed: " . \json_last_error_msg());
		}
		$retn = new DestinationStatistics();
		$retn->inflateFrom($decodedJsonObject);
		return $retn;
	}
	
	/**
	 * Convert this DestinationStatistics object into a plain PHP array.
	 *
	 * @param bool $forJSONEncode Set true to use stdClass() for empty objects instead of just [], in order to
	 *                             accurately roundtrip empty objects/arrays through json_encode() compatibility
	 * @return array
	 */
	public function toArray($forJSONEncode=false)
	{
		$ret = [];
		if ( $this->ClientProvidedSize === null ) {
			$ret["ClientProvidedSize"] = $for_json_encode ? (object)[] : [];
		} else {
			$ret["ClientProvidedSize"] = $this->ClientProvidedSize->toArray($for_json_encode);
		}
		if ( $this->ClientProvidedContent === null ) {
			$ret["ClientProvidedContent"] = $for_json_encode ? (object)[] : [];
		} else {
			$ret["ClientProvidedContent"] = $this->ClientProvidedContent->toArray($for_json_encode);
		}
		$ret["LastSuccessfulDeepVerify_GUID"] = $this->LastSuccessfulDeepVerify_GUID;
		$ret["LastSuccessfulDeepVerify_StartTime"] = $this->LastSuccessfulDeepVerify_StartTime;
		$ret["LastSuccessfulDeepVerify_EndTime"] = $this->LastSuccessfulDeepVerify_EndTime;
		
		// Reinstate unknown properties from future server versions
		foreach($this->__unknown_properties as $k => $v) {
			if ($forJSONEncode && is_array($v) && count($v) == 0) {
				$ret[$k] = (object)[];
			} else {
				$ret[$k] = $v;
			}
		}
		
		// Special handling for empty objects
		if ($forJSONEncode && count($ret) === 0) {
			return new stdClass();
		}
		return $ret;
	}
	
	/**
	 * Convert this object to a JSON string.
	 * The result is suitable to submit to the Comet Server API.
	 *
	 * @return string
	 */
	public function toJSON()
	{
		return json_encode( self::toArray(true) );
	}
	
	/**
	 * Erase any preserved object properties that are unknown to this Comet Server SDK.
	 *
	 * @return void
	 */
	public function RemoveUnknownProperties()
	{
		$this->__unknown_properties = [];
		if ($this->ClientProvidedSize !== null) {
			$this->ClientProvidedSize->RemoveUnknownProperties();
		}
		if ($this->ClientProvidedContent !== null) {
			$this->ClientProvidedContent->RemoveUnknownProperties();
		}
	}
	
}

