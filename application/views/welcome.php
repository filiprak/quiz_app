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
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/utils.js'; ?>"></script>
    <script type="text/javascript"
            src="<?php echo base_url() . 'assets/libs/semantic-ui-2.3.3/semantic.min.js'; ?>"></script>
    <script type="text/javascript"
            src="<?php echo base_url() . 'assets/libs/semantic-ui-2.3.3/components/state.min.js'; ?>"></script>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700" rel="stylesheet">

    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>
</head>
<body>

<div class="ui text container">
    <h1 style="font-size: 80px">Welcome</h1>

    <form id="register" action="index.php" method="POST">
        <div class="fancy-form">
            <div class="questions-wrapper">
                <div id="q1" class="question prompted">
                    <h2>What's your <b>name</b> ? *</h2>
                    <div class="input-with-prompt">
                        <div class="ui massive transparent input border-bottom">
                            <input id="name" name="name" class="red" type="text" placeholder="Type your name here..."
                                   autocomplete="off">
                        </div>
                        <div class="input-prompt">

                        </div>
                    </div>
                </div>


                <div id="q2" class="question">
                    <h2>What's your <b>email address</b> ? *</h2>
                    <div class="input-with-prompt">
                        <div class="ui massive transparent input border-bottom">
                            <input id="email" name="email" class="red" type="text" placeholder="Type your email here..."
                                   autocomplete="off">
                        </div>
                        <div class="input-prompt">

                        </div>
                    </div>
                </div>

                <div id="q3" class="question">
                    <h2>Please select your <b>gender</b> (optional)</h2>
                    <div class="input-with-prompt">
                        <div class="ui big labels radio">
                            <input type="hidden" name="gender" value="">
                            <a class="ui basic label togglable" data-value="male"><i class="icon male"></i>Male</a>
                            <a class="ui basic label togglable" data-value="female"><i
                                        class="icon female"></i>Female</a>
                        </div>
                        <div style="display: block" class="input-prompt">
                            <div class="ui orange small button" onclick="scrollToQuestion(4)">SKIP<i
                                        class="chevron right icon"></i></div>
                        </div>
                    </div>
                </div>

                <div id="q4" class="question"><h2>Please select your <b>age</b> *</h2>
                    <div class="input-with-prompt">
                        <div class="ui big labels radio">
                            <input type="hidden" name="dob" value="">
                            <a class="ui basic label togglable" data-value="< 18">< 18</a>
                            <a class="ui basic label togglable" data-value="18-29">18 - 29</a>
                            <a class="ui basic label togglable" data-value="30-44">30 - 44</a>
                            <a class="ui basic label togglable" data-value="45-64">45 - 64</a>
                            <a class="ui basic label togglable" data-value="65+">65+</a>
                        </div>
                        <div style="display: block" class="input-prompt">

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div style="padding: 15em 0 15em 0">
            <button type="submit" class="ui orange very big button">Start Quiz<i class="chevron right icon"></i>
            </button>
        </div>
    </form>

</div>


<script>
    function scrollToQuestion(nr) {
        $('body, html').animate({scrollTop: $('#q' + nr).offset().top - $('#q1').offset().top}, 400);
        //controller.scrollTo($('#q' + nr).offset().top - $('#q1').offset().top);
    }

    $('.labels.radio .ui.label.togglable').state().click(function (e) {
        $(this).parent().find('.ui.label.togglable').state('deactivate');
        $(this).state('activate');
        $(this).parent().find('input[type=hidden]').val($(this).attr('data-value'));
        console.log($(this).attr('data-value'))
    });

    $('#register').submit(function (e) {

        // validate form
        const name = $('input[name="name"]').val();
        const email = $('input[name="email"]').val();
        const gender = $('input[name="gender"]').val();
        const dob = $('input[name="dob"]').val();

        if (!name) {
            $('#q1 .input-prompt').html('<div class="ui red tiny pointing label" onclick="scrollToQuestion(3)">' +
                'Required field</div>').transition('show');
            scrollToQuestion(1);
            $('#q1 input').focus();
            e.preventDefault();
        }
        else if (!validateEmail(email)) {
            $('#q2 .input-prompt').html('<div class="ui red tiny pointing label" onclick="scrollToQuestion(3)">' +
                'Invalid email</div>').transition('show');
            scrollToQuestion(2);
            $('#q2 input').focus();
            e.preventDefault();
        }
        else if (!dob) {
            $('#q4 .input-prompt').html('<div class="ui red tiny pointing label" onclick="scrollToQuestion(3)">' +
                'Required field</div>').transition('show');
            scrollToQuestion(4);
            e.preventDefault();
        }

        console.log([name, email, gender, dob])

    });

    function bindInputPrompt(selector, anim_type, delay, make_content) {
        var timeout = null;
        $(selector).on('input', function () {
            let self = $(this);
            let input = $(this).find('input');
            let prompt = $(this).find('.input-prompt');

            if (timeout) clearTimeout(timeout);
            timeout = setTimeout(function () {
                let content = make_content(self, input.val());
                prompt.html(content);
                if (content) {
                    if (!prompt.transition('is visible')) prompt.transition(anim_type);
                } else {
                    if (prompt.transition('is visible')) prompt.transition(anim_type);
                }
                timeout = null;
            }, delay);

        });
    }

    bindInputPrompt('#q1', 'drop', 100, function (q1, value) {
        return (value) ? '<div class="ui orange small button" onclick="scrollToQuestion(2)"><i class="checkmark icon"></i>OK</div>' : false;
    });

    bindInputPrompt('#q2', 'drop', 100, function (q2, value) {
        return (value) ? '<div class="ui orange small button" onclick="scrollToQuestion(3)"><i class="checkmark icon"></i>OK</div>' : false;
    });


    // init controller
    var controller = new ScrollMagic.Controller({globalSceneOptions: {duration: 185}});

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