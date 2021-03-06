<%

use Cake\Utility\Inflector;

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'] + $associations['HasOne'];
$associationFields = collection($fields)
    ->map(function($field) use ($immediateAssociations) {
        foreach ($immediateAssociations as $alias => $details) {
            if ($field === $details['foreignKey']) {
                return [$field => $details];
            }
        }
    })
    ->filter()
    ->reduce(function($fields, $value) {
    return $fields + $value;
}, []);

$groupedFields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    })
    ->groupBy(function($field) use ($schema, $associationFields) {
        $type = $schema->columnType($field);
        if (isset($associationFields[$field])) {
            return 'string';
        }
        if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
            return 'number';
        }
        if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
            return 'date';
        }
        return in_array($type, ['text', 'boolean']) ? $type : 'string';
    })
    ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
%>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($<%= $singularVar %>-><%= $displayField %>) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
<% if ($groupedFields['string']) : %>
<% foreach ($groupedFields['string'] as $field) : %>
        <tr>
<%
if (isset($associationFields[$field])) :
$details = $associationFields[$field];
%>
            <td><?= __('<%= Inflector::humanize($details['property']) %>') ?></td>
            <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= 'description' %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
<% else : %>
            <td><?= __('<%= Inflector::humanize($field) %>') ?></td>
            <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
<% endif; %>
        </tr>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['number']) : %>
<% foreach ($groupedFields['number'] as $field) : %>
        <tr>
            <td><?= __('<%= Inflector::humanize($field) %>') ?></td>
            <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
        </tr>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['date']) : %>
<% foreach ($groupedFields['date'] as $field) : %>
        <tr>
            <td><%= "<%= __('" . Inflector::humanize($field) . "') %>" %></td>
            <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
        </tr>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['boolean']) : %>
<% foreach ($groupedFields['boolean'] as $field) : %>
        <tr>
            <td><?= __('<%= Inflector::humanize($field) %>') ?></td>
            <td><?= $<%= $singularVar %>-><%= $field %> ? __('Yes') : __('No'); ?></td>
        </tr>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['text']) : %>
<% foreach ($groupedFields['text'] as $field) : %>
        <tr>
            <td><?= __('<%= Inflector::humanize($field) %>') ?></td>
            <td><?= $this->Text->autoParagraph(h($<%= $singularVar %>-><%= $field %>)); ?></td>
        </tr>
<% endforeach; %>
<% endif; %>
    </table>
</div>

<%
$relations = $associations['HasMany'] + $associations['BelongsToMany'];
foreach ($relations as $alias => $details):
$otherSingularVar = Inflector::variable($alias);
$otherPluralHumanName = Inflector::humanize($details['controller']);
%>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related <%= $otherPluralHumanName %>') ?></h3>
    </div>
    <?php if (!empty($<%= $singularVar %>-><%= $details['property'] %>)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
<% foreach ($details['fields'] as $field): %>
            <th><?= $this->Paginator->sort('<%= $field %>'); ?></th>
<% endforeach; %>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($<%= $singularVar %>-><%= $details['property'] %> as $<%= $otherSingularVar %>): ?>
                <tr>
<% foreach ($details['fields'] as $field): %>
                    <td><?= h($<%= $otherSingularVar %>-><%= $field %>) ?></td>
<% endforeach; %>
<% $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; %>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => '<%= $details['controller'] %>', 'action' => 'view', <%= $otherPk %>], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => '<%= $details['controller'] %>', 'action' => 'edit', <%= $otherPk %>], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => '<%= $details['controller'] %>', 'action' => 'delete', <%= $otherPk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $otherPk %>), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related <%= $otherPluralHumanName %></p>
    <?php endif; ?>
</div>
<% endforeach; %>
