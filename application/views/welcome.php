<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo(isset($page_title) ? $page_title : 'Quiz App - Login'); ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() . 'assets/favicon.png'; ?>"/>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() . 'assets/favicon.png'; ?>"/>

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/libs/semantic-ui-2.3.3/semantic.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/welcome.css'; ?>">

    <script type="text/javascript" src="<?php echo base_url() . 'assets/libs/jquery-2.2.4.min.js'; ?>"></script>
    <script type="text/javascript"
            src="<?php echo base_url() . 'assets/libs/semantic-ui-2.3.3/semantic.min.js'; ?>"></script>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700" rel="stylesheet">

    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>
</head>
<body>

<div class="ui text container">
    <h1 style="font-size: 80px">Welcome</h1>

    <div class="fancy-form">
        <div class="questions-wrapper">
            <div id="q1" class="question">
                <h2>What's your <b>name</b> ? *</h2>
                <div class="ui massive transparent input border-bottom">
                    <input id="name" name="name" class="red" type="text" placeholder="Type your name here...">

                </div>
                <div class="label-wrapper">
                    <div class="ui pointing orange label">
                        <i class="checkmark icon"></i> OK
                    </div>
                    <span class="ui basic orange"></span>
                </div>
            </div>


            <div id="q2" class="question"><h2>What's your <b>email address</b> ? *</h2>
                <div class="ui massive transparent input border-bottom">
                    <input id="name" name="name" class="red" type="text" placeholder="Type your email here...">
                </div>
                <div class="label-wrapper">
                    <div class="ui pointing red label">
                        Invalid email
                    </div>
                    <span class="ui basic orange"></span>
                </div>
            </div>

            <div id="q3" class="question"><h2>Please select your <b>gender</b> (optional)</h2>
                <div class="ui massive buttons">
                    <button class="ui basic orange button"><i class="icon male"></i>Male</button>
                    <button class="ui basic orange button"><i class="icon female"></i>Female</button>
                </div>
            </div>

            <div id="q4" class="question"><h2>Please select your <b>age</b> *</h2>
                <div class="ui massive buttons">
                    <button class="ui basic active orange button">< 18</button>
                    <button class="ui basic orange button">18 - 29</button>
                    <button class="ui basic orange button">30 - 44</button>
                    <button class="ui basic orange button">45 - 64</button>
                    <button class="ui basic orange button">65+</button>
                </div>
            </div>
        </div>
    </div>


    <div style="padding: 5em 0 20em 0">
        <button class="ui orange very big button">Start Quiz<i class="chevron right icon"></i></button>
    </div>
</div>


<style type="text/css">
    .question.active {
        opacity: 1;
    }

    .question {
        opacity: 0.2;
        -webkit-transition: all 0.4s;
        -moz-transition: all 0.4s;
        -ms-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
    }
</style>

<script>
    // init controller
    var controller = new ScrollMagic.Controller();

    // build scenes
    new ScrollMagic.Scene({triggerElement: "#q1"})
        .setClassToggle("#q1", "active") // add class toggle
        //.addIndicators() // add indicators (requires plugin)
        .addTo(controller);
    new ScrollMagic.Scene({triggerElement: "#q2"})
        .setClassToggle("#q2", "active") // add class toggle
        //.addIndicators() // add indicators (requires plugin)
        .addTo(controller);
    new ScrollMagic.Scene({triggerElement: "#q3"})
        .setClassToggle("#q3", "active") // add class toggle
        //.addIndicators() // add indicators (requires plugin)
        .addTo(controller);
    new ScrollMagic.Scene({triggerElement: "#q4"})
        .setClassToggle("#q4", "active") // add class toggle
        //.addIndicators() // add indicators (requires plugin)
        .addTo(controller);


</script>
</body>
</html>