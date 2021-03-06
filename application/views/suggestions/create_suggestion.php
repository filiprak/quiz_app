<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message error">
        <?php echo $message; ?>
    </div>
<?php } ?>

<?php if (!empty($upload_message)) { ?>
    <div class="ui message error upload-errors">
        <?php echo $upload_message; ?>
    </div>
<?php } ?>

<div class="ui clearing segment">
    <?php echo form_open_multipart("suggestions/create_suggestion", array('class' => 'ui form'));?>

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
        <label>Image</label>
        <?php echo form_input($image, '', 'class=""');?>
    </div>

    <div class="ui mini icon message info">
        <i class="exclamation icon"></i>
        <div class="content">
            Max allowed image size: <?php echo byte_format($upload_max_bytes) . ', resolution:  ' . $upload_max_width . 'x' . $upload_max_height; ?>)
        </div>
    </div>

    <div class="field">
        <?php echo form_submit('submit', 'Create suggestion',
            'class="ui right floated blue submit button"');?>
        <a class="ui right floated button" href="<?php echo base_url() . 'index.php/suggestions' ?>">Back</a>
    </div>

    <?php echo form_close();?>
</div>
