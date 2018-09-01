<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message error">
        <?php echo $message; ?>
    </div>
<?php } ?>

<div class="ui clearing segment">
    <?php echo form_open("scores/create_score", array('class' => 'ui form')); ?>

    <div class="required field">
        <label>Name</label>
        <?php echo form_input($name); ?>
    </div>

    <div class="field">
        <label>E-mail</label>
        <?php echo form_input($email); ?>
    </div>

    <div class="field">
        <label>Gender</label>
        <select name="gender" class="ui dropdown gender-chooser">
            <option value="female">Female</option>
            <option value="male">Male</option>
        </select>
    </div>

    <div class="field">
        <label>Date of Birth</label>
        <select name="dob" class="ui dropdown gender-chooser">
            <?php foreach ($dob_options as $opt) { ?>
                <option value="<?php echo htmlspecialchars($opt); ?>"><?php echo htmlspecialchars($opt); ?></option>
            <?php } ?>
        </select>
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

    <?php foreach (array(1,2,3,4,5) as $i) { ?>
        <div class="ui segment">
            <div class="field">
                <label>Question <?php echo $i ?></label>
                <select name="question<?php echo $i ?>_id" class="ui search dropdown question-chooser"
                        data-trigger="question<?php echo $i ?>_answer_id">
                    <?php foreach ($questions as $opt) { ?>
                        <option value="<?php echo $opt['id']; ?>"><?php echo $opt['question']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="field">
                <label>Answer <?php echo $i ?></label>
                <select id="question<?php echo $i ?>_answer_id"
                        name="question<?php echo $i ?>_answer_id" class="ui search dropdown answer-chooser">

                </select>
            </div>
        </div>
    <?php } ?>

    <div class="ui segment">
        <?php foreach (array(1,2,3,4,5) as $i) { ?>
            <div class="field">
                <label>Tag <?php echo $i ?></label>
                <select name="tag<?php echo $i ?>_id" class="ui search dropdown tag-chooser">
                    <?php foreach ($tags as $opt) { ?>
                        <option value="<?php echo $opt['id']; ?>"><?php echo $opt['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>
    </div>


    <div class="field">
        <?php echo form_submit('submit', 'Create score',
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
        onChange: load_answers,
        forceSelection: true,
        selectOnKeydown: false,
        fireOnInit: true
    });
</script>
