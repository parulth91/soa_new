<nav id="sidebar" style="background: #38A9CE">
    <div class="sidebar-header">
        <h3>Super Admin</h3>
        <strong>SOA</strong>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-home"></i>
                Home
            </a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <?= $this->Html->link(__('Profile'), ['controller' => 'MyUsers', 'action' => 'profile', 'plugin' => false]) ?>
                </li>
                <li>
                    <?= $this->Html->link(__('Change Password'), ['controller' => 'MyUsers', 'action' => 'changePassword', 'plugin' => false]) ?>
                </li>       
            </ul>
        </li>



        <li>
            <a href="#register" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-screenshot"></i>
                Register
            </a>
            <ul class="collapse list-unstyled" id="register">
                <li><?= $this->Html->link(__('List of events'), ['controller' => 'RegisterCandidates', 'action' => 'view_all']) ?> </li></li>
                <li><?= $this->Html->link(__('RegisterCandidateEventActivities'), ['controller' => 'RegisterCandidateEventActivities', 'action' => 'index']) ?>
                
            </ul>
        </li>

        <li>
            <a href="#EventLists" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Event Lists
            </a>
            <ul class="collapse list-unstyled" id="EventLists">
                <li><?= $this->Html->link(__('List Event'), ['controller' => 'EventLists', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Event'), ['controller' => 'EventLists', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        </li>
        <li>

            <a href="#EventActivityLists" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Event Activity Lists
            </a>
            <ul class="collapse list-unstyled" id="EventActivityLists">
                <li><?= $this->Html->link(__('List EventActivity'), ['controller' => 'EventActivityLists', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New EventActivity'), ['controller' => 'EventActivityLists', 'action' => 'add']) ?> </li>

            </ul>
        </li>

        <li>
            <a href="#ActivityLists" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Activity Lists
            </a>
            <ul class="collapse list-unstyled" id="ActivityLists">
                <li><?= $this->Html->link(__('Activity List'), ['controller' => 'ActivityLists', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Activity'), ['controller' => 'ActivityLists', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#reports" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-screenshot"></i>
                Reports
            </a>
            <ul class="collapse list-unstyled" id="reports">
                <li><?= $this->Html->link(__('General'), ['controller' => 'Reports', 'action' => 'general']) ?> </li>
            </ul>
        </li>

        <!--  <li>
              <a href="#MsStates" data-toggle="collapse" aria-expanded="false">
                  <i class="glyphicon glyphicon-map-marker"></i>
                  Ms States
              </a>
              <ul class="collapse list-unstyled" id="MsStates">
                  <li><?//= $this->Html->link(__('List States'), ['controller' => 'MsStates', 'action' => 'index']) ?> </li>
                  <li><?//= $this->Html->link(__('New State'), ['controller' => 'MsStates', 'action' => 'add']) ?> </li>
  
              </ul>
          </li>-->
        <li>
            <a href="#CountryLists" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Country Lists
            </a>
            <ul class="collapse list-unstyled" id="CountryLists">
                <li><?= $this->Html->link(__('List Country'), ['controller' => 'CountryLists', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Country'), ['controller' => 'CountryLists', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#StateLists" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                State Lists
            </a>
            <ul class="collapse list-unstyled" id="StateLists">
                <li><?= $this->Html->link(__('List States'), ['controller' => 'StateLists', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New State'), ['controller' => 'StateLists', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#DistrictLists" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                District Lists
            </a>
            <ul class="collapse list-unstyled" id="DistrictLists">
                <li><?= $this->Html->link(__('List District'), ['controller' => 'DistrictLists', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New District'), ['controller' => 'DistrictLists', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        </li>
        <li>
        <li>
            <a href="#WeightCategoryLists" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Weight Category Lists
            </a>
            <ul class="collapse list-unstyled" id="WeightCategoryLists">
                <li><?= $this->Html->link(__('List Weight Category'), ['controller' => 'WeightCategoryLists', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Weight Category'), ['controller' => 'WeightCategoryLists', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        </li>
        <li>
            <a href="#AgeGroupLists" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Age Group Lists
            </a>
            <ul class="collapse list-unstyled" id="AgeGroupLists">
                <li><?= $this->Html->link(__('List Age Group'), ['controller' => 'AgeGroupLists', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Age Group'), ['controller' => 'AgeGroupLists', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        </li>

        <li>
            <a href="#GameTypesLists" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Game type Lists
            </a>
            <ul class="collapse list-unstyled" id="GameTypesLists">
                <li><?= $this->Html->link(__('Game type List'), ['controller' => 'GameTypeLists', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Game type'), ['controller' => 'GameTypeLists', 'action' => 'add']) ?> </li>

            </ul>
        </li>



        <li>
            <a href="#MyUsers" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Users
            </a>
            <ul class="collapse list-unstyled" id="MyUsers">
                <li><?= $this->Html->link(__('Users List'), ['controller' => 'MyUsers', 'action' => 'users_detail']) ?> </li>

            </ul>
        </li>  



        <li>
            <a href="#ReportingLists" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Reporting Lists
            </a>
            <ul class="collapse list-unstyled" id="ReportingLists">
                <li><?= $this->Html->link(__('Reporting List Index'), ['controller' => 'ReportingLists', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Reporting Lists Add'), ['controller' => 'ReportingLists', 'action' => 'add']) ?> </li>  
            </ul>
        </li>
        <li>
      <!--                        <i class="glyphicon glyphicon-paperclip"></i>-->
            <?= $this->Html->link(__('Instructions for JEB 2020'), ['controller' => 'Pages', 'action' => 'instruction']) ?> 

        </li>
        <li>

<!--                        <i class="glyphicon glyphicon-send"></i>-->
            <?= $this->Html->link(__('Contact Us'), ['controller' => 'Pages', 'action' => 'contactUs']) ?> 
        </li>
        <li>

<!--                        <i class="glyphicon glyphicon-send"></i>-->
            <?= $this->Html->link(__('Unit Location Matrix'), ['controller' => 'Pages', 'action' => 'location_matrix']) ?> 
        </li>
        <li>

<!--                        <i class="glyphicon glyphicon-send"></i>-->
            <?= $this->Html->link(__d('Admin', 'LOG'), ['controller' => 'Admin/DatabaseLog', 'action' => 'logs']) ?> 
        </li>
    </ul>

    <ul class="list-unstyled CTAs">
        <li><a href="#" class="download">SOA</a></li>
    </ul>
</nav>
