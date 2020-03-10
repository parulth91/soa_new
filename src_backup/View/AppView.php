<?php

namespace App\View;

use BootstrapUI\View\UIView;

class AppView extends UIView {

    /**
     * Initialization hook method.
     */
    public function initialize() {
        //Don't forget to call the parent::initialize()
        parent::initialize();
        $this->loadHelper('CakeDC/Users.User');
        $this->loadHelper('FontAwesome.Fa');
    }

}

?>