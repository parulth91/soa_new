<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use App\Oad\Commons\Utils\KnockoutGD;

/**
 * MyTeams Controller
 *
 * @property \App\Model\Table\MyTeamsTable $MyTeams
 *
 * @method \App\Model\Entity\TeamTieSheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MyTeamsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null) {
        $Result = $this->MyTeams->find()->contain([
                            'EventActivityLists', 'WinnerEventTeamDetails', 'Team1EventTeamDetails', 'Team2EventTeamDetails'])
                        ->where(['MyTeams.event_activity_list_id' => $id])->order('round_number');
//        $this->paginate = [
//            'contain' => ['EventActivityLists', 'WinnerEventTeamDetails', 'Team1EventTeamDetails', 'Team2EventTeamDetails']
//        ];
        $teamTieSheets = $this->paginate($Result);


        $this->set(compact('teamTieSheets'));
    }

    /**
     * View method
     *
     * @param string|null $id Team Tie Sheet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $teamTieSheet = $this->MyTeams->get($id, [
            'contain' => ['EventActivityLists', 'WinnerEventTeamDetails', 'Team1EventTeamDetails', 'Team2EventTeamDetails']
        ]);

        $this->set('teamTieSheet', $teamTieSheet);
    }

    /**
     * Edit method
     *
     * @param string|null $id Team Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $teamTieSheet = $this->MyTeams->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $this->request->data['modified'] = $currentTimeStamp;


            $teamTieSheet = $this->MyTeams->patchEntity($teamTieSheet, $this->request->getData());
            if ($this->MyTeams->save($teamTieSheet)) {
                $this->Flash->success(__('The team tie sheet has been saved.'));

                return $this->redirect(['action' => 'index', $teamTieSheet->event_activity_list_id]);
            }
            $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->MyTeams->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $winnerEventTeamDetails = $this->MyTeams->WinnerEventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $team1EventTeamDetails = $this->MyTeams->Team1EventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $team2EventTeamDetails = $this->MyTeams->Team2EventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $this->set(compact('teamTieSheet', 'eventActivityLists', 'winnerEventTeamDetails', 'team1EventTeamDetails', 'team2EventTeamDetails'));
    }

    public function updateResult($id = null) {
        $teamTieSheet = $this->MyTeams->get($id, [
            'contain' => ['EventActivityLists', 'WinnerEventTeamDetails', 'Team1EventTeamDetails', 'Team2EventTeamDetails']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $this->request->data['modified'] = $currentTimeStamp;

            if ($this->request->data['team1_score'] > $this->request->data['team2_score']) {
                $this->request->data['winner_event_team_detail_id'] = $teamTieSheet->team1_event_team_detail_id;
            } elseif ($this->request->data['team1_score'] < $this->request->data['team2_score']) {
                $this->request->data['winner_event_team_detail_id'] = $teamTieSheet->team2_event_team_detail_id;
            }
//debug($this->request->data);
            $teamTieSheet = $this->MyTeams->patchEntity($teamTieSheet, $this->request->getData());
            //debug($teamTieSheet);die;
            if ($this->MyTeams->save($teamTieSheet)) {
                $this->Flash->success(__('The team tie sheet has been saved.'));

                return $this->redirect(['action' => 'index', $teamTieSheet->event_activity_list_id]);
            }
            $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
        }
//        $eventActivityLists = $this->MyTeams->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
//        $winnerEventTeamDetails = $this->MyTeams->WinnerEventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
//        $team1EventTeamDetails = $this->MyTeams->Team1EventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
//        $team2EventTeamDetails = $this->MyTeams->Team2EventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $this->set(compact('teamTieSheet'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Team Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $teamTieSheet = $this->MyTeams->get($id);
        if ($this->MyTeams->delete($teamTieSheet)) {
            $this->Flash->success(__('The team tie sheet has been deleted.'));
        } else {
            $this->Flash->error(__('The team tie sheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function EventActivityStateList() {
        $event_activity_lists_id = $_REQUEST['event_activity_lists_id'];
        return $this->cList->ajaxGetAllEventActivityList($event_activity_lists_id);
    }

    public function tieSheet($id = null) {
        $eventActivityListTable = TableRegistry::get('event_activity_lists');
        $eventActivityLists = $eventActivityListTable->find('all')
                        ->contain([
                            'ActivityLists' => ['WeightCategoryLists', 'AgeGroupLists', 'GenderLists', 'GameTypeLists'],
                            'EventTeamDetails' => [],
                            'EventLists' => [],
                            'EventTeamDetails' => [],
                            'RegisterCandidateEventActivities' => []
                        ])->where(['event_activity_lists.id' => $id])->toArray();
        //debug($eventActivityLists[0]);die;
         $tieSheetHeader = $eventActivityLists[0]->event_list['description'].'('.$eventActivityLists[0]->description.')';
        $this->myTeamTieSheets($eventActivityLists[0]->event_list_id, $id, $eventActivityLists[0]->event_team_details, $tieSheetHeader);

        die;
    }

    /**
     * * */
    //-------------------------team tie sheet ----------------------------------------------------------------------------------------------------------------------------
    public function myTeamTieSheets($event_list_id = null, $event_activity_list_id = null, $team_data = null, $eventDetails = null) {

        //$teamTieSheetTable = TableRegistry::get('team_tie_sheets');
        $teamTieSheetTable = $this->MyTeams;
        $teamTieSheetLists = $teamTieSheetTable->find('all')
                ->contain(['Team1EventTeamDetails','Team2EventTeamDetails'])
                ->where(['MyTeams.event_activity_list_id' => $event_activity_list_id])
                ->order(['round_number' => 'ASC', 'match_number' => 'ASC'])
                ->toArray();
        $tieSheetUpdateReguiredFlag = $teamTieSheetTable->find('all')->where(['event_activity_list_id' => $event_activity_list_id, 'update_tiesheet' => true])->count();
        $playersId = null;
        foreach ($team_data as $key_team => $value_team) {
            //debug($value_team->description);die;
            $playersId[] = $value_team->id;
            $teamName[] = $value_team->description;
        }
        if (empty($playersId)) {
            //debug($playersId);
            $this->Flash->error(__('The player tie sheet could not be saved. Please, try again.'));
            die;
        }

//round 1 check and new data entered in database
        if (empty($teamTieSheetLists)) {
            if ($this->createMyTeamTieSheet($playersId, $eventDetails, true, $event_activity_list_id) == true) {
                
            } else {
                $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
            }
        } elseif (!empty($teamTieSheetLists)) {
            
             if ($tieSheetUpdateReguiredFlag > 0) {
                if ($this->updateMyTeamTieSheet($playersId, $eventDetails, true, $teamTieSheetLists, $event_activity_list_id) == true) {

                } else {
                    $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
                }
             }
        }
        //die;
        $this->getTeamsTieSheet($teamName, $eventDetails, true, $teamTieSheetLists);
    }

    public function createMyTeamTieSheet($data = null, $eventDetails = null, $score = null, $event_activity_list_id) {
        //$teamTieSheetTable = TableRegistry::get('team_tie_sheets');
        $teamTieSheetTable = $this->MyTeams;
// Lets create a knock-out tournament between some of our dear physicists.
        $competitors = $data;
// Create initial tournament bracket.
        $KO = new KnockoutGD($competitors);
        $tieSheetRoundData = $KO->getData($eventDetails);
        $i = 0;
        foreach ($tieSheetRoundData['round_matches'] as $key_round => $value_round) {

            foreach ($value_round as $key_match => $value_match) {
                $teamTieSheetData[$i]['event_activity_list_id'] = $event_activity_list_id;
                $teamTieSheetData[$i]['round_number'] = $key_round;
                $teamTieSheetData[$i]['round_description'] = $tieSheetRoundData['rounds'][$key_round]['0'];
                $teamTieSheetData[$i]['match_number'] = $key_match;
                $teamTieSheetData[$i]['team1_event_team_detail_id'] = $value_match['c1'];
                $teamTieSheetData[$i]['team2_event_team_detail_id'] = $value_match['c2'];
                $teamTieSheetData[$i]['team1_score'] = $value_match['s1'];
                $teamTieSheetData[$i]['team2_score'] = $value_match['s2'];
                $teamTieSheetData[$i]['action_by'] = $_SESSION['Auth']['User']['id'];
                $teamTieSheetData[$i]['action_ip'] = $_SERVER['REMOTE_ADDR'];
                $teamTieSheetData[$i]['active'] = true;
                $i++;
            }
        }
//code for saving data in table
        $teamTieSheet = $teamTieSheetTable->newEntities($teamTieSheetData);
        $teamTieSheetFinal = $teamTieSheetTable->patchEntities($teamTieSheet, $teamTieSheetData);
        if (empty($teamTieSheetFinal['error'])) {
            if ($teamTieSheetTable->saveMany($teamTieSheetFinal)) {
                $teamTieSheetLists = $teamTieSheetTable->find('all')->where(['event_activity_list_id' => $event_activity_list_id])->toArray();
                return true;
            } else {
                $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
                return false;
            }
        } else {
            $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
            return false;
        }
    }

    public function updateMyTeamTieSheet($data = null, $eventDetails = null, $score = null, $teamTieSheetLists = null, $event_activity_list_id) {
        //$teamTieSheetTable = TableRegistry::get('team_tie_sheets');
        $teamTieSheetTable = $this->MyTeams;
// Lets create a knock-out tournament between some of our dear physicists.
        $competitors = $data;
// Create initial tournament bracket.

        $KO = new KnockoutGD($competitors);
        foreach ($teamTieSheetLists as $key => $value) {
            //debug($teamTieSheetLists);
            $KO->setResByCompets($value['team1_event_team_detail_id'], $value['team2_event_team_detail_id'], $value['team1_score'], $value['team2_score']);
        }
        $tieSheetRoundData = $KO->getData($eventDetails);

        foreach ($teamTieSheetLists as $key => $value) {
            $teamTieSheetData[$key]['id'] = $value['id'];
            $teamTieSheetData[$key]['team1_event_team_detail_id'] = $tieSheetRoundData['round_matches'][$value['round_number']][$value['match_number']]['c1'];
            $teamTieSheetData[$key]['team2_event_team_detail_id'] = $tieSheetRoundData['round_matches'][$value['round_number']][$value['match_number']]['c2'];
            $teamTieSheetData[$key]['action_by'] = $_SESSION['Auth']['User']['id'];
            $teamTieSheetData[$key]['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $teamTieSheetData[$key]['modified'] = $currentTimeStamp;
        }
        
        // debug($tieSheetRoundData);die;
//        $i = 0;
//        foreach ($tieSheetRoundData['round_matches'] as $key_round => $value_round) {
//            foreach ($value_round as $key_match => $value_match) {
//                $teamTieSheetData[$i]['id'] = $teamTieSheetLists[$i]->id;
//                $teamTieSheetData[$i]['team1_event_team_detail_id'] = $value_match['c1'];
//                $teamTieSheetData[$i]['team2_event_team_detail_id'] = $value_match['c2'];
//                $teamTieSheetData[$i]['action_by'] = $_SESSION['Auth']['User']['id'];
//                $teamTieSheetData[$i]['action_ip'] = $_SERVER['REMOTE_ADDR'];
//                $i++;
//            }
//        }
//code for saving data in table
        $teamTieSheet = $teamTieSheetTable->newEntities($teamTieSheetData);
        $teamTieSheetFinal = $teamTieSheetTable->patchEntities($teamTieSheet, $teamTieSheetData);
        //debug($teamTieSheetFinal);
        if (empty($teamTieSheetFinal['error'])) {
            //die;
            if ($teamTieSheetTable->saveMany($teamTieSheetFinal)) {
                $teamTieSheetLists = $teamTieSheetTable->find('all')->where(['event_activity_list_id' => $event_activity_list_id])->toArray();
                return true;
            } else {
                $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
                return false;
            }
        } else {
            $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
            return false;
        }
    }

    public function getTeamsTieSheet($data = null, $eventDetails = null, $showImageFlag = null, $teamTieSheetLists = null) {

        if ($showImageFlag == true) {
// Depending on whether or not GD-lib is installed this example file will output differently.
            $GDLIB_INSTALLED = (function_exists("gd_info")) ? true : false;
        } else {
            $GDLIB_INSTALLED = (function_exists("gd_info")) ? false : false;
        }

// Lets create a knock-out tournament between some of our dear physicists.
        $competitors = $data;
//$competitors = array(
//    'Paul A.M. Dirac', 
//    'Hans Christian Oersted', 
//    'Murray Gell-Mann', 
//    'Marie Curie', 
//    'Neils Bohr', 
//    'Richard P. Feynman', 
//    'Max Planck');
// Create initial tournament bracket.
        $KO = new KnockoutGD($competitors);

// At this point the bracket looks like this:
        $bracket = $KO->getBracket();
        if (!$GDLIB_INSTALLED)
            print_r($bracket);


        /*
          ...which outputs:

          Array
          (
          [0] => Array
          (
          [0] => Array
          (
          [c1] => Paul A.M. Dirac
          [s1] => 0
          [c2] => Neils Bohr
          [s2] => 0
          )
          [1] => Array
          (
          [c1] => Hans Christian Oersted
          [s1] => 0
          [c2] => Richard P. Feynman
          [s2] => 0
          )
          [2] => Array
          (
          [c1] => Murray Gell-Mann
          [s1] => 0
          [c2] => Max Planck
          [s2] => 0
          )
          )
          [1] => Array
          (
          [0] => Array
          (
          [c1] =>
          [s1] => -1
          [c2] =>
          [s2] => -1
          )
          [1] => Array
          (
          [c1] =>
          [s1] => -1
          [c2] => Marie Curie
          [s2] => 0
          )
          )
          )

          EXPLANATION:
          ------------
          The above bracket contains the initial scheduled matches.
          The utmost array elements represent rounds in the tournament, where round (index) 0 is the play-in round, and round 1 is the first "proper" round.
          The round elements are arrays themselves, and contain match elements which are organized by 4 properties: Competitor 1 and 2, 'c1' and 'c2', and their scores 's1' and 's2'.
          Due to the nature of a knock-out tournament, the winner of a given match proceeds to a new match in the following round.
          For a match to exist in round N+1, it is therefore required that two matches have been played in round N.
          If a match entry contains a competitor score of -1, this denotes that the competitor is undecided due to an unplayed match in the preceding round.
          Once the result of the unplayed match is submitted, the undecided competitor will be updated.
         */

// Now, lets fill in some match results. This can be done two ways: either by directly specifying round and match indicies or by specifying competitor names.

        foreach ($teamTieSheetLists as $key => $value) {
         //   debug($value->team2_event_team_detail->description);die;
            $KO->setResByCompets(
                    $value->team1_event_team_detail->description, 
                    $value->team2_event_team_detail->description, 
                    $value['team1_score'], 
                    $value['team2_score']);
            //$returnData = $KO->getData($eventDetails);
        }

//$KO->setResByMatch('A', 'E', 1, 0); // Arguments: match index, round index, score 1, score 2.
// $KO->setResByCompets('A', 'E', 0, 1); // Arguments: competitor 1, competitor 2, score 1, score 2.
// $bracket = $KO->getBracket();print_r($bracket);
//$KO->setResByCompets('B', 'F', 0, 1); // Arguments: competitor 1, competitor 2, score 1, score 2.
// $bracket = $KO->getBracket(); print_r($bracket);
//$KO->setResByCompets('C', 'D', 1, 0);
// $bracket = $KO->getBracket(); print_r($bracket);
// $KO->setResByCompets('E', 'F', 1, 0);
// $bracket = $KO->getBracket();print_r($bracket);
//$KO->setResByCompets('C', 'E', 1, 0);
// $bracket = $KO->getBracket();print_r($bracket);
// At this point every undecided competitor from round 1 is now updated with the match winners of the preceding round. Dumping the return of $KO->getBracket() should agree with this - but it takes up to much space in this example file.
// Lets, just for the sake of it, fill out match 1 from round 1 since both competitors are now known!
//$KO->setResByMatch(1, 1, 4, 0);
// Now, we would like to know some details about the rounds in our bracket structure.
        if (!$GDLIB_INSTALLED)
            print_r($KO->roundsInfo);
// die;
        /*
          ...which outputs:

          Array
          (
          [0] => Array
          (
          [0] => Play-in round
          [1] => 6
          )

          [1] => Array
          (
          [0] => Semi-finals
          [1] => 4
          )

          [2] => Array
          (
          [0] => Final
          [1] => 2
          )

          )

          EXPLANATION:
          ------------
          Each utmost element is a description of a round in the bracket structure.
          The index of each element corresponds to the round number which the element describes.
          Each element contains two fields: the round title and the number of competitors in the round.
         */

// If GD-lib is installed, the below code will draw the bracket of the knock-out tournament.
        if ($GDLIB_INSTALLED) {
            $im = $KO->getImage($eventDetails);
            header('Content-type: image/png');
            imagepng($im);
            imagedestroy($im);
        }

        /*
         * Demonstration of helper-methods.
         */

        /*
          Lets say that we wish to rename all the competitors in the tournament bracket, then this is done by:

          $KO->renameCompets($dictionary);

          ...where the format of the $dictionary is:

          $dictionary = array(
          'Current name 1' => 'New name 1',
          'Current name 2' => 'New name 2',
          );

          ------------------------------------------

          Or you might want to know the status of a specific match, then these two methods might help you:

          $KO->isMatchCreated($m, $r)
          $KO->isMatchPlayed($m, $r)

          ...where $m and $r are the match and round bracket indicies.

          ------------------------------------------

          And finally, if a match (index) $m is played in round (index) $r,
          then the match winner will play a new match in round $r+1, at the following match index and competitor position:

          list($nextMatchIdx, $competitorPos) = $KO->getNextMatch($m);

          Doing the same but in opposite direction is also possible by:

          $prevMatchIdx = $KO->getPrevMatch($m, $competitorPos);
         */
    }

}
