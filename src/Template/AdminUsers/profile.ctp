<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<section class="content">
  <article class="home_page_top">
    <header>
      <h1>Something Big<br> is Under construction</h1>
      <h4></h4>
    </header>
    <div class="coming_soon">
      <div>
        <svg class="circle_2" height="300" width="300">
          <circle cx="150" cy="150" r="100" stroke-width="5" fill="transparent" stroke-dasharray="100" stroke-dashoffset="200" />
        </svg>
      </div>
      <div>
        <svg class="circle_3" height="300" width="300">
          <circle cx="150" cy="150" r="50" stroke-width="5" fill="transparent" stroke-dasharray="50" stroke-dashoffset="50" />
        </svg>
      </div>
      <div>
        <svg class="circle_1" height="300" width="300">
          <circle cx="150" cy="150" r="150" stroke-width="5" fill="transparent" stroke-dasharray="150" stroke-dashoffset="150" />
        </svg>
      </div>
    </div>
    <div class="data_time">
      <div>
        <span id="days"></span> days
        <span id="hours"></span> hours
        <span id="minutes"></span> minutes
        <span id="seconds"></span> seconds
      </div>
    </div>
    </div>
  </article>
  <article class="home_page_bot">
    <div class="contact_us">
     
    </div>
  </article>
  <footer>
    </footer>
</section>

<style>
    body {
  background: #000;
  color: #FF6600;
  padding: 5px;
  font-family: 'Gruppo', cursive;
}

.home_page_top {
  background: #000;
  color: #FF6600;
  border-top: 5px solid #FF6600;
  border-bottom: 5px solid #FF6600;
  padding: 5px;
  position: relative;
  margin-bottom: 10px;
}

.home_page_top:before {
  content: '';
  position: absolute;
  bottom: -12px;
  border-radius: 100%;
  left: 0;
  right: 0;
  margin: auto;
  height: 20px;
  width: 40%;
  background-color: #FF6600;
}

.home_page_top:after {
  content: '';
  position: absolute;
  top: -12px;
  border-radius: 100%;
  left: 0;
  right: 0;
  margin: auto;
  height: 20px;
  width: 40%;
  background-color: #FF6600;
}

.content {
  width: 1024px;
  margin: auto;
  text-align: center;
}

.logo_site {
  left: 5%;
  top: 200px;
  width: 200px;
  height: auto;
  position: absolute;
}

.affiche_don {
  right: 5%;
  top: 153px;
  position: absolute;
  width: 200px;
  height: 300px;
}

.link_affiche_don {
  top: 420px;
  right: 8%;
  position: absolute;
  color: #FF6600;
}

.link_affiche_don:hover {
  color: #ffbe00;
}

h4 {
  margin-top: -20px;
  color: #fff;
}

h1 {
  font-size: 28px;
}

svg {
  margin: 50px;
}

.coming_soon {
  height: 300px;
  margin: 50px;
}

.coming_soon div {
  position: absolute;
  top: calc(50% - 175px);
  left: calc(50% - 200px);
}

.circle_1 {
  -webkit-animation: spin_1 4s infinite alternate;
  -moz-animation: spin_1 4s infinite alternate;
  animation: spin_1 4s infinite alternate;
}

.circle_2 {
  -webkit-animation: spin_2 4s infinite alternate;
  animation: spin_2 4s infinite alternate;
  -moz-animation: spin_2 4s infinite alternate;
}

.circle_3 {
  -webkit-animation: spin_3 4s infinite alternate;
  animation: spin_3 4s infinite alternate;
  -moz-animation: spin_3 4s infinite alternate;
}

@keyframes spin_1 {
  0% {
    stroke: #ffbe00;
  }
  50% {
    stroke: #FF6600;
  }
  100% {
    stroke: #ffbe00;
    -webkit-transform: rotate(-240deg);
    transform: rotate(-240deg);
  }
}

@-webkit-keyframes spin_1 {
  0% {
    stroke: #ffbe00;
  }
  50% {
    stroke: #FF6600;
  }
  100% {
    stroke: #ffbe00;
    -webkit-transform: rotate(-240deg);
    transform: rotate(-240deg);
  }
}

@keyframes spin_2 {
  0% {
    stroke: #fff;
  }
  50% {
    stroke: #ffbe00;
  }
  100% {
    stroke: #fff;
    -webkit-transform: rotate(240deg);
    transform: rotate(240deg);
  }
}

@-webkit-keyframes spin_2 {
  0% {
    stroke: #fff;
  }
  50% {
    stroke: #ffbe00;
  }
  100% {
    stroke: #fff;
    -webkit-transform: rotate(240deg);
    transform: rotate(240deg);
  }
}

@keyframes spin_3 {
  0% {
    stroke: #FF6600;
  }
  50% {
    stroke: #fff;
  }
  100% {
    stroke: #FF6600;
    -webkit-transform: rotate(-180deg);
    transform: rotate(-180deg);
  }
}

@-webkit-keyframes spin_3 {
  0% {
    stroke: #FF6600;
  }
  50% {
    stroke: #fff;
  }
  100% {
    stroke: #FF6600;
    -webkit-transform: rotate(-180deg);
    transform: rotate(-180deg);
  }
}

.data_time {
  margin-bottom: 10px;
}

.data_time span {
  color: #fff;
}

.btn_sent {
  cursor: pointer;
  color: #fff;
  background: #FF6600;
  border: 1px solid #fff;
  border-radius: 10%;
}

label {
  font-size: 20px;
}

.btn_sent:hover {
  color: #FF6600;
  background: #fff;
  border: 1px solid #FF6600;
}

.facebook,
.twitter {
  float: right;
  width: 100px;
  height: 100px;
  margin: 10px;
}

.facebook:hover,
.twitter:hover {
  opacity: 0.9;
}

.fonction {
  background: #000;
  color: #FF6600;
  padding: 5px;
  font-family: 'Gruppo', cursive;
  text-align: center;
}

.fonction a:hover {
  color: #FF6600;
}

.fonction a {
  color: #ffbe00;
}

.fonction div {
  background: #fff;
  margin: auto;
  font-size: 20px;
  padding: 20px;
  width: 150px;
}

footer {
  margin-top: 10px;
  font-size: 12px;
}

@media all and (max-width: 800px) {
  body {
    font-size: 200%;
  }
  .btn_sent {
    font-size: 90%;
  }
  footer {
    font-size: 60%;
  }
  .logo_site {
    display: none;
  }
  .affiche_don {
    display: none;
  }
  .link_affiche_don {
    display: none;
  }
}

@media all and (min-width: 1200px) {
  .affiche_don {
    right: 15%;
  }
  .logo_site {
    left: 15%;
  }
  .link_affiche_don {
    right: 17%;
  }
}
</style>

<script> 
$(document).ready(function() {

  var target_date = new Date("Jan 31, 2018").getTime();

  var days, hours, minutes, seconds;

  var $days = $("#days"),
    $hours = $("#hours"),
    $minutes = $("#minutes"),
    $seconds = $("#seconds");

  setInterval(function() {

    var current_date = new Date().getTime();
    var seconds_left = (target_date - current_date) / 1000;

    days = parseInt(seconds_left / 86400);
    seconds_left = seconds_left % 86400;

    hours = parseInt(seconds_left / 3600);
    seconds_left = seconds_left % 3600;

    minutes = parseInt(seconds_left / 60);
    seconds = parseInt(seconds_left % 60);

    $days.text(days);
    $hours.text(hours);
    $minutes.text(minutes);
    $seconds.text(seconds);

  }, 1000);
});
</script>