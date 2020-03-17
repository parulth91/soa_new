<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use App\Utility\KnockoutGD;

/**
 * TeamTieSheets Controller
 *
 * @property \App\Model\Table\TeamTieSheetsTable $TeamTieSheets
 *
 * @method \App\Model\Entity\TeamTieSheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TieSheetsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['EventTeamDetails', 'EventActivityLists']
        ];
        $teamTieSheets = $this->paginate($this->TeamTieSheets);

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
        $teamTieSheet = $this->TeamTieSheets->get($id, [
            'contain' => ['EventTeamDetails', 'EventActivityLists']
        ]);

        $this->set('teamTieSheet', $teamTieSheet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $teamTieSheet = $this->TeamTieSheets->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];

            $teamTieSheet = $this->TeamTieSheets->patchEntity($teamTieSheet, $this->request->getData());
            if ($this->TeamTieSheets->save($teamTieSheet)) {
                $this->Flash->success(__('The team tie sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
        }
        $eventTeamDetails = $this->TeamTieSheets->EventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $eventActivityLists = $this->TeamTieSheets->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $this->set(compact('teamTieSheet', 'eventTeamDetails', 'eventActivityLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Team Tie Sheet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $teamTieSheet = $this->TeamTieSheets->get($id, [
            //'key' => 'EventActivityListId',
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['action_by'] = $_SESSION['Auth']['User']['id'];
            $this->request->data['action_ip'] = $_SERVER['REMOTE_ADDR'];
            $currentTimeStamp = Time::now();
            $currentTimeStamp->i18nFormat();
            $this->request->data['modified'] = $currentTimeStamp;


            $teamTieSheet = $this->TeamTieSheets->patchEntity($teamTieSheet, $this->request->getData());
            if ($this->TeamTieSheets->save($teamTieSheet)) {
                $this->Flash->success(__('The team tie sheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team tie sheet could not be saved. Please, try again.'));
        }
        $eventTeamDetails = $this->TeamTieSheets->EventTeamDetails->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $eventActivityLists = $this->TeamTieSheets->EventActivityLists->find('list', ['keyField' => 'id', 'valueField' => 'description'])->where(['active' => true])->order('description');
        $this->set(compact('teamTieSheet', 'eventTeamDetails', 'eventActivityLists'));
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
        $teamTieSheet = $this->TeamTieSheets->get($id);
        if ($this->TeamTieSheets->delete($teamTieSheet)) {
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
        // debug($eventActivityLists[0]);
        if ($eventActivityLists[0]->activity_list->game_type_list->description == 'Team') {
            $this->teamTieSheets($eventActivityLists[0]->event_list_id, $id, $eventActivityLists[0]->event_team_details, $eventActivityLists[0]->description);
        } else {
            $this->individualTieSheets($eventActivityLists[0]->register_candidate_event_activities);
        }
//        debug($eventActivityLists[0]->register_candidate_event_activities);
//        debug($eventActivityLists);
//        debug($id);
        die;
        if ($this->request->is('post')) {
            
        } else {

            $eventActivitiyList = $this->cList->getAllEventActivityList($event_id);
            $this->set(compact('eventActivitiyList'));
        }
    }

    /**
     * The total number of players are generally 2k, where k is a natural number. 
     * There are cases when the number of players is not 2k. We will discuss them later. 
     * First, we will discuss the cases where we have 2k players. 
     * Few things to remember regarding such tournaments:

      Total number of matches = Total number of players – 1.
      Knockout tournaments will generally have seeded (ranked) players.
      Knockout tournaments will not have a tie. There will always be a tiebreaker. It is knockout after all.
      Upset means a lower seeded player defeat upper seeded player.
      The total number of rounds is k (from 2k) and kth round is the final round.
      First seeded player (rank 1) will play with last seeded player, rank 2 with second last seeded and so on.
     * * */
    public function teamTieSheets($event_list_id = null, $event_activity_list_id = null, $team_data = null, $eventDetails = null) {

        $teamTieSheetTable = TableRegistry::get('team_tie_sheets');
        $teamTieSheetLists = $teamTieSheetTable->find('all')
                        ->contain([
//                            'ActivityLists' => ['WeightCategoryLists', 'AgeGroupLists', 'GenderLists', 'GameTypeLists'],
//                            'EventTeamDetails' => [],
//                            'EventLists' => [],
//                            'EventTeamDetails' => [],
//                            'RegisterCandidateEventActivities' => []
                        ])->where(['event_activity_list_id' => $event_activity_list_id])->toArray();
        foreach ($team_data as $key => $value) {
            $playersId[] = $value->id;
        }
        //debug($teamTieSheetLists);
        //
        //round 1 check and new data entered in database
        if (empty($teamTieSheetLists)) {
            // $this->getTieSheet($playersId, $eventDetails, true);
            $tieSheetRoundData = $this->createKnockoutDataNew($playersId, $eventDetails);
            debug($tieSheetRoundData);
            foreach ($tieSheetRoundData['rounds'] as $key => $value) {
                $teamTieSheetData['round_number'] = $key + 1;
                $teamTieSheetData['round_description'] = $value[0];
                $matchCount=$value[1] / 2;
                while ($matchCount > '0') {
                    $teamTieSheetData['action_by'] = $_SESSION['Auth']['User']['id'];
                    $teamTieSheetData['action_ip'] = $_SERVER['REMOTE_ADDR'];
                    $teamTieSheet = $teamTieSheetTable->newEntity();
                    $teamTieSheet = $teamTieSheetTable->patchEntity($teamTieSheet, $teamTieSheetData);
                    debug($teamTieSheet);
                }
            }
            //debug($tieSheetRoundData);
            die;
            $getAllMatches;

            if ($this->TeamTieSheets->save($teamTieSheet)) {
                $this->teamTieSheets($event_list_id, $event_activity_list_id, $team_data, $eventDetails);
                //$this->Flash->success(__('The team tie sheet has been saved.'));
            } else {
                $this->Flash->error(__('The team tie sheet could not be saved. Please, try again or contact Admin.'));
                return $this->redirect(['controller' => 'RegisterCandidates', 'action' => 'view_event_activities', $event_list_id]);
            }
        } else {

            //$this->getTieSheetImage($playersId, $eventDetails);
            $this->getTieSheet($playersId, $eventDetails, true);
        }
        die;

        $total_teams = count($team_data);
        $total_matches = $total_teams - 1;

        // $matches = $this->createDrawKnockoutSinglesNew($playerIds, $eventDetails);

        die;
    }

    public function createKnockoutDataNew($data = null, $eventDetails = null) {
        // Lets create a knock-out tournament between some of our dear physicists.
        $competitors = $data;
        // Create initial tournament bracket.
        $KO = new KnockoutGD($competitors);
        $returnData['match'] = $KO->getBracket();
        $returnData['rounds'] = $KO->roundsInfo;
        return $returnData;
    }

    public function getTieSheet($data = null, $eventDetails = null, $showImageFlag = null) {

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
        //$KO->setResByMatch('A', 'E', 1, 0); // Arguments: match index, round index, score 1, score 2.
        $KO->setResByCompets('A', 'E', 0, 1); // Arguments: competitor 1, competitor 2, score 1, score 2.
        // $bracket = $KO->getBracket();print_r($bracket);
        $KO->setResByCompets('B', 'F', 0, 1); // Arguments: competitor 1, competitor 2, score 1, score 2.
        // $bracket = $KO->getBracket(); print_r($bracket);
        $KO->setResByCompets('C', 'D', 1, 0);
        // $bracket = $KO->getBracket(); print_r($bracket);
        $KO->setResByCompets('E', 'F', 1, 0);
        // $bracket = $KO->getBracket();print_r($bracket);
        $KO->setResByCompets('C', 'E', 1, 0);
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

    public function individualTieSheets() {
        
    }

}
