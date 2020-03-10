<?php
/* @var $this \Cake\View\View */
$this->Html->css('BootstrapUI.signin', ['block' => true]);
$this->prepend('tb_body_attrs', ' class="' . implode(' ', [$this->request->controller, $this->request->action]) . '" ');
$this->start('tb_body_start');

//$this->Html->css('BootstrapUI.dashboard', ['block' => true]);
echo $this->Html->css('bootstrap/bootstrap.min.css');
echo $this->Html->css('bootstrap/bootstrap.css');
echo $this->Html->css('bootstrap/font.css');
echo $this->Html->script(['jquery/jquery.js', 'jquery/jquery-1.12.0.min']);
echo $this->Html->script(['jquery/validation.js']);


  
   
   
 
    
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
<?= $this->Html->script('calendarjs/jquery-ui') ?> 
    <?= $this->Html->script('calendarjs/script') ?> 
  
   
    <?= $this->Html->css('jquery-ui') ?>
    <?= $this->Html->css('jquery.timepicker.min') ?>
<body <?= $this->fetch('tb_body_attrs') ?>>
    <div class="container">   
        <?php
        $this->end();

        $this->start('tb_body_end');
        echo '</body>';
        $this->end();

        $this->start('tb_footer');
        echo ' ';
        $this->end();

        $this->append('content', '</div>');
        ?>
        <!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>ABS Form</title>

<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>-->

</head>
<body>
        <?php
        echo $this->fetch('content');
        ?>
<!--     Portfolio<a id="portfolio" href="http://andytran.me/" title="View my portfolio!"><i class="fa fa-link"></i></a>-->
<!-- CodePen<a id="codepen" href="https://codepen.io/andytran/" title="Follow me!"><i class="fa fa-codepen"></i></a>-->
<!--  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

  



</body>

