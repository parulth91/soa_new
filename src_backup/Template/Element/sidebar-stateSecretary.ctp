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
            <a href="#reports" data-toggle="collapse" aria-expanded="false">
                <i class="glyphicon glyphicon-screenshot"></i>
                Reports
            </a>
            <ul class="collapse list-unstyled" id="reports">
                <li><?= $this->Html->link(__('General'), ['controller' => 'Reports', 'action' => 'general']) ?> </li>
            </ul>
        </li>



  

        

  
    </ul>

    <ul class="list-unstyled CTAs">
        <li><a href="#" class="download">SOA</a></li>
    </ul>
</nav>
