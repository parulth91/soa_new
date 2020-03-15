<br>
<div id="dvApplicationPrintContents"> 
  <?= $this->Form->create('attendance', ['url' => ['action' => 'attendance']]); ?>
    <div class = "pen-title">
        <?php //debug($registeredCandidateLists->event_activity_list->event_list->description);die;?>
        <div class = "pen-title"> <h3 > 

                Attendance Sheet for <?php
                //debug($registerCandidatesLists);
                echo $registerCandidatesLists[0]->event_activity_list->event_list->description;
                ?> 
            </h3></div>
    </div>
    <fieldset>
        <table class="table table-striped" cellpadding="0" cellspacing="0">
            <thead>
                <tr>

                    <th><?= $this->Paginator->sort('S.NO'); ?></th>
                    <th><?= $this->Paginator->sort('GameType'); ?></th>
                    <th><?= $this->Paginator->sort('Activity'); ?></th>
                    <th><?= $this->Paginator->sort('Name'); ?></th>
                    <th><?= $this->Paginator->sort('Age'); ?></th>
                    <th><?= $this->Paginator->sort('Weight'); ?></th>
                    <th><?= $this->Paginator->sort('Registration Number'); ?></th>

                    <th class="actions"><?= __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($registerCandidatesLists as $registeredCandidateView): ?>
                        <td><?= $this->Number->format($registeredCandidateView->id) ?></td>
                        <td>
                            <?= $registeredCandidateView->event_activity_list->activity_list->game_type_list->description; ?>
                        </td>
                        <td> <?= $registeredCandidateView->event_activity_list->activity_list->description; ?></td>
                        <td><?= $registeredCandidateView->full_name; ?></td>
                        <td><?= $registeredCandidateView->age; ?></td>
                        <td><?= $registeredCandidateView->weight; ?></td>
                        <td><?= h($registeredCandidateView->registration_number) ?></td>

                        <td class="actions">

                            <?php
                            echo $this->Form->input('attendance_status['.$registeredCandidateView->id.']', [
                                'label' => false,
                                'value' => '1',
                                'type' => 'checkbox',
                                'id' => 'attendance_status',
                                //'selected' => $registeredCandidateView->id,
                                'autocomplete' => "off",
                            ]);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>




    <?= $this->Form->button(__("Submit")); ?>
   <?= $this->Form->end() ?>
</div>






<script>

    function printInfo(dvApplicationPrintContents) {
        var prtContent = document.getElementById("dvApplicationPrintContents");
        var WinPrint = window.open('', '', 'left=0,top=0,width=1000,height=900,toolbar=0,scrollbars=0,status=0');
        var htmlToPrint = '' +
                '<style type="text/css">' +
                'table {' +
                'border: solid #000 !important;' +
                'border-width: 1px 0 0 1px !important;' +
                '}' +
                ' th, td {' +
                '   border: solid #000 !important;' +
                '   border-width: 0 1px 1px 0 !important;' +
                '}'
                +
                '</style>';
        htmlToPrint += prtContent.outerHTML;
        WinPrint.document.write(htmlToPrint);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }



</script>
