<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/4/16
 * Time: 11:48 AM
 */
//debug($teamDetailsResult); die;
$query_count = count($teamDetailsResult);
if($query_count)         
  {    
echo $this->Form->input('team_list_id', ['id'=>'team_list_id',
'type' => 'select',
'label' => 'Select Team',
'empty'=>'Select',
'options' => $teamDetailsResult,
'selected'=> false,
'required' => 'true'


]);
}
else { ?>
  0
<?php }
?>
