<%
use Cake\Utility\Inflector;

$fields = collection($fields)
->filter(function($field) use ($schema) {
return $schema->columnType($field) !== 'binary';
});
%>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($<%= $singularVar %>);
?>
<fieldset>
    <legend><?= __('<%= Inflector::humanize($action) %> {0}', ['<%= $singularHumanName %>']) ?></legend>

    <%
    foreach ($fields as $field) {
        if (in_array($field, $primaryKey)) {
        continue;
    }
    if (isset($keyFields[$field])) {
        %>  <div class=col-md-2>
                <?php
                echo $this->Form->input('<%= $field %>', ['type'=>'select','empty'=>'Select','options' => $<%= $keyFields[$field] %>]);
                ?>
            </div>
        <%
        continue;
    }
    if (!in_array($field, ['created', 'modified', 'updated', 'action_by', 'action_ip'])) {
        %>
        <div class=col-md-2>
            <?php
            echo $this->Form->control('<%= $field %>');
            ?>
        </div>
        <%
        }
    }
    if (!empty($associations['BelongsToMany'])) {
        foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
        %>
        <div class = col-md-2>
            <?php
            echo $this->Form->input('<%= $assocData['property'] %>._ids', ['type'=>'select','empty'=>'Select','options' => $<%= $assocData['variable'] %>]);
            ?>
        </div>
        <%
        }
    }
    %>
    
</fieldset>
<%
if (strpos($action, 'add') === false)
    $submitButtonTitle = '__("Save")';
else
    $submitButtonTitle = '__("Add")';
%>
<?=
    $this->Form->button(<% echo $submitButtonTitle;
%>);
?>
<?= $this->Form->end() ?>
