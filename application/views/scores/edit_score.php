<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message error">
        <?php echo $message; ?>
    </div>
<?php } ?>

<div class="ui clearing segment">
    <?php echo form_open(uri_string(), array('class' => 'ui form')); ?>

    <div class="required field">
        <label>Name</label>
        <?php echo form_input($name); ?>
    </div>

    <div class="required field">
        <label>E-mail</label>
        <?php echo form_input($email); ?>
    </div>

    <div class="field">
        <label>Gender</label>
        <?php echo form_dropdown($gender, array(
            'male' => 'Male',
            'female' =>'Female'
        ), $gender['value'], 'class="ui dropdown gender-chooser"'); ?>
    </div>

    <div class="required field">
        <label>Date of Birth</label>
        <?php $opts_filtered = array();
            foreach ($dob_options as $o) $opts_filtered[htmlspecialchars($o)] = htmlspecialchars($o);
            echo form_dropdown($dob, $opts_filtered, $dob['value'], 'class="ui dropdown gender-chooser"'); ?>
    </div>

    <div class="ui segment">
        <div class="four fields">
            <div class="field">
                <label>Score A</label>
                <?php echo form_input($score_a, '', 'placeholder="Score A"'); ?>
            </div>
            <div class="field">
                <label>Score I</label>
                <?php echo form_input($score_i, '', 'placeholder="Score I"'); ?>
            </div>
            <div class="field">
                <label>Score C</label>
                <?php echo form_input($score_c, '', 'placeholder="Score C"'); ?>
            </div>
            <div class="field">
                <label>Score P</label>
                <?php echo form_input($score_p, '', 'placeholder="Score P"'); ?>
            </div>
        </div>
    </div>

    <?php foreach ($question_selects as $i => $quest) { $ans = $question_ans_selects[$i] ?>
        <div class="ui segment">
            <div class="field">
                <label>Question <?php echo $i ?></label>
                <?php echo form_dropdown($quest['params'], $quest['options'], $quest['params']['value'],
                    'class="ui search dropdown question-chooser"'); ?>
            </div>
            <div class="field">
                <label>Answer <?php echo $i ?></label>
                <?php echo form_dropdown($ans['params'], $ans['options'], $ans['params']['value'],
                    'class="ui search dropdown answer-chooser"'); ?>
            </div>
        </div>
    <?php } ?>

    <div class="ui segment">
        <?php foreach ($tag_selects as $i => $t) { ?>
            <div class="field">
                <label>Tag <?php echo $i ?></label>
                <?php echo form_dropdown($t['params'], $t['options'], $t['params']['value'],
                    'class="ui search dropdown tag-chooser"'); ?>
            </div>
        <?php } ?>
    </div>


    <div class="field">
        <?php echo form_submit('submit', 'Save score',
            'class="ui right floated blue submit button"'); ?>
        <a class="ui right floated button" href="<?php echo base_url() . 'index.php/scores' ?>">Back</a>
    </div>

    <?php echo form_close(); ?>
</div>


<script>
    function load_answers(value, text, $selectedItem) {
        let answer_select = $('#' + $(this).attr('data-trigger'));
        $.get({
            url: "<?php echo base_url() . 'index.php/scores/question_answers/'; ?>" + value,
            success: function (res) {
                let options_html = '';
                if (res.status) {
                    for (let i in res.answers) {
                        let answer = res.answers[i];
                        if (answer) {
                            options_html += '<option value="' + answer.id + '">' + answer.answer + '</option>'
                        }
                    }
                    answer_select.html(options_html);
                }
            }
        })
    }

    $('.gender-chooser.ui.dropdown, .tag-chooser.ui.dropdown').dropdown({
        forceSelection: true,
        selectOnKeydown: false
    });
    $('.question-chooser.ui.dropdown').dropdown({
        onChange: function () {
            window.location.reload();
        },
        forceSelection: true,
        selectOnKeydown: false
    });
</script>
