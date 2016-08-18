<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php  //print_r($crud->field_types);
//echo $output->output; 
//$div = '<div>test</div>';
//echo $this->performaa->get_div_value($div);
//var_dump($data);
?>

<div class="pull-right"><a href="#" class="btn btn-info" id="print-reciept">Print Rule Data</a></div>
<div id="receipt" class="container" style="width: 98%; background-color: #fff;">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2 align="center"> Frezer the Rule Expression</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6 col-md-4">
                    Rule Set Name: <?php echo  $tabledata['RuleInputsVariableID']; ?> </div>
                <div class="col-xs-6 col-md-4 text-center">
                  
                </div>
                <div class="col-xs-6 col-md-4" style="padding-left: 5em;">
				<dl class="dl-horizontal">
                    <dt>RuleName.</dt>
                    <dd><?php echo $data['RuleID'];?></dd>   
                    <dt>Date:</dt>
                    <dd><?php echo date('j F Y'); ?></dd>   
                </dl>
                
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 col-md-4">
                 
                </div>
                <div class="col-xs-6 col-md-4">
                  <!--   To   <u> &nbsp;&nbsp;&nbsp; <?php echo $performa->SeedProducerID; ?> &nbsp;&nbsp;&nbsp; </u> <br> -->
                </div>
                <div class="col-xs-6 col-md-4" style="padding-left: 5em;">
               
                </div>
            </div>
            <div class="row text-justify">
                <div class="col-md-4">
                Ifc Structure :  &nbsp; <?php echo $performa->PerformaID; ?>
                </div>
                 <div class="col-md-4">
                Ifc Structure Attributes:  &nbsp; <?php echo ucwords(substr_replace($performa->PerformaType, ' ' . substr($performa->PerformaType, -1), -1) );  ?>
                </div>
                <div class="col-md-4" style="padding-left: 5em;">
                Input Parameters:  <u>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $performa->DateofPerforma; ?>
                &nbsp;&nbsp;&nbsp;&nbsp; </u>
                </div>
            </div>
            <br>
     		<div class="row">
                <div class="col-md-6">
	                <div class="col-sm-4">Output Parameters: </div>
	                <div class="col-sm-8 pull-right text-center" style="display: inline-block; border-bottom:1px solid black;"> 
	                	<?php echo $performa->YearID; ?> &nbsp;&nbsp;&nbsp;&nbsp; 
	                </div>
	            </div>
                <div class="col-md-6">
	                <div class="col-sm-4">Threshold: </div>
	                <div class="col-sm-8 pull-right text-center" style="display: inline-block; border-bottom:1px solid black;"> 
	                	<?php echo $performa->SeasonID; ?>
                         &nbsp;&nbsp;&nbsp;&nbsp; 
	                </div>
	            </div>
             </div>
             <div class="row">
                <div class="col-md-6">
	                <div class="col-sm-4">Constant: </div>
	                <div class="col-sm-8 pull-right text-center" style="display: inline-block; border-bottom:1px solid black;"> 
	                	<?php echo $performa->SeedProducerID; ?>
                       &nbsp;&nbsp;&nbsp;&nbsp; 
	                </div>
	            </div>
                <div class="col-md-6">
	                <div class="col-sm-4">Breeder Provider: </div>
	                <div class="col-sm-8 pull-right text-center" style="display: inline-block; border-bottom:1px solid black;"> 
	                	<?php echo $performa->BreederProviderID; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp; 
	                </div>
	            </div>
             </div>
             <div class="row">
                <div class="col-md-6">
	                <div class="col-sm-4">Crop Name: </div>
	                <div class="col-sm-8 pull-right text-center" style="display: inline-block; border-bottom:1px solid black;"> 
	                	<?php echo $performa->CropID; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp; 
	                </div>
	            </div>
                <div class="col-md-6">
	                <div class="col-sm-4">Seed Class: </div>
	                <div class="col-sm-8 pull-right text-center" style="display: inline-block; border-bottom:1px solid black;"> 
	                	<?php echo $performa->ClassID; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp; 
	                </div>
	            </div>
             </div>
           <br>
            
        </div>
    </div>
    
     <div class="row">
        <div class="col-xs-12">
   				 <div class="row">
   				 	
   				 	 <div class="col-sm-2">Amount in Rs:</div>
   				 	 <div class="col-sm-10 pull-right text-center" style="display: inline-block; border-bottom:1px solid black;"> 
   				 	 	check
   				 	 </div>
   				 	
            	</div>
            	<br />
            	<div class="row">
	                <div class="col-md-1">
	                    Note:
	                </div>

	                <div class="col-md-10">
	               		(1) &nbsp;&nbsp; Cheque / Bank Draft should be on ______________________ banks. <br>
	               		(2) &nbsp;&nbsp; All disputes shall be settled in Chandigarh Jurisdiction.
	                </div>
	                
            	</div>
            	<br>
            	<div class="row">
            		<div class="col-md-8 text-center">
            			TO HEAD OFFICE COPY 
            		</div>
            		<div class="col-md-4 text">
            			For Punjab State Seed Certification Authority
            		</div>
            	</div>
            	<br>	
		</div>
	</div>
</div>	