	$weekdaycount = $weekdaycount + 1; 
					echo $weekdaycount;
					echo '<th>'. $textDayOfWeek .'</th>';
					$dayOfWeek = $dayOfWeek +1;
					$dateCount = $dateCount +1;
					// resets the count to the start of the week so week value repeats from monday
					if ($weekdaycount > 7) {
						break;
					}
					
					//Get remining days in month including today
$daysLeftInMonth = date('t') - date('d') + 1;
echo '<table>';
for ($i=0; $i < $daysLeftInMonth; $i++) { 
	echo "<th>";
	echo date('l', strtotime("+ $i day"));
	echo "</th>";
}

echo '<tr>';
for ($i=0; $i < $daysLeftInMonth; $i++) { 
	echo "<td>";
	echo date('d/m/Y', strtotime("+ $i day"));
	echo "</td>";
}
echo '</tr>';
echo '</table>';