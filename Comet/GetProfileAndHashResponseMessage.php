<?php

/**
 * Copyright (c) 2018 Comet Licensing Ltd.
 * Please see the LICENSE file for usage information.
 * 
 * SPDX-License-Identifier: MIT
 */

namespace Comet;

class GetProfileAndHashResponseMessage {
	
	/**
	 * @var int
	 */
	public $Status = 0;
	
	/**
	 * @var string
	 */
	public $Message = "";
	
	/**
	 * @var string
	 */
	public $ProfileHash = "";
	
	/**
	 * @var \Comet\UserProfileConfig
	 */
	public $Profile = null;
	
	/**
	 * Preserve unknown properties when dealing with future server versions.
	 *
	 * @see GetProfileAndHashResponseMessage::RemoveUnknownProperties() Remove all unknown properties
	 * @var array
	 */
	private $__unknown_properties = [];
	
	/**
	 * Replace the content of this GetProfileAndHashResponseMessage object from a PHP array.
	 * The data could be supplied from an API call after json_decode(..., true); or generated manually.
	 *
	 * @param array $decodedJsonObject Object data as PHP array
	 * @return void
	 */
	protected function inflateFrom(array $decodedJsonObject)
	{
		$this->Status = (int)($decodedJsonObject['Status']);
		
		$this->Message = (string)($decodedJsonObject['Message']);
		
		$this->ProfileHash = (string)($decodedJsonObject['ProfileHash']);
		
		$this->Profile = \Comet\UserProfileConfig::createFrom(isset($decodedJsonObject['Profile']) ? $decodedJsonObject['Profile'] : []);
		
		foreach($decodedJsonObject as $k => $v) {
			switch($k) {
			case 'Status':
			case 'Message':
			case 'ProfileHash':
			case 'Profile':
				break;
			default:
				$this->__unknown_properties[$k] = $v;
			}
		}
	}
	
	/**
	 * Coerce a plain PHP array into a new strongly-typed GetProfileAndHashResponseMessage object.
	 *
	 * @param array $decodedJsonObject Object data as PHP array
	 * @return GetProfileAndHashResponseMessage
	 */
	public static function createFrom(array $decodedJsonObject)
	{
		$retn = new GetProfileAndHashResponseMessage();
		$retn->inflateFrom($decodedJsonObject);
		return $retn;
	}
	
	/**
	 * Coerce a JSON string into a new strongly-typed GetProfileAndHashResponseMessage object.
	 *
	 * @param string $JsonString Object data as JSON string
	 * @return GetProfileAndHashResponseMessage
	 */
	public static function createFromJSON($JsonString)
	{
		$decodedJsonObject = json_decode($JsonString, true);
		if (\json_last_error() != \JSON_ERROR_NONE) {
			throw new \Exception("JSON decode failed: " . \json_last_error_msg());
		}
		$retn = new GetProfileAndHashResponseMessage();
		$retn->inflateFrom($decodedJsonObject);
		return $retn;
	}
	
	/**
	 * Convert this GetProfileAndHashResponseMessage object into a plain PHP array.
	 *
	 * @param bool $forJSONEncode Set true to use stdClass() for empty objects instead of just [], in order to
	 *                             accurately roundtrip empty objects/arrays through json_encode() compatibility
	 * @return array
	 */
	public function toArray($forJSONEncode=false)
	{
		$ret = [];
		$ret["Status"] = $this->Status;
		$ret["Message"] = $this->Message;
		$ret["ProfileHash"] = $this->ProfileHash;
		if ( $this->Profile === null ) {
			$ret["Profile"] = $for_json_encode ? (object)[] : [];
		} else {
			$ret["Profile"] = $this->Profile->toArray($for_json_encode);
		}
		
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
		if ($this->Profile !== null) {
			$this->Profile->RemoveUnknownProperties();
		}
	}
	
}

