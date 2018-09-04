<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo(isset($page_title) ? $page_title : 'Quiz App'); ?></title>
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

    <form id="register" action="" method="POST">
        <?php if (!empty($message)) { ?>
            <div class="ui message error">
                <?php echo $message; ?>
            </div>
        <?php } ?>
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
                    <h2>What's your <b>email address</b> ? </h2>
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
                    <h2>Please select your <b>gender</b></h2>
                    <div class="input-with-prompt">
                        <div class="ui big labels radio">
                            <input type="hidden" name="gender" value="">
                            <a class="ui basic label togglable" data-value="male"><i class="icon male"></i>Male</a>
                            <a class="ui basic label togglable" data-value="female"><i
                                        class="icon female"></i>Female</a>
                        </div>
<!--                        <div style="display: block" class="input-prompt">-->
<!--                            <div class="ui orange small button" onclick="scrollToQuestion(4)">SKIP<i-->
<!--                                        class="chevron right icon"></i></div>-->
<!--                        </div>-->
                    </div>
                </div>

                <div id="q4" class="question"><h2>Please select your <b>age</b></h2>
                    <div class="input-with-prompt">
                        <div class="ui big labels radio">
                            <input type="hidden" name="dob" value="">
                            <a class="ui basic label togglable" data-value="under 18">< 18</a>
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
    window.mobilecheck = function() {
        var check = false;
        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    };

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
        else if (email && !validateEmail(email)) {
            $('#q2 .input-prompt').html('<div class="ui red tiny pointing label" onclick="scrollToQuestion(3)">' +
                'Invalid email</div>').transition('show');
            scrollToQuestion(2);
            $('#q2 input').focus();
            e.preventDefault();
        }

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


    var duration = 185;
    if (window.mobilecheck())
        duration = Math.ceil($(window).height() * 0.8);

    // init controller
    var controller = new ScrollMagic.Controller({globalSceneOptions: {duration: duration}});

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