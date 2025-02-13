<?php

namespace Zamzar;

/**
 * File Object
 */
class File extends ApiResource
{

    /** Valid API Operations for this Class */
    use \Zamzar\ApiOperations\Delete;
    use \Zamzar\ApiOperations\Download;

	/** Properties */
	private $id;
	private $key;
	private $name;
	private $size;
	private $format;
	private $created_at;

	/**
	 * Initialise a new instance of the File object
	 */
	public function __construct($config, $data) 
	{
		$this->apiInit($config, $data->id);
		$this->setValues($data);
	}

	/**
	 * Cast to string
	 */
	public function __toString() 
	{
		return $this->id . '-' . $this->name; 
	}

	/**
	 * Initialise or Update properties
	 */
	private function setValues($data) {
		
		// Should always be supplied
		$this->id = $data->id;
		$this->name = $data->name;
		$this->size = $data->size;

		// Optionally supplied depending on endpoint
		if(property_exists($data, "key")) {
			$this->key = $data->key;
		}
		if(property_exists($data, "format")) {
			$this->format = $data->format;
		}
		if(property_exists($data, "created_at")) {
			$this->created_at = $data->created_at;
		}

	}

	/**
	 * Convert this file (which already exists on Zamzar)
	 * Specify target_format in the params
	 */
	public function convert($params) {
		$params['source_file'] = $this->getId();
		$jobs = new \Zamzar\Jobs($this->getConfig());
		return $jobs->submit($params);
	}

	/**
	 * Get the value of id
	 */ 
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the value of key
	 */ 
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * Get the value of name
	 */ 
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the value of size
	 */ 
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Get the value of format
	 */ 
	public function getFormat()
	{
		return $this->format;
	}

	/**
	 * Get the value of created_at
	 */ 
	public function getCreatedAt()
	{
		return $this->created_at;
	}
	
}

