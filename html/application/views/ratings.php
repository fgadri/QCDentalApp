<!--container start-->
<!--'rating_id' => $rating['id'],
                'rating' => $rating['rating'],
                'timestamp' => $rating['timestamp'],
                'tooth_number' => $rating['tooth_number'],
                'rating_meta' => $rating['rating_name'],
                'technician' => $rating['technician'],
                'qcadmin' => $rating['qcadmin']




            -->


<div class="component-bg pad-bot-fifty">
    <div class="container">
    		<table class="table-striped table-condensed table-responsive table-hover">
			    <thead>
                    <tr class="col-md-12">
                        <th class="user-checkbox col-md-1">Rating ID</th>
                        <th class="user-checkbox col-md-2">Score</th>
                        <th class="user-checkbox col-md-3">Timestamp</th>
                        <th class="user-checkbox col-md-4">Tooth #</th>
                        <th class="user-checkbox col-md-5">Comments</th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach($ratings as $rating) : ?>
                	<tr class="col-md-12">
                		<td><span><?php echo $rating['rating_id'];  ?></span></td>
                		<td><span><?php echo $rating['rating'];  ?></span></td>
                		<td><span><?php echo $rating['timestamp'];  ?></span></td>
                		<td><span><?php echo $rating['tooth_number'];  ?></span></td>
                		<td><span><?php echo $rating['rating_meta'];  ?></span></td>
                	</tr>
                	<?php endforeach; ?>
                </tbody>
    		</table>
    </div>
</div>
<!--container end-->



    		
    		