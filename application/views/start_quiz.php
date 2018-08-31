<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo(isset($page_title) ? $page_title : 'Quiz App - Start'); ?></title>
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

</head>
<body>

<div class="ui text container">
    <h1 style="font-size: 80px">Let's start</h1>

        <?php if (!empty($message)) { ?>
            <div class="ui message error">
                <?php echo $message; ?>
            </div>
        <?php } ?>
        <div style="margin-bottom: 60%" class="fancy-form">
            <div class="questions-wrapper">
                <div id="q1" class="main question prompted active">
                    <h3 class="num">1<i class="arrow right icon"></i></h3>
                    <h2><?php echo $question1['question']; ?></h2>
                    <div class="input-with-prompt">
                        <div class="ui big labels radio fluid">
                            <input type="hidden" name="question1" value="">
                            <?php foreach ($question1_answers as $answer) { ?>
                                <a class="ui basic label togglable" data-value="<?php echo $answer['id'] ?>"><?php echo $answer['answer'] ?></a>
                            <?php } ?>
                        </div>
                        <div style="display: block" class="input-prompt">

                        </div>
                    </div>
                </div>
            </div>
<!--            append next questions here-->
        </div>

</div>


<script>
    function scrollToQuestion(nr) {
        $('body, html').animate({scrollTop: $('#q' + nr).offset().top - $('#q1').offset().top}, 400);
        //controller.scrollTo($('#q' + nr).offset().top - $('#q1').offset().top);
    }

    function registerTogglable(selector, onclick) {
        $(selector + ' .labels.radio .ui.label.togglable').state().click(function (e) {
            $(this).parent().find('.ui.label.togglable').state('deactivate');
            $(this).state('activate');
            $(this).parent().find('input[type=hidden]').val($(this).attr('data-value'));
            if ($.isFunction(onclick)) onclick(e, $(this).attr('data-value'));
        });

        $(selector + ' .labels.multi-5 .ui.label.togglable').state().click(function (e) {
            if ($(this).parent().find('.ui.label.togglable.active').length > 5) {
                $(this).state('deactivate');
            } else {
                let vals = [];
                $(this).parent().find('.ui.label.togglable.active').each(function (i, element) {
                    vals.push($(element).attr('data-value'));
                });
                console.log(vals);
                $(this).parent().find('input[type=hidden]').val(vals.join(','));
            }
        });
    }

    function bindInputPrompt(selector, anim_type, delay, make_content) {
        var timeout = null;
        $(selector + ' .label.togglable').on('click', function () {
            let self = $(selector);
            let input = $(selector).find('input');
            let prompt = $(selector).find('.input-prompt');

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

    registerTogglable('#q1', function (e, val) {
        setTimeout(function () {
            postAnswer(1, val);
        }, 500);
    });
    bindInputPrompt('#q1', 'drop', 100, function (q1, value) {
        return (value) ? '<div class="ui orange small label label-spinner"><i class="loading spinner icon"></i>Loading...</div>' : false;
    });

    function postAnswer(quest_nr, answer_id) {
        let next_q_nr = quest_nr + 1;
        // lock current question
        $.get({
            url: "<?php echo base_url() . 'index.php/welcome/post_answer/' ?>" + quest_nr + '?answer_id=' + answer_id,
            success: function (res) {
                console.log(res);

                if (res.status) {
                    // lock current question
                    $('#q' + quest_nr).removeClass('active').find('.label-spinner').remove();
                    $('#q' + quest_nr + ' .label.togglable').off('click');

                    if (next_q_nr < 6) {
                        let answershtml = '';
                        for (let key in res.data.answers) {
                            let ans = res.data.answers[key];
                            if (ans) {
                                answershtml += '<a class="ui basic label togglable" data-value="' + ans.id + '">' +  ans.answer + '</a>';
                            }
                        }

                        let elem = $('<div class="questions-wrapper">'+
                            '<div id="q' + next_q_nr + '" class="main question prompted active">'+
                            '<h3 class="num">' + next_q_nr + '<i class="arrow right icon"></i></h3>' +
                            '<h2>' + res.data.question + '</h2>'+
                            '<div class="input-with-prompt">'+
                            '<div class="ui big labels radio fluid">'+
                            '<input type="hidden" name="question' + next_q_nr + '" value="">'+
                            answershtml +
                            '</div>'+
                            '<div style="display: block" class="input-prompt">' +
                            '</div>'+
                            '</div>'+
                            '</div>' +
                            '</div>').appendTo('.fancy-form');
                        bindInputPrompt('#q' + next_q_nr, 'drop', 100, function (q, value) {
                            return (value) ? '<div class="ui orange small label label-spinner"><i class="loading spinner icon"></i>Loading...</div>' : false;
                        });
                        registerTogglable('#q' + next_q_nr, function (e, val) {
                            setTimeout(function () {
                                postAnswer(next_q_nr, val);
                            }, 500);
                        });
                    } else if (next_q_nr >= 6) {

                        let tagshtml = '';
                        for (let key in res.data) {
                            let tag = res.data[key];
                            if (tag) {
                                tagshtml += '<a class="ui basic label togglable" data-value="' + tag.id + '">' +  tag.name + '</a>';
                            }
                        }

                        let elem = $('<form action="<?php echo base_url() . 'index.php/welcome/post_tags' ?>" method="POST"><div class="questions-wrapper">'+
                            '<div id="q' + next_q_nr + '" class="main question prompted active">'+
                            '<h3 class="num">' + next_q_nr + '<i class="arrow right icon"></i></h3>' +
                            '<h2>Please select 5 tags from list below: </h2>'+
                            '<div class="input-with-prompt">'+
                            '<div class="ui big labels multi-5">'+
                            '<input type="hidden" name="tags" value="">'+
                            tagshtml +
                            '</div>'+
                            '<div style="display: block" class="input-prompt">' +
                            '</div>'+
                            '</div>'+
                            '</div>' +
                            '</div></form>').appendTo('.fancy-form');
                        registerTogglable('#q' + next_q_nr);

                        bindInputPrompt('#q' + next_q_nr, 'drop', 100, function (q, value) {
                            let splt = String(value).split(',');
                            return (splt.length == 5) ? '<button type="submit" class="ui orange small button" onclick=""><i class="checkmark icon"></i>OK, finish</button>' : false;
                        });
                    }

                    $('body, html').animate({scrollTop: $('#q' + next_q_nr).offset().top - $('#q1').offset().top}, 400);

                } else {
                    console.error(res);
                }

            }
        })
    }

</script>
</body>
</html>