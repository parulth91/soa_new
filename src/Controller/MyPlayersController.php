<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use App\Oad\Commons\Utils\KnockoutGD;

/**
 * MyPlayers Controller
 *
 * @property \App\Model\Table\MyPlayersTable $MyPlayers
 *
 * @method \App\Model\Entity\PlayerTieSheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MyPlayersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
//    public function index() {
//        $this->paginate = [
//            'contain' => ['EventActivityLists', 'WRegisterCandidateEventActivities', 'P1RegisterCandidateEventActivities', 'P2RegisterCandidateEventActivities']
//        ];
//        $playerTieSheets = $this->paginate($this->MyPlayers);
//
//        $this->set(compact('playerTieSheets'));
//    }


    public function index($id = null) {
        $Result = $this->MyPlayers->find()->contain([
                            'EventActivityLists'
                            , 'WinnerPlayers'
                            , 'Player1s'
                            , 'Player2s'
                        ])
                        ->where(['MyPlayers.event_activity_list_id' => $id])->order(['round_number' => 'ASC', 'match_number' => 'ASC']);
//        $this->paginate = [
//            'contain' => ['EventActivityLists', 'WinnerEventTeamDetails', 'Team1EventTeamDetails', 'Team2EventTeamDetails']
//        ];
        $playerTieSheets = $this->paginate($Result);
        //debug($playerTieSheets);die;
        $this->set(compact('playerTieSheets'));
    }

    /**
     * View method
     *
     * @param string|null $id Player Tie Sheet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $playerTieSheet = $this->MyPlayers->get($id, [
            'contain' => ['EventActivityLists', 'WinnerPlayers', 'Player1s', 'Player2s']
        ]);

        $this->set('playerTieSheet', $playerTieSheet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $playerTieSheet = $this->MyPlayers->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];

            $playerTieSheet = $this->MyPlayers->patchEntity($playerTieSheet, $this->request->getData());
            if ($this->MyPlayers->save($playerTieSheet)) {
                $this->Flash->success(__('The player tie sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The player tie sheet could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->MyPlayers->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $winnerPlayers = $this->MyPlayers->WinnerPlayers->find('list', ['keyField' => 'id', 'valueField' => 'registration_number'])->where(['active' => true])->order('registration_number');
        $player1s = $this->MyPlayers->Player1s->find('list', ['keyField' => 'id', 'valueField' => 'registration_number'])->where(['active' => true])->order('registration_number');
        $player2s = $this->MyPlayers->Player2s->find('list', ['keyField' => 'id', 'valueField' => 'registration_number'])->where(['active' => true])->order('registration_number');
        $this->set(compact('playerTieSheet', 'eventActivityLists', 'winnerPlayers', 'player1s', 'registration_number'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Player Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $playerTieSheet = $this->MyPlayers->get($id, [
            'contain' => []
        ]);
        //debug($playerTieSheet);die;
        $event_activity_list_id = $playerTieSheet->event_activity_list_id;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $this->request->data['modified'] = $currentTimeStamp;


            $playerTieSheet = $this->MyPlayers->patchEntity($playerTieSheet, $this->request->getData());
            if ($this->MyPlayers->save($playerTieSheet)) {
                $this->Flash->success(__('The player tie sheet has been saved.'));

                return $this->redirect(['action' => 'index', $playerTieSheet->event_activity_list_id]);
            }
            $this->Flash->error(__('The player tie sheet could not be saved. Please, try again.'));
        }
        $eventActivityLists = $this->MyPlayers->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $winnerPlayers = $this->MyPlayers->WinnerPlayers->find('list', ['keyField' => 'id', 'valueField' => 'registration_number'])->where(['active' => true])->order('registration_number');
        $player1s = $this->MyPlayers->Player1s->find('list', ['keyField' => 'id', 'valueField' => 'registration_number'])->where(['active' => true, 'event_activity_list_id' => $event_activity_list_id])->order('registration_number');
        $player2s = $this->MyPlayers->Player2s->find('list', ['keyField' => 'id', 'valueField' => 'registration_number'])->where(['active' => true, 'event_activity_list_id' => $event_activity_list_id])->order('registration_number');
        $this->set(compact('playerTieSheet', 'eventActivityLists', 'winnerPlayers', 'player1s', 'player2s'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Player Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $playerTieSheet = $this->MyPlayers->get($id);
        if ($this->MyPlayers->delete($playerTieSheet)) {
            $this->Flash->success(__('The player tie sheet has been deleted.'));
        } else {
            $this->Flash->error(__('The player tie sheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function updateResult($id = null) {
        $playerTieSheet = $this->MyPlayers->get($id, [
            'contain' => ['EventActivityLists'
                , 'WinnerPlayers'
                , 'Player1s'
                , 'Player2s']
        ]);
        //debug($playerTieSheet);die;
        $event_activity_list_id = $playerTieSheet->event_activity_list_id;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $this->request->data['update_tiesheet'] = true;
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $this->request->data['modified'] = $currentTimeStamp;
            //debug($this->request->data);die;
            if ($this->request->data['player1_score'] > $this->request->data['player2_score']) {
                $this->request->data['winner_player_id'] = $playerTieSheet->player1_id;
            } elseif ($this->request->data['player1_score'] < $this->request->data['player2_score']) {
                $this->request->data['winner_player_id'] = $playerTieSheet->player2_id;
            }

            $playerTieSheet = $this->MyPlayers->patchEntity($playerTieSheet, $this->request->getData());
            if ($this->MyPlayers->save($playerTieSheet)) {
                $this->Flash->success(__('The player tie sheet has been saved.'));

                return $this->redirect(['action' => 'index', $playerTieSheet->event_activity_list_id]);
            }
            $this->Flash->error(__('The player tie sheet could not be saved. Please, try again.'));
        }
        //$eventActivityLists = $this->MyPlayers->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active'=>true])->order('description');
        //$winnerPlayers = $this->MyPlayers->WinnerPlayers->find('list', ['keyField' => 'id', 'valueField' => 'registration_number'])->where(['active' => true])->order('registration_number');
        //$player1s = $this->MyPlayers->Player1s->find('list', ['keyField' => 'id', 'valueField' => 'registration_number'])->where(['active'=>true,'event_activity_list_id'=>$event_activity_list_id])->order('registration_number');
        //$player2s = $this->MyPlayers->Player2s->find('list', ['keyField' => 'id', 'valueField' => 'registration_number'])->where(['active'=>true,'event_activity_list_id'=>$event_activity_list_id])->order('registration_number');
        $this->set(compact('playerTieSheet'));
    }

    public function tieSheet($id = null) {
        $eventActivityListTable = TableRegistry::get('event_activity_lists');
        $eventActivityLists = $eventActivityListTable->find('all')
                        ->contain([
                            'ActivityLists' => ['WeightCategoryLists', 'AgeGroupLists', 'GenderLists', 'GameTypeLists'],
                            'EventTeamDetails' => [],
                            'EventLists' => [],
                            'EventTeamDetails' => [],
                            'RegisterCandidateEventActivities' => [],
                            'RegisterCandidateEventActivities' => function ($q) {
                                return $q->where(['RegisterCandidateEventActivities.attendance_status' => true]);
                            }
                        ])->where(['event_activity_lists.id' => $id
                        //, 'register_candidate_event_activities.attendance_status' => true
                ])->toArray();
      //  debug($eventActivityLists);die;
        //$this->myPlayersTieSheets($eventActivityLists[0]->event_list_id, $id, $eventActivityLists[0]->event_player_details, $eventActivityLists[0]->description);
        $tieSheetHeader = $eventActivityLists[0]->event_list['description'] . '(' . $eventActivityLists[0]->description . ')';
        $this->myPlayersTieSheets($eventActivityLists[0]->event_lists_id, $id, $eventActivityLists[0]->register_candidate_event_activities, $tieSheetHeader);
            
       

        die;
    }

    public function myPlayersTieSheets($event_list_id = null, $event_activity_list_id = null, $player_data = null, $eventDetails = null) {

        $playerTieSheetTable = TableRegistry::get('player_tie_sheets');
        $playerTieSheetLists = $playerTieSheetTable->find('all')
                ->contain(['Player1s', 'Player2s'])
                ->where(['player_tie_sheets.event_activity_list_id' => $event_activity_list_id])
                ->order(['round_number' => 'ASC', 'match_number' => 'ASC'])
                ->toArray();
        $tieSheetUpdateReguiredFlag = $playerTieSheetTable->find('all')->where(['event_activity_list_id' => $event_activity_list_id, 'update_tiesheet' => true])->count();
        $playersId = null;
        foreach ($player_data as $key_player => $value_player) {

            $playersId[] = $value_player->id;
            $playerRegNo[] = $value_player->registration_number;
        }
        
           // die;
        if (count($playersId) <= 1) {
           $this->Flash->error(__('No player participated till now in this game. The player tie sheet could not be saved. Please, add players and try again.'));
          
            return $this->redirect(['controller' => 'RegisterCandidates', 'action' => 'viewEventActivities', $eventActivityLists[0]->event_lists_id ]);
        
            
        }
         //debug($playerTieSheetLists);die;
//round 1 check and new data entered in database
        if (empty($playerTieSheetLists)) {
            if ($this->createMyPlayersTieSheet($playersId, $eventDetails, true, $event_activity_list_id) == true) {
              
            } else {
                $this->Flash->error(__('Unable to create Tie sheet. The player tie sheet could not be saved. Please, try again.'));
                return false;
            }
        } elseif (!empty($playerTieSheetLists)) {
             //debug($playerTieSheetLists);
        
            // if result is updated then update the tie sheet data
            if (count($tieSheetUpdateReguiredFlag) > 0) {
                //debug($playerTieSheetLists);

                
                if ($this->updateMyPlayersTieSheet($playersId, $eventDetails, true, $playerTieSheetLists, $event_activity_list_id) == true) {
                  
                } else {
                    $this->Flash->error(__('Unable to update the tie sheet. The player tie sheet could not be saved. Please, try again.'));
                    return false;
                }
            }
        }
        //die;
        $this->getPlayersTieSheet($playerRegNo, $eventDetails, true, $playerTieSheetLists);
    }

    public function createMyPlayersTieSheet($data = null, $eventDetails = null, $score = null, $event_activity_list_id) {
        //$playerTieSheetTable = TableRegistry::get('player_tie_sheets');
        $playerTieSheetTable = $this->MyPlayers;
// Lets create a knock-out tournament between some of our dear physicists.
        $competitors = $data;
// Create initial tournament bracket.
        $KO = new KnockoutGD($competitors);
        $tieSheetRoundData = $KO->getData($eventDetails);
        // debug($tieSheetRoundData);die;
        $i = 0;
        foreach ($tieSheetRoundData['round_matches'] as $key_round => $value_round) {

            foreach ($value_round as $key_match => $value_match) {
                $playerTieSheetData[$i]['event_activity_list_id'] = $event_activity_list_id;
                $playerTieSheetData[$i]['round_number'] = $key_round;
                $playerTieSheetData[$i]['round_description'] = $tieSheetRoundData['rounds'][$key_round]['0'];
                $playerTieSheetData[$i]['match_number'] = $key_match;
                $playerTieSheetData[$i]['player1_id'] = $value_match['c1'];
                $playerTieSheetData[$i]['player2_id'] = $value_match['c2'];
                $playerTieSheetData[$i]['player1_score'] = $value_match['s1'];
                $playerTieSheetData[$i]['player2_score'] = $value_match['s2'];
                $playerTieSheetData[$i]['action_by'] = $_SESSION['Auth']['User']['id'];
                $playerTieSheetData[$i]['action_ip'] = $_SERVER['REMOTE_ADDR'];
                $playerTieSheetData[$i]['active'] = true;
                $i++;
            }
        }

//code for saving data in table
        $playerTieSheet = $playerTieSheetTable->newEntities($playerTieSheetData);

        $playerTieSheetFinal = $playerTieSheetTable->patchEntities($playerTieSheet, $playerTieSheetData);

        if (empty($playerTieSheetFinal['error'])) {
            if ($playerTieSheetTable->saveMany($playerTieSheetFinal)) {
                $playerTieSheetLists = $playerTieSheetTable->find('all')->where(['event_activity_list_id' => $event_activity_list_id])->toArray();
                return true;
            } else {
                $this->Flash->error(__('The player tie sheet could not be saved. Please, contact admin or try again.'));
                return false;
            }
        } else {
            $this->Flash->error(__('There is error in tie sheet data. The player tie sheet could not be saved. Please, try again.'));
            return false;
        }
    }

    public function updateMyPlayersTieSheet($data = null, $eventDetails = null, $score = null, $playerTieSheetLists = null, $event_activity_list_id) {
        

        
//$playerTieSheetTable = TableRegistry::get('player_tie_sheets');
        $playerTieSheetTable = $this->MyPlayers;
// Lets create a knock-out tournament between some of our dear physicists.
        $competitors = $data;
// Create initial tournament bracket.

        //debug($competitors);
        $KO = new KnockoutGD($competitors);
        foreach ($playerTieSheetLists as $key => $value) {
//            debug($value['player1_id']);
//            debug($value['player2_id']);
//            debug($value['player1_score']);
//            debug($value['player2_score']);
            $KO->setResByCompets($value['player1_id'], $value['player2_id'], $value['player1_score'], $value['player2_score']);
        }
       // die;
        $tieSheetRoundData = $KO->getData($eventDetails);
        // debug($tieSheetRoundData);
        foreach ($playerTieSheetLists as $key => $value) {
            $playerTieSheetNew[$key]['player1_id'] = null;
            $playerTieSheetNew[$key]['player2_id'] = null;
            $playerTieSheetNew[$key]['id'] = $value['id'];
            $playerTieSheetNew[$key]['player1_id'] = $tieSheetRoundData['round_matches'][$value['round_number']][$value['match_number']]['c1'];
            $playerTieSheetNew[$key]['player2_id'] = $tieSheetRoundData['round_matches'][$value['round_number']][$value['match_number']]['c2'];
            $playerTieSheetNew[$key]['player1_score'] = $tieSheetRoundData['round_matches'][$value['round_number']][$value['match_number']]['s1'];
            $playerTieSheetNew[$key]['player2_score'] = $tieSheetRoundData['round_matches'][$value['round_number']][$value['match_number']]['s2'];
            $playerTieSheetNew[$key]['action_by'] = $_SESSION['Auth']['User']['id'];
            $playerTieSheetNew[$key]['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $playerTieSheetNew[$key]['update_tiesheet'] = false;
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $playerTieSheetNew[$key]['modified'] = $currentTimeStamp;
        }
        //debug($playerTieSheetNew);die;
//        //debug($playerTieSheetLists);
//        debug($tieSheetRoundData);
//        die;
//        $i = 0;
//        foreach ($tieSheetRoundData['round_matches'] as $key_round => $value_round) {
//            foreach ($value_round as $key_match => $value_match) {
////                $playerTieSheetData[$i]['id'] = $playerTieSheetLists[$i]->id;
//                $playerTieSheetData[$i]['player1_id'] = $value_match['c1'];
//                $playerTieSheetData[$i]['player2_id'] = $value_match['c2'];
//                $playerTieSheetData[$i]['action_by'] = $_SESSION['Auth']['User']['id'];
//                $playerTieSheetData[$i]['action_ip'] = $_SERVER['REMOTE_ADDR'];
//                $i++;
//            }
//        }
//        debug($playerTieSheetData);
//        die;
//code for saving data in table
        $playerTieSheet = $playerTieSheetTable->newEntities($playerTieSheetNew);
        $playerTieSheetFinal = $playerTieSheetTable->patchEntities($playerTieSheet, $playerTieSheetNew);
        //debug($playerTieSheetFinal);
        if (empty($playerTieSheetFinal['error'])) {

            if ($playerTieSheetTable->saveMany($playerTieSheetFinal)) {

                $playerTieSheetLists = $playerTieSheetTable->find('all')->where(['event_activity_list_id' => $event_activity_list_id])->toArray();
                //die;
                return true;
            } else {
                $this->Flash->error(__('The player tie sheet could not be saved. Please, try again.'));
                return false;
            }
        } else {
            $this->Flash->error(__('The player tie sheet could not be saved. Please, try again.'));
            return false;
        }
    }

    public function getPlayersTieSheet($data = null, $eventDetails = null, $showImageFlag = null, $playerTieSheetLists = null) {
//debug($data);
//debug($playerTieSheetLists);die;
        if ($showImageFlag == true) {
// Depending on whether or not GD-lib is installed this example file will output differently.
            $GDLIB_INSTALLED = (function_exists("gd_info")) ? true : false;
        } else {
            $GDLIB_INSTALLED = (function_exists("gd_info")) ? false : false;
        }

// Lets create a knock-out tournament between some of our dear physicists.
        $competitors = $data;
        //debug($competitors);
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

        foreach ($playerTieSheetLists as $key => $value) {
            debug($value);
            //if ($value['player1_id'] == 67 && $value['player2_id'] == 57) {
                //debug($competitors);
                //debug($value->player2['registration_number']);die;
                // debug($bracket);
                //  debug($KO->setResByCompets($value['player1_id'], $value['player2_id'], $value['player1_score'], $value['player2_score']));
                // debug("hi");
            //}

            $KO->setResByCompets($value['player1_id'], $value['player2_id'], $value['player1_score'], $value['player2_score']);
            //$KO->setResByCompets($value->player1['registration_number'], $value->player2['registration_number'], $value['player1_score'], $value['player2_score']);
            //$returnData = $KO->getData($eventDetails);
        }
        //die;
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
