<nav id="sidebar" style="background: #38A9CE">
    <div class="sidebar-header">
        <h3>Admin</h3>
        <strong>ABS</strong>
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
            <a href="#EmployeeInformations" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-screenshot"></i>
                JEB Entry
            </a>
            <ul class="collapse list-unstyled" id="EmployeeInformations">
              
                <li><?= $this->Html->link(__('New JEB Entry'), ['controller' => 'EmployeeInformations', 'action' => 'add_data']) ?> </li>
                <li><?= $this->Html->link(__('My List'), ['controller' => 'EmployeeInformations', 'action' => 'my_list']) ?> </li>
            </ul>
        </li>
        <li>
            <a href="#allocation" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-screenshot"></i>
                Allocation
            </a>
            <ul class="collapse list-unstyled" id="allocation">
                <li><?= $this->Html->link(__('Allocation'), ['controller' => 'JebAllocations', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Manual Allocation'), ['controller' => 'JebAllocations', 'action' => 'manualAllocation']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#cases" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-screenshot"></i>
                Case Rules
            </a>
            <ul class="collapse list-unstyled" id="cases">
                <li><?= $this->Html->link(__('List Case Types'), ['controller' => 'CaseTypes', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Add Case Types'), ['controller' => 'CaseTypes', 'action' => 'add']) ?> </li>
                <li><?= $this->Html->link(__('List Case Rules'), ['controller' => 'CaseRules', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Add Case Rules'), ['controller' => 'CaseRules', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsStates" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms States
            </a>
            <ul class="collapse list-unstyled" id="MsStates">
                <li><?= $this->Html->link(__('List States'), ['controller' => 'MsStates', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New State'), ['controller' => 'MsStates', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsCadres" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Cadre
            </a>
            <ul class="collapse list-unstyled" id="MsCadres">
                <li><?= $this->Html->link(__('List Cadre'), ['controller' => 'MsCadres', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Cadre'), ['controller' => 'MsCadres', 'action' => 'add']) ?> </li>

            </ul>
        </li>


        <li>

            <a href="#MsRanks" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Rank
            </a>
            <ul class="collapse list-unstyled" id="MsRanks">
                <li><?= $this->Html->link(__('List Rank'), ['controller' => 'MsRanks', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Rank'), ['controller' => 'MsRanks', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsFrontiers" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Frontiers
            </a>
            <ul class="collapse list-unstyled" id="MsFrontiers">
                <li><?= $this->Html->link(__('List Frontiers'), ['controller' => 'MsFrontiers', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Frontiers'), ['controller' => 'MsFrontiers', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>

            <a href="#MsUnits" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Units
            </a>
            <ul class="collapse list-unstyled" id="MsUnits">
                <li><?= $this->Html->link(__('List Unit'), ['controller' => 'MsUnits', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Unit'), ['controller' => 'MsUnits', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>

            <a href="#MsLocations" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Locations
            </a>
            <ul class="collapse list-unstyled" id="MsLocations">
                <li><?= $this->Html->link(__('List Locations'), ['controller' => 'MsLocations', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Locations'), ['controller' => 'MsLocations', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        
    
        <li>

            <a href="#MsUnitCategories" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Unit Categories
            </a>
            <ul class="collapse list-unstyled" id="MsUnitCategories">
                <li><?= $this->Html->link(__('List  Unit Categories'), ['controller' => 'MsUnitCategories', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New  Unit Categories'), ['controller' => 'MsUnitCategories', 'action' => 'add']) ?> </li>

            </ul>
        </li>

        <li>
            <a href="#MsCourses" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Courses
            </a>
            <ul class="collapse list-unstyled" id="MsCourses">
                <li><?= $this->Html->link(__('List Courses'), ['controller' => 'MsCourses', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Courses'), ['controller' => 'MsCourses', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsMedicalCategories" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Medical Categories
            </a>
            <ul class="collapse list-unstyled" id="MsMedicalCategories">
                <li><?= $this->Html->link(__('List Medical Categories'), ['controller' => 'MsMedicalCategories', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Medical Categories'), ['controller' => 'MsMedicalCategories', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsPatientRelationships" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Patient Relationships
            </a>
            <ul class="collapse list-unstyled" id="MsPatientRelationships">
                <li><?= $this->Html->link(__('List Patient Relationships'), ['controller' => 'MsPatientRelationships', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Patient Relationships'), ['controller' => 'MsPatientRelationships', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsNameOfBranches" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Name Of Branches
            </a>
            <ul class="collapse list-unstyled" id="MsNameOfBranches">
                <li><?= $this->Html->link(__('List Name Of Branches'), ['controller' => 'MsNameOfBranches', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Name Of Branches'), ['controller' => 'MsNameOfBranches', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsTypeOfGrievances" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Type Of Grievances
            </a>
            <ul class="collapse list-unstyled" id="MsTypeOfGrievances">
                <li><?= $this->Html->link(__('List Type Of Grievances'), ['controller' => 'MsTypeOfGrievances', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Type Of Grievances'), ['controller' => 'MsTypeOfGrievances', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsRecommendedBy" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Recommended By
            </a>
            <ul class="collapse list-unstyled" id="MsRecommendedBy">
                <li><?= $this->Html->link(__('List Recommended By'), ['controller' => 'MsRecommendedBy', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Recommended By'), ['controller' => 'MsRecommendedBy', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsRecommendedFor" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Recommended For
            </a>
            <ul class="collapse list-unstyled" id="MsRecommendedFor">
                <li><?= $this->Html->link(__('List Recommended For'), ['controller' => 'MsRecommendedFor', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Recommended For'), ['controller' => 'MsRecommendedFor', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsModeOfAppointments" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Mode Of Appointments
            </a>
            <ul class="collapse list-unstyled" id="MsModeOfAppointments">
                <li><?= $this->Html->link(__('List Mode Of Appointments'), ['controller' => 'MsModeOfAppointments', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Mode Of Appointments'), ['controller' => 'MsModeOfAppointments', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#Vacancies" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Vacancies
            </a>
            <ul class="collapse list-unstyled" id="Vacancies">
                <li><?= $this->Html->link(__('List Vacancies'), ['controller' => 'Vacancies', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Vacancies'), ['controller' => 'Vacancies', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#CadreRanks" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Cadre Ranks
            </a>
            <ul class="collapse list-unstyled" id="CadreRanks">
                <li><?= $this->Html->link(__('List CadreRanks'), ['controller' => 'CadreRanks', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New CadreRanks'), ['controller' => 'CadreRanks', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsDiseases" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Diseases
            </a>
            <ul class="collapse list-unstyled" id="MsDiseases">
                <li><?= $this->Html->link(__('List Diseases'), ['controller' => 'MsDiseases', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Diseases'), ['controller' => 'MsDiseases', 'action' => 'add']) ?> </li>

            </ul>
        </li>
        <li>
            <a href="#MsGenders" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-map-marker"></i>
                Ms Genders
            </a>
            <ul class="collapse list-unstyled" id="MsGenders">
                <li><?= $this->Html->link(__('List Genders'), ['controller' => 'MsGenders', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Genders'), ['controller' => 'MsGenders', 'action' => 'add']) ?> </li>

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

    </ul>

    <ul class="list-unstyled CTAs">
        <li><a href="#" class="download">ABS ITBP</a></li>
    </ul>
</nav>
