<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

 <div class="content">   


            <h2><?php echo 'Rule Freezing Console!';?></h2>

<div class="panel panel-default">
    <div class="panel-heading">'</br><hr><center>Freze Formula : <> </center> <hr>'</b></div>
    <div class="panel-body">
    <table class="table table-striped table-responsive">
        <thead>
            <tr>

                <th>Project Name,BuildingName,Site</th>
                <th>RuleSet,RuleName,Formula</th>
                <th>Element,Attribute</th>
                <th>Inputs, Operator,Output</th>
                <th>Threshold, Constant</th>
                </tr>
        </thead>
        <?php 
        $sno = 1;
        foreach ($tabledata as $temp) { ?>
            <tr>
               
                <td><?php echo $temp->ruleset_id.' '.$temp->ruleset_id.' '.$temp->ruleset_id;?></td>
                <td><?php echo $temp->ruleset_id.' '.$temp->ruleset_id.' '.$temp->ruleset_id;?></td>
                <td><?php echo $temp->ruleset_id.' '.$temp->ruleset_id.' '.$temp->ruleset_id;?></td>
                <td><?php echo $temp->ruleset_id.' '.$temp->ruleset_id.' '.$temp->ruleset_id;?></td>
                <td><?php echo $temp->ruleset_id.' '.$temp->ruleset_id.' '.$temp->ruleset_id;?></td>
                 
            </tr>
            <hr>
        <?php
        $sno++;
        }
        ?>  
    </table>
    
    <?php  
  


    $fields = ['freezedformula'] ;
    $label_attributes = 'Test ';

     
     ?>

     <center>
     <br><br>
            
    <form action=<?php echo  site_url().'admin/data/updatefreez/id/'.$temp->RuleInputsVariableID;?> method="get">
  
                Freez Formula : <input type="text" name="fz"><br>
   
            <input type="submit" value="Submit">
    </form>
    
    </center>
</div>
