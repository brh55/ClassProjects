<HTML>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<?php

			include 'functions.php';
			//Grab Philosopher Selection
			$philosopher = $_POST['philosophers'];
			//Set pid based on function finding the philosopher
			$pid = findID($philosopher);

			echo '<h1>Philosphers</h1>';

			//fetch data and set JSON Data to an array
			$data = searchinPho_json('thinker', $pid);
			$json = json_decode($data);
			//$jsonArray = objectToArray($json);
			

			//Define variable in array based on index
			$url = $json->url;
			$label = $json->label;
			$influenced = $json->influenced;
			$influenced_by = $json->influenced_by;

			//extract and set idea ID's to an Array
			//$idea_ID = array();
			$idea_ID = $json->related_ideas;

			echo '<h3>Let\'s Learn About:</h3><a href= http://inpho.cogs.indiana.edu' . $url . '"><h3>' . $label . '</h3></a>';
			/*----------Start Section 2. Related Ideas -------------------------------*/
			echo '<hr>';

			echo '<h2>Related Ideas by ' . $label . '</h2>';
			echo '<table class="table table-striped">
					<thead>
						<td>Idea ID</td>
						<td>Idea Name</td>
					</thead>';

					//run foreach loop through PhoDB and find idea ID
					foreach ($idea_ID as $idea) {
						$record = searchinPho_json('idea', $idea);
						$json = json_decode($record);
						echo '<tr>';
						echo '<td>' . $idea . '</td><td>' . '<a href="https://inpho.cogs.indiana.edu/ideas/' . $idea . '">' . $json->label . '</a></td></tr>';
					}

			echo '</table></hr>';

			/*-----Start Thinkers Circle ---------------------------*/
			$thinkersIDs = array();
			foreach ($idea_ID as $idea) {
				foreach (getRelatedThinkersByIdea($idea) as $thinker_ID) {
					$thinkersIDs[] = $thinker_ID;
				}
			}
			//strip duplicate data from array 
			$unique_thinkers = array_unique($thinkersIDs);

			echo '<h2>Related Thinkers with Similar Ideas</h2>';
			echo 'Total Thinkers:' . count($thinkersIDs) . '<br>' . 'Unique Thinkers:' . count($unique_thinkers) . '<br>';
			echo '<table class="table table-striped">
			<thead>
				<td>Relative Thinker ID</td>
				<td>Relative Thinker Name</td>
			</thead>';

			//Run function to Derive Philosophers Name based off of ID in terms of relative thinker
			foreach ($unique_thinkers as $rThinkerID) {
				$relativethinker = searchinPho_json('thinker', $rThinkerID);
				$json = json_decode($relativethinker);
				echo '<tr>';
				echo '<td>' . $rThinkerID . '</td><td><a href="http://inpho.cogs.indiana.edu/thinker/' . $rThinkerID . '">' . $json->label . '</a>' . '</td>' . '</tr>';
			}
			echo '</table></hr>';

			/*----------------Start Influenced by Section------------------*/
				echo '<hr><h2>Influenced</h2><table class="table table-striped">';
				echo '<thead>
					<td>Philosopher ID</td>
					<td>Philosopher</td>
					<td>Year of Birth</td>
					<td>Year of Death</td>
					</thead>';

				//set as array
				 //strip influenced by in JSON

				foreach ($influenced as $pid) {
					$record = searchinPho_json('thinker', $pid);
					$json = json_decode($record);

					$birthdayYear = $json->birth->year;
					$deathYear = $json->death->year;

					//Seperate by Echo for easy to read
					echo '<tr>'; //Open Table Row
					echo '<td>' . $pid . '</td>'; // ID
					echo '<td>' . $json->label . '</td>'; //Name
					echo '<td>' . $birthdayYear . '</td>'; //Birth Year
					echo '<td>' . $deathYear . '</td>'; //Death Year
					echo '</tr>'; //Close Table Row
				}

				echo '</table>';

				echo '<hr>';

				//$influenced_by = array();
				$influenced_by = $json->influenced_by;

				echo '<h2>Influenced By</h2>';
				echo '<table class="table table-striped">';
				echo '<thead>'; 
				echo '<td>Philosopher ID</td>
					 <td>Philosopher</td>
					 <td>Year of Birthday</td>
					 <td>Year of Death</td>
					 </thead>';
				
				foreach ($influenced_by as $id) {
					$record = searchinPho_json('thinker', $id);
					$json = json_decode($record);

					//Define Birth and Death
					$birthdayYear = $json->birth->year;
					$deathYear = $json->death->year;

					//Seperate by Echo for easy to read
					echo '<tr>'; //Open Table Row
					echo '<td>' . $pid . '</td>'; // ID
					echo '<td>' . $json->label . '</td>'; //Name
					echo '<td>' . $birthdayYear . '</td>'; //Birth Year
					echo '<td>' . $deathYear . '</td>'; //Death Year
					echo '</tr>'; //Close Table Row
				}
				echo '</table>';

			//Return Button
			echo '<a href="index.html"><button type="button" class="btn btn-success">Return to Search</button></a>';
			?>
		</div>
	</div>
</div>
</body>
</html>