<!DOCTYPE html> 
<?php

use Cake\Core\Configure;

//$this->Html->css('BootstrapUI.dashboard', ['block' => true]);
echo $this->Html->css('bootstrap/bootstrap.min.css');
echo $this->Html->css('bootstrap/bootstrap.css');
echo $this->Html->css('bootstrap/font.css');
echo $this->Html->script(['jquery/jquery.js', 'jquery/jquery-1.12.0.min']);
echo $this->Html->script(['jquery/validation.js']);
//echo $this->Html->script(['jquery-2.1.3']);
//echo $this->Html->script(['jspdf']);
//echo $this->Html->script(['pdfFromHTML']);

echo $this->Html->script(['bracket/jquery.bracket.min.js']);
echo $this->Html->script(['bracket/jquery-1.11.3.min']);
echo $this->Html->css('jquery.bracket.min') 

?>

    <?= $this->Html->script('calendarjs/jquery-ui') ?> 
    <?= $this->Html->script('calendarjs/script') ?> 


    <?= $this->Html->css('jquery-ui') ?>
    <?= $this->Html->css('jquery.timepicker.min') ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Meta declaration for hindi content-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--/Meta declaration for hindi content-->

<body>


    <div class="wrapper">
        <!-- Sidebar Holder -->
     <?php
        //debug($_SESSION['Auth']['User']['role']);die;
        if ($_SESSION['Auth']['User']['role'] == 'superadmin') {
            echo $this->element('sidebar-superadmin');

            //$this->extend('../Layout/TwitterBootstrap/superadmindashboard');    
        } else if ($_SESSION['Auth']['User']['role'] == 'stateSecretary') {
            echo $this->element('sidebar-stateSecretary');
            // $this->extend('../Layout/TwitterBootstrap/admindashboard');
        } else {
            echo "Unauthorized login user Unit";
            die;
            //$this->extend('../Layout/TwitterBootstrap/userdashboard');
        }
        ?>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-default" style="width:1024px;">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <h3><i class="glyphicon glyphicon-menu-hamburger">
                                    &nbsp;<i class="glyphicon glyphicon-king">
                                        &nbsp;Welcome </i>
                                    &nbsp;<?php 
                                   
                                    echo ucwords($_SESSION['Auth']['User']['username']);  
                                    
                                    echo " (".ucwords($_SESSION['Auth']['User']['role']).")"; 
                                    ?></i>
                            </h3>

                        </button>

                    </div>


                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right btn btn-danger" style=" text-align: center;   padding-left: 12px;">
                            <!--                                <li><a href="#">Page</a></li>
                                                            <li><a href="#">Page</a></li>
                                                            <li><a href="#">Page</a></li>-->
                            <?= $this->User->logout(); ?>
                        </ul>
                        <br><br> 
                        <div class="col-md-2" style=" float: right;">
                    <?php // echo $this->Form->button('Back to Page', array('name' => 'btn')); ?>
                            <button type="button" class="btn btn-info" id="print" onclick="goBack()">Back to Previous Page</button>  
                        </div>

                    </div>

                </div>




            </nav>


            <div class="cover">

                <?php
                /**
                 * Default `flash` block.
                 */
                if (!$this->fetch('tb_flash')) {
                    $this->start('tb_flash');
                    if (isset($this->Flash))
                        echo $this->Flash->render();
                    $this->end();
                }
                ?>
                <?php echo $this->fetch('content'); ?>


            </div>
        </div>
    </div>



    <script>
        function goBack() {
            window.history.back();
        }
    </script>



    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>


    <style type="text/css">
        /*
        DEMO STYLE
        */
        .cover {
            /*     width: 100%;
                  height: 100%;*/
            /*      background-color: #fafafa;*/
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fafafa;
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            font-weight: 300;
            line-height: 1.7em;
            color: #999;
        }

        a, a:hover, a:focus {
            color: inherit;
            text-decoration: none;
            transition: all 0.3s;
        }

        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 0;
            margin-bottom: 40px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar-btn {
            box-shadow: none;
            outline: none !important;
            border: none;
        }

        .line {
            width: 100%;
            height: 1px;
            border-bottom: 1px dashed #ddd;
            margin: 40px 0;
        }

        i, span {
            display: inline-block;
        }

        /* ---------------------------------------------------
            SIDEBAR STYLE
        ----------------------------------------------------- */
        .wrapper {
            display: flex;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #7386D5;
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar.active {
            min-width: 80px;
            max-width: 80px;
            text-align: center;
        }

        #sidebar.active .sidebar-header h3, #sidebar.active .CTAs {
            display: none;
        }

        #sidebar.active .sidebar-header strong {
            display: block;
        }

        #sidebar ul li a {
            text-align: left;
        }

        #sidebar.active ul li a {
            padding: 20px 10px;
            text-align: center;
            font-size: 0.85em;
        }

        #sidebar.active ul li a i {
            margin-right:  0;
            display: block;
            font-size: 1.8em;
            margin-bottom: 5px;
        }

        #sidebar.active ul ul a {
            padding: 10px !important;
        }

        #sidebar.active a[aria-expanded="false"]::before, #sidebar.active a[aria-expanded="true"]::before {
            top: auto;
            bottom: 5px;
            right: 50%;
            -webkit-transform: translateX(50%);
            -ms-transform: translateX(50%);
            transform: translateX(50%);
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #6d7fcc;
        }

        #sidebar .sidebar-header strong {
            display: none;
            font-size: 1.8em;
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }
        #sidebar ul li a:hover {
            color: #7386D5;
            background: #fff;
        }
        #sidebar ul li a i {
            margin-right: 10px;
        }

        #sidebar ul li.active > a, a[aria-expanded="true"] {
            color: #fff;
            background: #6d7fcc;
        }


        a[data-toggle="collapse"] {
            position: relative;
        }

        a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
            content: '\e259';
            display: block;
            position: absolute;
            right: 20px;
            font-family: 'Glyphicons Halflings';
            font-size: 0.6em;
        }
        a[aria-expanded="true"]::before {
            content: '\e260';
        }


        ul ul a {
            font-size: 0.9em !important;
            padding-left: 30px !important;
            background: #6d7fcc;
        }

        ul.CTAs {
            padding: 20px;
        }

        ul.CTAs a {
            text-align: center;
            font-size: 0.9em !important;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        a.download {
            background: #fff;
            color: #7386D5;
        }

        a.article, a.article:hover {
            background: #6d7fcc !important;
            color: #fff !important;
        }



        /* ---------------------------------------------------
            CONTENT STYLE
        ----------------------------------------------------- */
        #content {
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }


        /* ---------------------------------------------------
            MEDIAQUERIES
        ----------------------------------------------------- */
        @media (max-width: 768px) {
            #sidebar {
                min-width: 80px;
                max-width: 80px;
                text-align: center;
                margin-left: -80px !important ;
            }
            a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
                top: auto;
                bottom: 5px;
                right: 50%;
                -webkit-transform: translateX(50%);
                -ms-transform: translateX(50%);
                transform: translateX(50%);
            }
            #sidebar.active {
                margin-left: 0 !important;
            }

            #sidebar .sidebar-header h3, #sidebar .CTAs {
                display: none;
            }

            #sidebar .sidebar-header strong {
                display: block;
            }

            #sidebar ul li a {
                padding: 20px 10px;
            }

            #sidebar ul li a span {
                font-size: 0.85em;
            }
            #sidebar ul li a i {
                margin-right:  0;
                display: block;
            }

            #sidebar ul ul a {
                padding: 10px !important;
            }

            #sidebar ul li a i {
                font-size: 1.3em;
            }
            #sidebar {
                margin-left: 0;
            }
            #sidebarCollapse span {
                display: none;
            }
        }

    </style>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>
</html>