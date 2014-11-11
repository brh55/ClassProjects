<?php
// Define functions for modularity
	//Searches the inPho API
	function searchinPho_json($type, $id) {
	    $base = "https://inpho.cogs.indiana.edu";
	    $format = "json";
	    $url = $base . '/' . $type . '/' . $id . '.' . $format;
	    $data = @file_get_contents($url, o, null, null);
	    return $data;
	}

	//Searches by Ideas of original Philosopher
	function getRelatedThinkersByIdea($idea_ID) {
		$result = searchinPho_json('idea', $idea_ID);
		$json = json_decode($result);
		return $json->related_thinkers;
	}

	//Searches Thinker.json for ID based on value
	function findID($d) {
		$url = "https://inpho.cogs.indiana.edu/thinker.json";
		$data = @file_get_contents($url,o,null,null);
		$json = json_decode($data);
		$results = $json->responseData->results;
		foreach($results as $value) {
			if (strcasecmp($value->label,$d)==0) { 
				$id = $value->ID;
				break;
			}
		}
		//return value of $id when string matches
		return $id;
	}

	function objectToArray($d) {
		//if parameter is object. Retrieve properties
		if (is_object($d)) {
			//get the properties of the object
			$d = get_object_vars($d);
		}
		//if paramater is array. apply functions
		if (is_array($d)) {
			//apply current function to the array and return an array map
			return array_map('objectToArray', $d);
		}
		//return associative array
		else {
			return $d;
		}
	}
?>