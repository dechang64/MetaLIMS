<?php	

//display table
function build_query_results_table($stmt,$table_type,$dbc){ //table types are 'dislapy' and 'xls'
	include($_SESSION['include_path'].'functions/convert_time.php');
	include($_SESSION['include_path'].'functions/find_samplers.php');
	include($_SESSION['include_path'].'functions/find_thing_labels.php');

	$sample_array = array();
	$thing_label_array = find_thing_labels();
	
	 echo "<div class=\"border\" style=\"margin-top:10px\">";
	 echo "<!-- Nav tabs -->";
  	 echo "<ul class=\"nav nav-tabs\" role=\"tablist\">";
	
     echo "<li role=\"presentation\" class=\"active\"><a href=\"#fragment1\" aria-controls=\"fragment1\" role=\"tab\" data-toggle=\"tab\">General</a></li>";
     echo "<li role=\"presentation\"><a href=\"#fragment2\" aria-controls=\"fragment2\" role=\"tab\" data-toggle=\"tab\">DNA Extraction Info</a></li>";
     echo "<li role=\"presentation\"><a href=\"#fragment3\" aria-controls=\"fragment3\" role=\"tab\" data-toggle=\"tab\">RNA Extraction Info</a></li>";
     echo "<li role=\"presentation\"><a href=\"#fragment4\" aria-controls=\"fragment4\" role=\"tab\" data-toggle=\"tab\">Analysis</a></li>";
   	 echo "<li role=\"presentation\"><a href=\"#fragment5\" aria-controls=\"fragment5\" role=\"tab\" data-toggle=\"tab\">User Created Fields</a></li>";
     echo "<li role=\"presentation\"><a href=\"#fragment6\" aria-controls=\"fragment6\" role=\"tab\" data-toggle=\"tab\">Notes</a></li>";
   	 
   	 echo "</ul>";
	  echo "<div class=\"tab-content\">";


		  echo "<div role=\"tabpanel\" class=\"tab-pane active\" id=\"fragment1\">";
			//General
			$stmt->execute();
				/* bind variables to prepared statement */
				$stmt->bind_result($sample_name,$sample_sort,$barcode,$project_name,$location,$relative_location,$media_type,$collector_name,$sample_type,$start_time,$end_time,$total_time,$entered_by,$updated_by,$time_stamp
				,$dna_extraction_date,$dna_extraction_kit,$dna_concentration,$dna_volume_of_elution,$dna_instrument,$dna_vol_for_instrument,$dna_storage,$dna_extractor,$dna_exists,$orig_exists
				,$rna_extraction_date,$rna_extraction_kit,$rna_concentration,$rna_volume_of_elution,$rna_instrument,$rna_vol_for_instrument,$rna_storage,$rna_extractor,$rna_exists,$orig_exists
				,$analysis_name
				,$notes
				);
				
				echo "<table id=\"datatable\" class=\"display\" cellspacing=\"0\" width=\"90%\ max-width=\"90%\">";
				echo "<thead>";
				echo "<tr>";
				echo "<th >Sample Name</th>";
				echo "<th>Sample Sort</th>";
				echo "<th>Barcode</th>";
				echo "<th>Project Name</th>";
				echo "<th>Location</th>";
				echo "<th>Relative Location</th>";
				echo "<th>Media Type</th>";
				echo "<th>Collector Name</th>";
				echo "<th>Sample Type</th>";
				echo "<th>Start Time</th>";
				//echo "<th>End Time</th>";
				echo "<th>Sampling Duration</th>";
				echo "<th>Samplers</th>";
				echo "</tr>";
				echo "</thead>";
				
				echo "<tfoot>";
				echo "<tr>";
				echo "<th>Sample Name</th>";
				echo "<th>Sample Sort</th>";
				echo "<th>Barcode</th>";
				echo "<th>Project Name</th>";
				echo "<th>Location</th>";
				echo "<th>Relative Location</th>";
				echo "<th>Media Type</th>";
				echo "<th>Collector Name</th>";
				echo "<th>Sample Type</th>";
				echo "<th>Start Time</th>";
				//echo "<th>End Time</th>";
				echo "<th>Sampling Duration</th>";
				echo "<th>Samplers</th>";
				echo "</tr>";
				echo "</tfoot>";
				
				echo "<tbody>";
				
				
				/* fetch values */
				$sample_names_seen = array();
				while ($stmt->fetch()) {
					 $sample_name = htmlspecialchars($sample_name);
					 $sample_sort = htmlspecialchars($sample_sort);
					 $barcode = htmlspecialchars($barcode);
					 $project_name = htmlspecialchars($project_name);
					 $location = htmlspecialchars($location);
				     $relative_location = htmlspecialchars($relative_location);
				     $media_type = htmlspecialchars($media_type);
				     $collector_name = htmlspecialchars($collector_name);
					 $sample_type = htmlspecialchars($sample_type);
					 $start_time = htmlspecialchars($start_time);
					// $end_time = htmlspecialchars($end_time);
					 $total_time = htmlspecialchars($total_time);
					
					 $sample_array[$sample_sort] = $sample_name;

					 $key = 'total_time';
					 $converted_total_time = convert_time($key, $total_time);
					 $samplers = find_samplers($sample_name,$table_type);
					 
					 //check if you've seen the sample name already
					 if (in_array($sample_name, $sample_names_seen)){
						//break;
						continue;
					 }else{
						array_push($sample_names_seen,$sample_name);
					 }
					 
					 
					 echo "<tr>";
					 echo "<td><div class='sample_name'>$sample_name</div></td>";
					 echo "<td><div class='block'>$sample_sort</div></td>";
					 echo "<td><div class='block'>$barcode</div></td>";
					 echo "<td><div class='block'>$project_name</div></td>";
					 echo "<td><div class='block'>$location</div></td>";
					 echo "<td><div class='block'>$relative_location</div></td>";
					 echo "<td><div class='block'>$media_type</div></td>";
				     echo "<td><div class='block'>$collector_name</div></td>";
				     echo "<td><div class='block'>$sample_type</div></td>";
					 echo "<td><div class='block'>$start_time</div></td>";
					// echo "<td><div class='block'>$end_time</div></td>";
					 echo "<td><div class='block'>$converted_total_time</div></td>"; 
					  echo "<td><div class='block'>$samplers</div></td>";
					 echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
			
		echo "</div>"; //end div fragment

		 echo "<div role=\"tabpanel\" class=\"tab-pane\" id=\"fragment2\">";
		
		$stmt->execute();
				/* bind variables to prepared statement */
				$stmt->bind_result($sample_name,$sample_sort,$barcode,$project_name,$location,$relative_location,$media_type,$collector_name,$sample_type,$start_time,$end_time,$total_time,$entered_by,$updated_by,$time_stamp
				,$dna_extraction_date,$dna_extraction_kit,$dna_concentration,$dna_volume_of_elution,$dna_instrument,$dna_vol_for_instrument,$dna_storage,$dna_extractor,$dna_exists,$orig_exists
				,$rna_extraction_date,$rna_extraction_kit,$rna_concentration,$rna_volume_of_elution,$rna_instrument,$rna_vol_for_instrument,$rna_storage,$rna_extractor,$rna_exists,$orig_exists
				,$analysis_name
				,$notes
				);
				
				
		 		echo "<table id=\"datatable2\" class=\"display\" cellspacing=\"0\" width=\"90%\ max-width=\"90%\">";
				echo "<thead>";
				echo "<tr>";
				echo "<th >Sample Name</th>";
				echo "<th>Sample Sort</th>";
				echo "<th>Extraction Date (YYYY-MM-DD)</th>";
				echo "<th>Extraction Kit</th>";
				echo "<th>Concentration (ng/uL)</th>";
				echo "<th>Volume of Elution (uL)</th>";
				echo "<th>Quantification Instrument</th>";
				echo "<th>Vol. Used for Quantification (uL)</th>";
				echo "<th>Storage Location</th>";
				echo "<th>Performed By</th>";
				echo "<th>DNA Extraction Exists</th>";
				echo "<th>Original Sample Exists</th>";
				echo "</tr>";
				echo "</thead>";
				
				echo "<tfoot>";
				echo "<tr>";
				echo "<th>Sample Name</th>";
				echo "<th>Sample Sort</th>";
				echo "<th>Extraction Date (YYYY-MM-DD)</th>";
				echo "<th>Extraction Kit</th>";
				echo "<th>Concentration (ng/uL)</th>";
				echo "<th>Volume of Elution (uL)</th>";
				echo "<th>Quantification Instrument</th>";
				echo "<th>Vol. Used for Quantification (uL)</th>";
				echo "<th>Storage Location</th>";
				echo "<th>Performed By</th>";
				echo "<th>DNA Extraction Exists</th>";
				echo "<th>Original Sample Exists</th>";
				echo "</tr>";
				echo "</tfoot>";
				
				echo "<tbody>";
				
				/* fetch values */
				$sample_names_seen = array();
				while ($stmt->fetch()) {
					 $sample_name = htmlspecialchars($sample_name);
					 $sample_sort = htmlspecialchars($sample_sort);
					 $dna_extraction_date = htmlspecialchars($dna_extraction_date);
					 $dna_extraction_kit= htmlspecialchars($dna_extraction_kit);
				     $dna_concentration = htmlspecialchars($dna_concentration);
				     $dna_volume_of_elution = htmlspecialchars($dna_volume_of_elution);
				     $dna_instrument = htmlspecialchars($dna_instrument);
					 $dna_vol_for_instrument = htmlspecialchars($dna_vol_for_instrument);
					 $dna_storage = htmlspecialchars($dna_storage);
					 $dna_extractor = htmlspecialchars($dna_extractor);
					 $dna_exists = htmlspecialchars($dna_exists);
					 $orig_exists = htmlspecialchars($orig_exists);
					 
					 if($orig_exists == 'true'){
					 	$orig_exists = 'Y';
					 }else{
					 	$orig_exists = 'N';
					 }
					 
					 if($dna_exists == 'one'){
					 	$dna_exists = 'Yes';
					 }elseif($dna_exists == 'two'){
					 	$dna_exists = "No,Not Extracted";
					 }else{
					 	$dna_exists = "No,Extract Used";
					 }
					 
					 //check if you've seen the sample name already
					 if (in_array($sample_name, $sample_names_seen)){
						//break;
						continue;
					 }else{
						array_push($sample_names_seen,$sample_name);
					 }
								
					 
					 echo "<tr>";
					 echo "<td><div class='sample_name'>$sample_name</div></td>";
					 echo "<td><div class='block'>$sample_sort</div></td>";
					 echo "<td><div class='block'>$dna_extraction_date</div></td>";
					 echo "<td><div class='block'>$dna_extraction_kit</div></td>";
					 echo "<td><div class='block'>$dna_concentration</div></td>";
					 echo "<td><div class='block'>$dna_volume_of_elution</div></td>";
					 echo "<td><div class='block'>$dna_instrument</div></td>";
				     echo "<td><div class='block'>$dna_vol_for_instrument</div></td>";
				     echo "<td><div class='block'>$dna_storage</div></td>";;
					 echo "<td><div class='block'>$dna_extractor</div></td>"; 
					 echo "<td><div class='block'>$dna_exists</div></td>";
					 echo "<td><div class='block'> $orig_exists</div></td>";
					 echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
		 
		 
		 echo "</div>";//end of fragment 2
		
    	echo "<div role=\"tabpanel\" class=\"tab-pane\" id=\"fragment3\">";
    	
		
			$stmt->execute();
				/* bind variables to prepared statement */
				$stmt->bind_result($sample_name,$sample_sort,$barcode,$project_name,$location,$relative_location,$media_type,$collector_name,$sample_type,$start_time,$end_time,$total_time,$entered_by,$updated_by,$time_stamp
				,$dna_extraction_date,$dna_extraction_kit,$dna_concentration,$dna_volume_of_elution,$dna_instrument,$dna_vol_for_instrument,$dna_storage,$dna_extractor,$dna_exists,$orig_exists
				,$rna_extraction_date,$rna_extraction_kit,$rna_concentration,$rna_volume_of_elution,$rna_instrument,$rna_vol_for_instrument,$rna_storage,$rna_extractor,$rna_exists,$orig_exists
				,$analysis_name
				,$notes
				);
		 	echo "<table id=\"datatable3\" class=\"display\" cellspacing=\"0\" width=\"90%\ max-width=\"90%\">";
				echo "<thead>";
				echo "<tr>";
				echo "<th >Sample Name</th>";
				echo "<th>Sample Sort</th>";
				echo "<th>Extraction Date (YYYY-MM-DD)</th>";
				echo "<th>Extraction Kit</th>";
				echo "<th>Concentration (ng/uL)</th>";
				echo "<th>Volume of Elution (uL)</th>";
				echo "<th>Quantification Instrument</th>";
				echo "<th>Vol. Used for Quantification (uL)</th>";
				echo "<th>Storage Location</th>";
				echo "<th>Performed By</th>";
				echo "<th>RNA Extraction Exists</th>";
				echo "<th>Original Sample Exists</th>";
				echo "</tr>";
				echo "</thead>";
				
				echo "<tfoot>";
				echo "<tr>";
				echo "<th>Sample Name</th>";
				echo "<th>Sample Sort</th>";
				echo "<th>Extraction Date (YYYY-MM-DD)</th>";
				echo "<th>Extraction Kit</th>";
				echo "<th>Concentration (ng/uL)</th>";
				echo "<th>Volume of Elution (uL)</th>";
				echo "<th>Quantification Instrument</th>";
				echo "<th>Vol. Used for Quantification (uL)</th>";
				echo "<th>Storage Location</th>";
				echo "<th>Performed By</th>";
				echo "<th>RNA Extraction Exists</th>";
				echo "<th>Original Sample Exists</th>";
				echo "</tr>";
				echo "</tfoot>";
				
				echo "<tbody>";
				
				/* fetch values */
				$sample_names_seen = array();
				while ($stmt->fetch()) {
					 $sample_name = htmlspecialchars($sample_name);
					 $sample_sort = htmlspecialchars($sample_sort);
					 $rna_extraction_date = htmlspecialchars($rna_extraction_date);
					 $rna_extraction_kit= htmlspecialchars($rna_extraction_kit);
				     $rna_concentration = htmlspecialchars($rna_concentration);
				     $rna_volume_of_elution = htmlspecialchars($rna_volume_of_elution);
				     $rna_instrument = htmlspecialchars($rna_instrument);
					 $rna_vol_for_instrument = htmlspecialchars($rna_vol_for_instrument);
					 $rna_storage = htmlspecialchars($rna_storage);
					 $rna_extractor = htmlspecialchars($rna_extractor);
					 $rna_exists = htmlspecialchars($rna_exists);
					 $orig_exists = htmlspecialchars($orig_exists);
					 
					 if($orig_exists == 'true'){
					 	$orig_exists = 'Y';
					 }else{
					 	$orig_exists = 'N';
					 }
					 
					 if($rna_exists == 'one'){
					 	$rna_exists = 'Yes';
					 }elseif($rna_exists == 'two'){
					 	$rna_exists = "No,Not Extracted";
					 }else{
					 	$rna_exists = "No,Extract Used";
					 }
					 
					 //check if you've seen the sample name already
					 if (in_array($sample_name, $sample_names_seen)){
						//break;
						continue;
					 }else{
						array_push($sample_names_seen,$sample_name);
					 }
					 
					 echo "<tr>";
					 echo "<td><div class='sample_name'>$sample_name</div></td>";
					 echo "<td><div class='block'>$sample_sort</div></td>";
					 echo "<td><div class='block'>$rna_extraction_date</div></td>";
					 echo "<td><div class='block'>$rna_extraction_kit</div></td>";
					 echo "<td><div class='block'>$rna_concentration</div></td>";
					 echo "<td><div class='block'>$rna_volume_of_elution</div></td>";
					 echo "<td><div class='block'>$rna_instrument</div></td>";
				     echo "<td><div class='block'>$rna_vol_for_instrument</div></td>";
				     echo "<td><div class='block'>$rna_storage</div></td>";;
					 echo "<td><div class='block'>$rna_extractor</div></td>"; 
					 echo "<td><div class='block'>$rna_exists</div></td>";
					 echo "<td><div class='block'> $orig_exists</div></td>";
					 echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
		 echo "</div>"; //end of fragment 3
		 //echo "<div id=\"fragment-4\">";
		 echo "<div role=\"tabpanel\" class=\"tab-pane\" id=\"fragment4\">";
		
			$stmt->execute();
				/* bind variables to prepared statement */
				$stmt->bind_result($sample_name,$sample_sort,$barcode,$project_name,$location,$relative_location,$media_type,$collector_name,$sample_type,$start_time,$end_time,$total_time,$entered_by,$updated_by,$time_stamp
				,$dna_extraction_date,$dna_extraction_kit,$dna_concentration,$dna_volume_of_elution,$dna_instrument,$dna_vol_for_instrument,$dna_storage,$dna_extractor,$dna_exists,$orig_exists
				,$rna_extraction_date,$rna_extraction_kit,$rna_concentration,$rna_volume_of_elution,$rna_instrument,$rna_vol_for_instrument,$rna_storage,$rna_extractor,$rna_exists,$orig_exists
				,$analysis_name
				,$notes
				);
				
				
				echo "<table id=\"datatable4\" class=\"display\" cellspacing=\"0\" width=\"90%\ max-width=\"90%\">";
				echo "<thead>";
				echo "<tr>";
				echo "<th >Sample Name</th>";
				echo "<th>Sample Sort</th>";
				echo "<th>Analysis Name</th>";
				echo "</tr>";
				echo "</thead>";
				
				echo "<tfoot>";
				echo "<tr>";
				echo "<th>Sample Name</th>";
				echo "<th>Sample Sort</th>";
				echo "<th>Analysis Name</th>";
				echo "</tr>";
				echo "</tfoot>";
				
				echo "<tbody>";
				
				/* fetch values */
				$sample_names_seen = array();
				while ($stmt->fetch()) {
					 $sample_name = htmlspecialchars($sample_name);
					 $sample_sort = htmlspecialchars($sample_sort);
					 $analysis_name = htmlspecialchars($analysis_name);
			
					 //check if you've seen the sample name already
					 if (in_array($sample_name, $sample_names_seen)){
						//break;
						continue;
					 }else{
						array_push($sample_names_seen,$sample_name);
					 }
					 
					 echo "<tr>";
					 echo "<td><div class='sample_name'>$sample_name</div></td>";
					 echo "<td><div class='block'>$sample_sort</div></td>";
					 echo "<td><div class='block'>$analysis_name</div></td>";
					 echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				
				
		echo "</div>"; //end of fragment 4
		//echo "<div  id=\"fragment-5\">";
		echo "<div role=\"tabpanel\" class=\"tab-pane\" id=\"fragment5\">";
		
		echo "<table id=\"datatable5\" class=\"display\" cellspacing=\"0\" width=\"90%\ max-width=\"90%\">";
				
				echo "<thead>";
				echo "<tr>";
				echo "<th >Sample Name</th>";
				echo "<th>Sample Sort</th>";
				foreach($thing_label_array as $key => $value){
					$id_label = explode("|",$value);
					$label =$id_label[1];
					echo "<th>$label</th>";
				}
				echo "</tr>";
				echo "</thead>";
				
				echo "<tfoot>";
				echo "<tr>";
				echo "<th>Sample Name</th>";
				echo "<th>Sample Sort</th>";
				foreach($thing_label_array as $key => $value){
					$id_label = explode("|",$value);
					$label =$id_label[1];
					echo "<th>$label</th>";
				}
				echo "</tr>";
				echo "</tfoot>";
				
				echo "<tbody>";
				foreach($sample_array as $sample_key => $sample_name){					
					echo "<tr>";
					echo "<td><div class='sample_name'>$sample_name</div></td>";
					echo "<td><div class='block'>$sample_key</div></td>";
					foreach($thing_label_array as $key => $value){
						$id_label = explode("|",$value);
						$id =$id_label[0];
						$thing_value = find_thing_values($sample_name, $id);
						echo "<td><div class='block'>$thing_value</div></td>";
					}
					echo "</tr>";
				}
			
				echo "</tbody>";
				echo "</table>";
		
		echo "</div>";//end of fragment 5
		//echo "<div id=\"fragment-6\">";
		
		
		$stmt->execute();
				/* bind variables to prepared statement */
				$stmt->bind_result($sample_name,$sample_sort,$barcode,$project_name,$location,$relative_location,$media_type,$collector_name,$sample_type,$start_time,$end_time,$total_time,$entered_by,$updated_by,$time_stamp
				,$dna_extraction_date,$dna_extraction_kit,$dna_concentration,$dna_volume_of_elution,$dna_instrument,$dna_vol_for_instrument,$dna_storage,$dna_extractor,$dna_exists,$orig_exists
				,$rna_extraction_date,$rna_extraction_kit,$rna_concentration,$rna_volume_of_elution,$rna_instrument,$rna_vol_for_instrument,$rna_storage,$rna_extractor,$rna_exists,$orig_exists
				,$analysis_name
				,$notes
				);
				echo "<div role=\"tabpanel\" class=\"tab-pane\" id=\"fragment6\">";
				echo "<table id=\"datatable6\" class=\"display\" cellspacing=\"0\" width=\"90%\ max-width=\"90%\">";
				
				echo "<thead>";
				echo "<tr>";
				echo "<th >Sample Name</th>";
				echo "<th>Sample Sort</th>";
				echo "<th>Notes</th>";
				echo "<th>Entered By</th>";
				echo "<th>Updated By</th>";
				echo "<th>Time Stamp</th>";
				echo "</tr>";
				echo "</thead>";
				
				echo "<tfoot>";
				echo "<tr>";
				echo "<th>Sample Name</th>";
				echo "<th>Sample Sort</th>";
				echo "<th>Notes</th>";
				echo "<th>Entered By</th>";
				echo "<th>Updated By</th>";
				echo "<th>Time Stamp</th>";
				echo "</tr>";
				echo "</tfoot>";
				
				echo "<tbody>";
				
				/* fetch values */
				$sample_names_seen = array();
				while ($stmt->fetch()) {
					 $sample_name = htmlspecialchars($sample_name);
					 $sample_sort = htmlspecialchars($sample_sort);
					 $notes = htmlspecialchars($notes);
					 $entered_by = htmlspecialchars($entered_by);
					 $updated_by = htmlspecialchars($updated_by);
					 $time_stamp = htmlspecialchars($time_stamp);
				
					 //check if you've seen the sample name already
					 if (in_array($sample_name, $sample_names_seen)){
						//break;
						continue;
					 }else{
						array_push($sample_names_seen,$sample_name);
					 }
					 
					 echo "<tr>";
					 echo "<td><div class='sample_name'>$sample_name</div></td>";
					 echo "<td><div class='block'>$sample_sort</div></td>";
					 echo "<td><textarea rows='4'>$notes</textarea></td>";
					 echo "<td><div class='block'>$entered_by</div></td>";
					 echo "<td><div class='block'>$updated_by</div></td>";
					 echo "<td><div class='block'>$time_stamp</div></td>";
					 echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				
				
		echo "</div>"; //end of fragment 6
	echo "</div>"; //end of tabs
	echo "</div>"; //end of background div

	/* close statement */
	$stmt->close();
	/* close connection */
	$dbc->close();
}
?>