</html>        
        
        
        <style type="text/css">
            body {
                background: #e9e9e9;
                color: #666666;
                font-family: 'RobotoDraft', 'Roboto', sans-serif;
                font-size: 14px;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            /* Pen Title */
            .pen-title {
                padding: 50px 0;
                text-align: center;
                letter-spacing: 2px;
            }
            .pen-title h1 {
                margin: 0 0 20px;
                font-size: 48px;
                font-weight: 300;
            }
            .pen-title span {
                font-size: 12px;
            }
            .pen-title span .fa {
                color: #ed2553;
            }
            .pen-title span a {
                color: #ed2553;
                font-weight: 600;
                text-decoration: none;
            }

            /* Rerun */
            .rerun {
                margin: 0 0 30px;
                text-align: center;
            }
            .rerun a {
                cursor: pointer;
                display: inline-block;
                background: #ed2553;
                border-radius: 3px;
                -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                padding: 10px 20px;
                color: #ffffff;
                text-decoration: none;
                -webkit-transition: 0.3s ease;
                transition: 0.3s ease;
            }
            .rerun a:hover {
                -webkit-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
                box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
            }

            /* Scroll To Bottom */
            #codepen, #portfolio {
                position: fixed;
                bottom: 30px;
                right: 30px;
                background: #363636;
                width: 56px;
                height: 56px;
                border-radius: 100%;
                -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                -webkit-transition: 0.3s ease;
                transition: 0.3s ease;
                color: #ffffff;
                text-align: center;
            }
            #codepen i, #portfolio i {
                line-height: 56px;
            }
            #codepen:hover, #portfolio:hover {
                -webkit-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
            }

            /* CodePen */
            #portfolio {
                bottom: 96px;
                right: 36px;
                background: #ed2553;
                width: 44px;
                height: 44px;
                -webkit-animation: buttonFadeInUp 1s ease;
                animation: buttonFadeInUp 1s ease;
            }
            #portfolio i {
                line-height: 44px;
            }

            /* Container */
            .container {
                position: relative;
                max-width: 460px;
                width: 100%;
                margin: 0 auto 100px;
            }
            .container.active .card:first-child {
                background: #f2f2f2;
                margin: 0 15px;
            }
            .container.active .card:nth-child(2) {
                background: #fafafa;
                margin: 0 10px;
            }
            .container.active .card.alt {
                top: 20px;
                right: 0;
                width: 100%;
                min-width: 100%;
                height: auto;
                border-radius: 5px;
                padding: 60px 0 40px;
                overflow: hidden;
            }
            .container.active .card.alt .toggle {
                position: absolute;
                top: 40px;
                right: -70px;
                -webkit-box-shadow: none;
                box-shadow: none;
                -webkit-transform: scale(10);
                transform: scale(10);
                -webkit-transition: -webkit-transform .3s ease;
                transition: -webkit-transform .3s ease;
                transition: transform .3s ease;
                transition: transform .3s ease, -webkit-transform .3s ease;
            }
            .container.active .card.alt .toggle:before {
                content: '';
            }
            .container.active .card.alt .title,
            .container.active .card.alt .input-container,
            .container.active .card.alt .button-container {
                left: 0;
                opacity: 1;
                visibility: visible;
                -webkit-transition: .3s ease;
                transition: .3s ease;
            }
            .container.active .card.alt .title {
                -webkit-transition-delay: .3s;
                transition-delay: .3s;
            }
            .container.active .card.alt .input-container {
                -webkit-transition-delay: .4s;
                transition-delay: .4s;
            }
            .container.active .card.alt .input-container:nth-child(2) {
                -webkit-transition-delay: .5s;
                transition-delay: .5s;
            }
            .container.active .card.alt .input-container:nth-child(3) {
                -webkit-transition-delay: .6s;
                transition-delay: .6s;
            }
            .container.active .card.alt .button-container {
                -webkit-transition-delay: .7s;
                transition-delay: .7s;
            }

            /* Card */
            .card {
                position: relative;
                background: #ffffff;
                border-radius: 5px;
                padding: 60px 0 40px 0;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                -webkit-transition: .3s ease;
                transition: .3s ease;
                /* Title */
                /* Inputs */
                /* Button */
                /* Footer */
                /* Alt Card */
            }
            .card:first-child {
                background: #fafafa;
                height: 10px;
                border-radius: 5px 5px 0 0;
                margin: 0 10px;
                padding: 0;
            }
            .card .title {
                position: relative;
                z-index: 1;
                border-left: 5px solid #ed2553;
                margin: 0 0 35px;
                padding: 10px 0 10px 50px;
                color: #ed2553;
                font-size: 32px;
                font-weight: 600;
                text-transform: uppercase;
            }
            .card .input-container {
                position: relative;
                margin: 0 60px 50px;
            }
            .card .input-container input {
                outline: none;
                z-index: 1;
                position: relative;
                background: none;
                width: 100%;
                height: 60px;
                border: 0;
                color: #212121;
                font-size: 24px;
                font-weight: 400;
            }
            .card .input-container input:focus ~ label {
                color: #9d9d9d;
                -webkit-transform: translate(-12%, -50%) scale(0.75);
                transform: translate(-12%, -50%) scale(0.75);
            }
            .card .input-container input:focus ~ .bar:before, .card .input-container input:focus ~ .bar:after {
                width: 50%;
            }
            .card .input-container input:valid ~ label {
                color: #9d9d9d;
                -webkit-transform: translate(-12%, -50%) scale(0.75);
                transform: translate(-12%, -50%) scale(0.75);
            }
            .card .input-container label {
                position: absolute;
                top: 0;
                left: 0;
                color: #757575;
                font-size: 24px;
                font-weight: 300;
                line-height: 60px;
                -webkit-transition: 0.2s ease;
                transition: 0.2s ease;
            }
            .card .input-container .bar {
                position: absolute;
                left: 0;
                bottom: 0;
                background: #757575;
                width: 100%;
                height: 1px;
            }
            .card .input-container .bar:before, .card .input-container .bar:after {
                content: '';
                position: absolute;
                background: #ed2553;
                width: 0;
                height: 2px;
                -webkit-transition: .2s ease;
                transition: .2s ease;
            }
            .card .input-container .bar:before {
                left: 50%;
            }
            .card .input-container .bar:after {
                right: 50%;
            }
            .card .button-container {
                margin: 0 60px;
                text-align: center;
            }
            .card .button-container button {
                outline: 0;
                cursor: pointer;
                position: relative;
                display: inline-block;
                background: 0;
                width: 240px;
                border: 2px solid #e3e3e3;
                padding: 20px 0;
                font-size: 24px;
                font-weight: 600;
                line-height: 1;
                text-transform: uppercase;
                overflow: hidden;
                -webkit-transition: .3s ease;
                transition: .3s ease;
            }
            .card .button-container button span {
                position: relative;
                z-index: 1;
                color: #ddd;
                -webkit-transition: .3s ease;
                transition: .3s ease;
            }
            .card .button-container button:before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                display: block;
                background: #ed2553;
                width: 30px;
                height: 30px;
                border-radius: 100%;
                margin: -15px 0 0 -15px;
                opacity: 0;
                -webkit-transition: .3s ease;
                transition: .3s ease;
            }
            .card .button-container button:hover, .card .button-container button:active, .card .button-container button:focus {
                border-color: #ed2553;
            }
            .card .button-container button:hover span, .card .button-container button:active span, .card .button-container button:focus span {
                color: #ed2553;
            }
            .card .button-container button:active span, .card .button-container button:focus span {
                color: #ffffff;
            }
            .card .button-container button:active:before, .card .button-container button:focus:before {
                opacity: 1;
                -webkit-transform: scale(10);
                transform: scale(10);
            }
            .card .footer {
                margin: 40px 0 0;
                color: #d3d3d3;
                font-size: 24px;
                font-weight: 300;
                text-align: center;
            }
            .card .footer a {
                color: inherit;
                text-decoration: none;
                -webkit-transition: .3s ease;
                transition: .3s ease;
            }
            .card .footer a:hover {
                color: #bababa;
            }
            .card.alt {
                position: absolute;
                top: 40px;
                right: -70px;
                z-index: 10;
                width: 140px;
                height: 140px;
                background: none;
                border-radius: 100%;
                -webkit-box-shadow: none;
                box-shadow: none;
                padding: 0;
                -webkit-transition: .3s ease;
                transition: .3s ease;
                /* Toggle */
                /* Title */
                /* Input */
                /* Button */
            }
            .card.alt .toggle {
                position: relative;
                background: #ed2553;
                width: 140px;
                height: 140px;
                border-radius: 100%;
                -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                color: #ffffff;
                font-size: 58px;
                line-height: 140px;
                text-align: center;
                cursor: pointer;
            }
            .card.alt .toggle:before {
                content: '\f040';
                display: inline-block;
                font: normal normal normal 14px/1 FontAwesome;
                font-size: inherit;
                text-rendering: auto;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                -webkit-transform: translate(0, 0);
                transform: translate(0, 0);
            }
            .card.alt .title,
            .card.alt .input-container,
            .card.alt .button-container {
                left: 100px;
                opacity: 0;
                visibility: hidden;
            }
            .card.alt .title {
                position: relative;
                border-color: #ffffff;
                color: #ffffff;
            }
            .card.alt .title .close {
                cursor: pointer;
                position: absolute;
                top: 0;
                right: 60px;
                display: inline;
                color: #ffffff;
                font-size: 58px;
                font-weight: 400;
            }
            .card.alt .title .close:before {
                content: '\00d7';
            }
            .card.alt .input-container input {
                color: #ffffff;
            }
            .card.alt .input-container input:focus ~ label {
                color: #ffffff;
            }
            .card.alt .input-container input:focus ~ .bar:before, .card.alt .input-container input:focus ~ .bar:after {
                background: #ffffff;
            }
            .card.alt .input-container input:valid ~ label {
                color: #ffffff;
            }
            .card.alt .input-container label {
                color: rgba(255, 255, 255, 0.8);
            }
            .card.alt .input-container .bar {
                background: rgba(255, 255, 255, 0.8);
            }
            .card.alt .button-container button {
                width: 100%;
                background: #ffffff;
                border-color: #ffffff;
            }
            .card.alt .button-container button span {
                color: #ed2553;
            }
            .card.alt .button-container button:hover {
                background: rgba(255, 255, 255, 0.9);
            }
            .card.alt .button-container button:active:before, .card.alt .button-container button:focus:before {
                display: none;
            }

            /* Keyframes */
            @-webkit-keyframes buttonFadeInUp {
                0% {
                    bottom: 30px;
                    opacity: 0;
                }
            }
            @keyframes buttonFadeInUp {
                0% {
                    bottom: 30px;
                    opacity: 0;
                }
            }

            /* The version of Bourbon used in this Pen was 4.* */
            @import "bourbon";

            //Main Colors
            $accent: null;
            $white: #ffffff;
            $black: #000000;
            $dark-gray: lighten($black, 20%);
            $gray: lighten($black, 40%);
            $light-gray: lighten($black, 60%);
            $lighter-gray: lighten($black, 80%);

            // Pen Settings
            $primary: #363636;
            $accent: #ed2553;
            $max-width: 460px;

            // Mixins
            $level: 1;

            @mixin materialShadow($level) {
                @if $level == 1 {
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                }

                @else if $level == 2 {
                    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
                }

                @else if $level == 3 {
                    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
                }

                @else if $level == 4 {
                    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
                }

                @else if $level == 5 {
                    box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
                }
            }

            body {
                background: #e9e9e9;
                color: $gray;
                font-family: 'RobotoDraft', 'Roboto', sans-serif;
                font-size: 14px;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            /* Pen Title */
            .pen-title {
                padding: 50px 0;
                text-align: center;
                letter-spacing: 2px;

                h1 {
                    margin: 0 0 20px;
                    font-size: 48px;
                    font-weight: 300;
                }

                span {
                    font-size: 12px;

                    .fa {
                        color: $accent;
                    }

                    a {
                        color: $accent;
                        font-weight: 600;
                        text-decoration: none;
                    }
                }
            }

            /* Rerun */
            .rerun {
                margin: 0 0 30px;
                text-align: center;

                a {
                    cursor: pointer;
                    display: inline-block;
                    background: $accent;
                    border-radius: 3px;
                    @include materialShadow(1);
                    padding: 10px 20px;
                    color: $white;
                    text-decoration: none;
                    @include transition(0.3s ease);

                    &:hover {
                        @include materialShadow(2);
                    }
                }
            }

            /* Scroll To Bottom */
            #codepen {
                position: fixed;
                bottom: 30px;
                right: 30px;
                background: $primary;
                width: 56px;
                height: 56px;
                border-radius: 100%;
                @include materialShadow(1);
                @include transition(0.3s ease);
                color: $white;
                text-align: center;

                i {
                    line-height: 56px;
                }

                &:hover {
                    @include materialShadow(3);
                }
            }

            /* CodePen */
            #portfolio {
                @extend #codepen;
                bottom: 96px;
                right: 36px;
                background: $accent;
                width: 44px;
                height: 44px;
                @include animation(buttonFadeInUp 1s ease);

                i {
                    line-height: 44px;
                }
            }

            /* Container */
            .container {
                position: relative;
                max-width: $max-width;
                width: 100%;
                margin: 0 auto 100px;

                &.active {
                    .card {
                        &:first-child {
                            background: darken($white, 5%);
                            margin: 0 15px;
                        }

                        &:nth-child(2) {
                            background: darken($white, 2%);
                            margin: 0 10px;
                        }

                        &.alt {
                            top: 20px;
                            right: 0;
                            width: 100%;
                            min-width: 100%;
                            height: auto;
                            border-radius: 5px;
                            padding: 60px 0 40px;
                            overflow: hidden;

                            .toggle {
                                position: absolute;
                                top: 40px;
                                right: -70px;
                                box-shadow: none;
                                @include transform(scale(10));
                                transition: transform .3s ease;

                                &:before {
                                    content: '';
                                }
                            }

                            .title,
                            .input-container,
                            .button-container {
                                left: 0;
                                opacity: 1;
                                visibility: visible;
                                transition: .3s ease;
                            }

                            .title {
                                transition-delay: .3s;
                            }

                            .input-container {
                                transition-delay: .4s;

                                &:nth-child(2) {
                                    transition-delay: .5s;
                                }

                                &:nth-child(3) {
                                    transition-delay: .6s;
                                }
                            }

                            .button-container {
                                transition-delay: .7s;
                            }
                        }
                    }
                }
            }

            /* Card */
            .card {
                position: relative;
                background: $white;
                border-radius: 5px;
                padding: 60px 0 40px 0;
                box-sizing: border-box;
                @include materialShadow(1);
                transition: .3s ease;

                &:first-child {
                    background: darken($white, 2%);
                    height: 10px;
                    border-radius: 5px 5px 0 0;
                    margin: 0 10px;
                    padding: 0;
                }

                /* Title */
                .title {
                    position: relative;
                    z-index: 1;
                    border-left: 5px solid $accent;
                    margin: 0 0 35px;
                    padding: 10px 0 10px 50px;
                    color: $accent;
                    font-size: 32px;
                    font-weight: 600;
                    text-transform: uppercase;
                }

                /* Inputs */
                .input-container {
                    position: relative;
                    margin: 0 60px 50px;

                    input {
                        outline: none;
                        z-index: 1;
                        position: relative;
                        background: none;
                        width: 100%;
                        height: 60px;
                        border: 0;
                        color: #212121;
                        font-size: 24px;
                        font-weight: 400;

                        &:focus {
                            ~ label {
                                color: #9d9d9d;
                                transform: translate(-12%, -50%) scale(0.75);
                            }

                            ~ .bar {
                                &:before,
                                    &:after {
                                    width: 50%;
                                }
                            }
                        }

                        &:valid {
                            ~ label {
                                color: #9d9d9d;
                                transform: translate(-12%, -50%) scale(0.75);
                            }
                        }
                    }

                    label {
                        position: absolute;
                        top: 0;
                        left: 0;
                        color: #757575;
                        font-size: 24px;
                        font-weight: 300;
                        line-height: 60px;
                        @include transition(0.2s ease);
                    }

                    .bar {
                        position: absolute;
                        left: 0;
                        bottom: 0;
                        background: #757575;
                        width: 100%;
                        height: 1px;

                        &:before,
                            &:after {
                            content: '';
                            position: absolute;
                            background: $accent;
                            width: 0;
                            height: 2px;
                            transition: .2s ease;
                        }

                        &:before {
                            left: 50%;
                        }

                        &:after {
                            right: 50%;
                        }
                    }
                }

                /* Button */
                .button-container {
                    margin: 0 60px;
                    text-align: center;

                    button {
                        outline: 0;
                        cursor: pointer;
                        position: relative;
                        display: inline-block;
                        background: 0;
                        width: 240px;
                        border: 2px solid #e3e3e3;
                        padding: 20px 0;
                        font-size: 24px;
                        font-weight: 600;
                        line-height: 1;
                        text-transform: uppercase;
                        overflow: hidden;
                        transition: .3s ease;

                        span {
                            position: relative;
                            z-index: 1;
                            color: #ddd;
                            transition: .3s ease;
                        }

                        &:before {
                            content: '';
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            display: block;
                            background: $accent;
                            width: 30px;
                            height: 30px;
                            border-radius: 100%;
                            margin: -15px 0 0 -15px;
                            opacity: 0;
                            transition: .3s ease;
                        }

                        &:hover,
                            &:active,
                            &:focus {
                            border-color: $accent;

                            span {
                                color: $accent;
                            }
                        }

                        &:active,
                            &:focus {
                            span {
                                color: $white;
                            }

                            &:before {
                                opacity: 1;
                                @include transform(scale(10));
                            }
                        }
                    }
                }

                /* Footer */
                .footer {
                    margin: 40px 0 0;
                    color: #d3d3d3;
                    font-size: 24px;
                    font-weight: 300;
                    text-align: center;

                    a {
                        color: inherit;
                        text-decoration: none;
                        transition: .3s ease;

                        &:hover {
                            color: darken(#d3d3d3, 10%);
                        }
                    }
                }

                /* Alt Card */
                &.alt {
                    position: absolute;
                    top: 40px;
                    right: -70px;
                    z-index: 10;
                    width: 140px;
                    height: 140px;
                    background: none;
                    border-radius: 100%;
                    box-shadow: none;
                    padding: 0;
                    transition: .3s ease;

                    /* Toggle */
                    .toggle {
                        position: relative;
                        background: $accent;
                        width: 140px;
                        height: 140px;
                        border-radius: 100%;
                        @include materialShadow(1);
                        color: $white;
                        font-size: 58px;
                        line-height: 140px;
                        text-align: center;
                        cursor: pointer;

                        &:before {
                            content: '\f040';
                            display: inline-block;
                            font: normal normal normal 14px/1 FontAwesome;
                            font-size: inherit;
                            text-rendering: auto;
                            -webkit-font-smoothing: antialiased;
                            -moz-osx-font-smoothing: grayscale;
                            transform: translate(0, 0);
                        }
                    }

                    .title,
                    .input-container,
                    .button-container {
                        left: 100px;
                        opacity: 0;
                        visibility: hidden;
                    }

                    /* Title */
                    .title {
                        position: relative;
                        border-color: $white;
                        color: $white;

                        .close {
                            cursor: pointer;
                            position: absolute;
                            top: 0;
                            right: 60px;
                            display: inline;
                            color: $white;
                            font-size: 58px;
                            font-weight: 400;

                            &:before {
                                content: '\00d7';
                            }
                        }
                    }

                    /* Input */
                    .input-container {
                        input {
                            color: $white;

                            &:focus {
                                ~ label {
                                    color: $white;
                                }

                                ~ .bar {
                                    &:before,
                                        &:after {
                                        background: $white;
                                    }
                                }
                            }

                            &:valid {
                                ~ label {
                                    color: $white;
                                }
                            }
                        }

                        label {
                            color: rgba($white, 0.8);
                        }

                        .bar {
                            background: rgba($white, 0.8);
                        }
                    }

                    /* Button */
                    .button-container {
                        button {
                            width: 100%;
                            background: $white;
                            border-color: $white;

                            span {
                                color: $accent;
                            }

                            &:hover {
                                background: rgba($white, 0.9);
                            }

                            &:active,
                                &:focus {
                                &:before {
                                    display: none;
                                }
                            }
                        }
                    }
                }
            }

            /* Keyframes */
            @include keyframes(buttonFadeInUp) {
                0% {
                    bottom: 30px;
                    opacity: 0;
                }
            }
        </style>
        <script type="text/javascript">
            $('.toggle').on('click', function () {
                $('.container').stop().addClass('active');
            });

            $('.close').on('click', function () {
                $('.container').stop().removeClass('active');
            });
        </script>
