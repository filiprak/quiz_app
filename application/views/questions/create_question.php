<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message error">
        <?php echo $message; ?>
    </div>
<?php } ?>

<div class="ui clearing segment">
    <?php echo form_open("questions/create_question", array('class' => 'ui form'));?>

    <div class="required field">
        <label>Question Text</label>
        <?php echo form_textarea($question);?>
    </div>
    <div class="required field">
        <label>Group</label>
        <?php echo form_input($group_id);?>
    </div>

    <h4 class="ui dividing header">Answers</h4>

    <div class="ui segment">
        <div class="field">
            <label>Answer 1</label>
            <?php echo form_input($answer1);?>
        </div>
        <div class="five fields">
            <div class="field"><?php echo form_input($answer1_score_a, '', 'placeholder="Score A"');?></div>
            <div class="field"><?php echo form_input($answer1_score_i, '', 'placeholder="Score I"');?></div>
            <div class="field"><?php echo form_input($answer1_score_c, '', 'placeholder="Score C"');?></div>
            <div class="field"><?php echo form_input($answer1_score_p, '', 'placeholder="Score P"');?></div>
            <div class="twelve wide field"><?php echo form_input($answer1_next_group, '', 'placeholder="Next Question Group"');?></div>
        </div>
    </div>
    <div class="ui segment">
        <div class="field">
            <label>Answer 2</label>
            <?php echo form_input($answer2);?>
        </div>
        <div class="five fields">
            <div class="field"><?php echo form_input($answer2_score_a, '', 'placeholder="Score A"');?></div>
            <div class="field"><?php echo form_input($answer2_score_i, '', 'placeholder="Score I"');?></div>
            <div class="field"><?php echo form_input($answer2_score_c, '', 'placeholder="Score C"');?></div>
            <div class="field"><?php echo form_input($answer2_score_p, '', 'placeholder="Score P"');?></div>
            <div class="twelve wide field"><?php echo form_input($answer2_next_group, '', 'placeholder="Next Question Group"');?></div>
        </div>
    </div>
    <div class="ui segment">
        <div class="field">
            <label>Answer 3</label>
            <?php echo form_input($answer3);?>
        </div>
        <div class="five fields">
            <div class="field"><?php echo form_input($answer3_score_a, '', 'placeholder="Score A"');?></div>
            <div class="field"><?php echo form_input($answer3_score_i, '', 'placeholder="Score I"');?></div>
            <div class="field"><?php echo form_input($answer3_score_c, '', 'placeholder="Score C"');?></div>
            <div class="field"><?php echo form_input($answer3_score_p, '', 'placeholder="Score P"');?></div>
            <div class="twelve wide field"><?php echo form_input($answer3_next_group, '', 'placeholder="Next Question Group"');?></div>
        </div>
    </div>
    <div class="ui segment">
        <div class="field">
            <label>Answer 4</label>
            <?php echo form_input($answer4);?>
        </div>
        <div class="five fields">
            <div class="field"><?php echo form_input($answer4_score_a, '', 'placeholder="Score A"');?></div>
            <div class="field"><?php echo form_input($answer4_score_i, '', 'placeholder="Score I"');?></div>
            <div class="field"><?php echo form_input($answer4_score_c, '', 'placeholder="Score C"');?></div>
            <div class="field"><?php echo form_input($answer4_score_p, '', 'placeholder="Score P"');?></div>
            <div class="twelve wide field"><?php echo form_input($answer4_next_group, '', 'placeholder="Next Question Group"');?></div>
        </div>
    </div>

    <div class="field">
        <?php echo form_submit('submit', 'Create question',
            'class="ui right floated blue submit button"');?>
        <a class="ui right floated button" href="<?php echo base_url() . 'index.php/questions' ?>">Back</a>
    </div>

    <?php echo form_close();?>
</div>
