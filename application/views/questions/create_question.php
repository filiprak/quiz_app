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

    <div class="field">
        <?php echo form_submit('submit', 'Create question',
            'class="ui right floated blue submit button"');?>
        <a class="ui right floated button" href="<?php echo base_url() . 'index.php/questions' ?>">Back</a>
    </div>

    <?php echo form_close();?>
</div>
