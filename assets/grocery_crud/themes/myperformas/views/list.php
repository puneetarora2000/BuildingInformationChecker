<?php //var_dump($list);
//var_dump($columns);?>
<style media="print" type="text/css">
  @page { size: landscape; }
</style>
<style type="text/css">
.dotted-field {
   	border-bottom: 1px dashed #000 !important;
   	padding: 0 20px 1px 20px;
   	width: 100px;
   	
}
</style>

<div id="inspection-report" class="printArea container-fluid" style="width: 98%; background-color: #fff;">
    <div class="row">
            <div class="invoice-title">
                <h2 align="center">Punjab State Seed Certification Authority</h2>
                <h3 align="center">Inspection Report</h3>
            </div>
        
    </div>
    <!-- <div class="row pre-scrollable"> -->
    <div class="row" style="font-size: 15px;">
		<div class="col-md-6">	    			
	    	Season Name (Rabi / Kharif / Summer):	<span class="dotted-field">
	    					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    					<?php echo $list[0]->season; ?>
	    					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    				</span>
	    </div>
	    <div class="col-md-4">
	    		No: &nbsp;&nbsp;&nbsp;
	    		<span class="dotted-field">
	    		</span>
    	</div>
    </div>
    <div class="row" style="font-size: 15px;">
    	<div class="col-md-6">
	    	Seed Producer Organisation Name:    
	    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
	    				<span class="dotted-field">	
	    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    					<?php echo $list[0]->{$columns[1]->field_name}; ?>
	    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    				</span>
	    </div>
	    <div class="col-md-4">
	    		Date: 
	    		<span class="dotted-field">
	    			<?php echo date('j F Y'); ?>
	    		</span>
		</div>
 
    </div>
    <hr>
    <div class="row">
    	<table class="table table-bordered">
    		<thead>
    			<tr>
    				<th style="vertical-align: bottom; padding: 2px" align="left">Sr No.</th>	
    				<?php 
    				foreach($columns as $column){
    					if(($column->display_as == 'Seed Producer') || ($column->display_as == 'Season') ){
    						continue;
    					}
    					?>
						<th align="left"><?php echo $column->display_as; ?></th>
				<?php 	
					}?>
    			</tr>
    		</thead>
    		<tbody>
    			<?php 
    			$row_count = 1;
    			foreach($list as $num_row => $row){ ?>
				<tr id='row-<?php echo $num_row?>'>
					<td style="padding: 2px"><?php echo $row_count;?></td>
					<?php 
					foreach($columns as $column){

						if(($column->display_as == 'Seed Producer') || ($column->display_as == 'Season') ){
    						continue;
    					}
    					
    					?>
						<td style="padding: 2px"><?php 
							if($column->field_name == 'reserved_distance_correct') {
								if($row->reserved_distance_correct == 'No') {
									echo $row->reserved_distance_correct.'<br>';
									echo $row->reserved_distance_deducted;
								} else {
									echo $row->reserved_distance_correct;
								}
								//continue;
							}
							else {	
								echo $row->{$column->field_name};
							}
						?></td>
					<?php 
						
					}
					$row_count++;
					?>
				</tr>
				<?php }?>
    		</tbody>
    	</table>
    </div>
    <br><br>
</div>
