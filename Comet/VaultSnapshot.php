<?php

namespace Comet;

class VaultSnapshot {
	
	/**
	 * @var string
	 */
	public $Snapshot = "";
	
	/**
	 * @var string
	 */
	public $Source = "";
	
	/**
	 * @var int
	 */
	public $CreateTime = 0;
	
	/**
	 * Preserve unknown properties when dealing with future server versions.
	 *
	 * @see VaultSnapshot::RemoveUnknownProperties() Remove all unknown properties
	 * @var array
	 */
	private $__unknown_properties = [];
	
	/**
	 * Replace the content of this VaultSnapshot object from a PHP array.
	 * The data could be supplied from an API call after json_decode(..., true); or generated manually.
	 *
	 * @param array $decodedJsonObject Object data as PHP array
	 * @return void
	 */
	protected function inflateFrom(array $decodedJsonObject)
	{
		$this->Snapshot = (string)($decodedJsonObject['Snapshot']);
		
		$this->Source = (string)($decodedJsonObject['Source']);
		
		$this->CreateTime = (int)($decodedJsonObject['CreateTime']);
		
		foreach($decodedJsonObject as $k => $v) {
			switch($k) {
			case 'Snapshot':
			case 'Source':
			case 'CreateTime':
				break;
			default:
				$this->__unknown_properties[$k] = $v;
			}
		}
	}
	
	/**
	 * Coerce a plain PHP array into a new strongly-typed VaultSnapshot object.
	 *
	 * @param array $decodedJsonObject Object data as PHP array
	 * @return VaultSnapshot
	 */
	public static function createFrom(array $decodedJsonObject)
	{
		$retn = new VaultSnapshot();
		$retn->inflateFrom($decodedJsonObject);
		return $retn;
	}
	
	/**
	 * Coerce a JSON string into a new strongly-typed VaultSnapshot object.
	 *
	 * @param string $JsonString Object data as JSON string
	 * @return VaultSnapshot
	 */
	public static function createFromJSON($JsonString)
	{
		$decodedJsonObject = json_decode($JsonString, true);
		if (\json_last_error() != \JSON_ERROR_NONE) {
			throw new \Exception("JSON decode failed: " . \json_last_error_msg());
		}
		$retn = new VaultSnapshot();
		$retn->inflateFrom($decodedJsonObject);
		return $retn;
	}
	
	/**
	 * Convert this VaultSnapshot object into a plain PHP array.
	 *
	 * @param bool $forJSONEncode Set true to use stdClass() for empty objects instead of just [], in order to
	 *                             accurately roundtrip empty objects/arrays through json_encode() compatibility
	 * @return array
	 */
	public function toArray($forJSONEncode=false)
	{
		$ret = [];
		$ret["Snapshot"] = $this->Snapshot;
		$ret["Source"] = $this->Source;
		$ret["CreateTime"] = $this->CreateTime;
		
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
	}
	
}

