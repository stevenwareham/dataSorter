<?php

	//Sample of an array we can sort using DataSorter
	$data = array();

	$data[] = array('id' => 1, 'number' => '130', 	'street' => 'Battery St', 		'unit' => '1', 	'rent' => 1200);
	$data[] = array('id' => 2, 'number' => '130', 	'street' => 'Battery St', 		'unit' => '3', 	'rent' => 1800); 
	$data[] = array('id' => 3, 'number' => '1049', 	'street' => 'Leavenworth St', 	'unit' => '11', 'rent' => 800); 
	$data[] = array('id' => 4, 'number' => '130', 	'street' => 'Battery St', 		'unit' => '10', 'rent' => 3400); 
	$data[] = array('id' => 5, 'number' => '1059', 	'street' => 'Leavenworth St', 	'unit' => '10', 'rent' => 1450); 
	$data[] = array('id' => 6, 'number' => '130', 	'street' => 'Battery St', 		'unit' => '5', 	'rent' => 1000); 

	//Options provided by the user
	$sortOnColumn = 'id'; //Any key from the given array
	$sortDirection = SORT_DESC; //or SORT_ASC
	$sortStyle = SORT_REGULAR; //or SORT_NATURAL

	//Create instance of class
	$dataSorter = DataSorter::getInstance();

	//Call the method usd to sort arrays. Pass the array to sort on, and the user preferences for direction & sort options.
	$sortedData = $dataSorter->sortArrayByUserPreference($data, $sortOnColumn, $sortDirection, $sortStyle);

	//Display results
	displayResults($sortedData);

	// Define 'DataSorter' singleton class 
	class DataSorter {

	  // Hold the class instance.
	  private static $instance = null;

	  private function __construct()
	  {

	  }
	  
	  //We use a static function here to prevent an instance of this class from having access
	  public static function getInstance()
	  {
	    if(!self::$instance)
	    {
	      self::$instance = new dataSorter();
	    }
	   
	    return self::$instance;
	  }
	  
	  //Method to sort array
	  public function sortArrayByUserPreference($data, $sortOnColumn, $sortDirection, $sortStyle)
	  {

	  	//Create a new array, so we can sort on it and the orginal array
		foreach ($data as $key => $row)
		{
		    $sortingColumn[$key] = $row[$sortOnColumn];
		}

		//PHP function to sort arrays. We pass our new array, sorting flags, and our orginal array of data
		array_multisort($sortingColumn, $sortDirection, $sortStyle, $data);

		return $data;
	  }
	}

	//Simple output of results as a table to show the data is sorted
	function displayResults($sortedData) {

		echo('<table>');

		foreach ($sortedData as $key => $row) {

			echo('<tr>');
			
			foreach ($row as $key => $value) {
				
				echo('<td style="padding:.25em;"><strong>' . $key .':</strong></td><td> '. $value . '</td> ');
			}

			echo('</tr>');
		}

		echo('</table>');

	}
