<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message error">
        <?php echo $message; ?>
    </div>
<?php } ?>

<div class="ui clearing segment">
    <?php echo form_open_multipart(uri_string(), array('class' => 'ui form'));?>

    <div class="required field">
        <label>Name</label>
        <?php echo form_input($name);?>
    </div>

    <div class="required field">
        <label>Description</label>
        <?php echo form_textarea($description);?>
    </div>

    <div class="ui segment">
        <div class="four fields">
            <div class="field">
                <label>Score A</label>
                <?php echo form_input($score_a, '', 'placeholder="Score A"');?>
            </div>
            <div class="field">
                <label>Score I</label>
                <?php echo form_input($score_i, '', 'placeholder="Score I"');?>
            </div>
            <div class="field">
                <label>Score C</label>
                <?php echo form_input($score_c, '', 'placeholder="Score C"');?>
            </div>
            <div class="field">
                <label>Score P</label>
                <?php echo form_input($score_p, '', 'placeholder="Score P"');?>
            </div>
        </div>
    </div>

    <div class="field">
        <?php echo form_submit('submit', 'Save tag',
            'class="ui right floated blue submit button"');?>
        <a class="ui right floated button" href="<?php echo base_url() . 'index.php/tags' ?>">Back</a>
    </div>

    <?php echo form_close();?>

<!--    modal-->
    <div class="ui mini basic modal">
        <div class="ui red icon header">
            <i class="exclamation triangle icon"></i>
            <p>Unable to delete image</p>
            <p>Something went wrong... Please try later</p>
        </div>
        <div class="actions">
            <div class="ui ok inverted button">
                OK
            </div>
        </div>
    </div>
</div>
