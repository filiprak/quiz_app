<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message error">
        <?php echo $message; ?>
    </div>
<?php } ?>

<div class="ui clearing segment">
    <?php echo form_open("users/create_user", array('class' => 'ui form'));?>

    <h4 class="ui dividing header">User Information</h4>

    <div class="required field">
        <label>Name</label>
        <div class="two fields">
            <div class="field">
                <?php echo form_input($first_name, '', 'placeholder="First Name"');?>
            </div>
            <div class="field">
                <?php echo form_input($last_name, '', 'placeholder="Last Name"');?>
            </div>
        </div>
    </div>

    <?php
    if($identity_column!=='email') {
        echo '<div class="field">';
        echo lang('create_user_identity_label', 'identity');
        echo form_error('identity');
        echo form_input($identity);
        echo '</div>';
    }
    ?>
    <div class="required field">
        <?php echo lang('create_user_email_label', 'email');?>
        <?php echo form_input($email);?>
    </div>
    <div class="field">
        <?php echo lang('create_user_company_label', 'company');?>
        <?php echo form_input($company);?>
    </div>
    <div class="field">
        <?php echo lang('create_user_phone_label', 'phone');?>
        <?php echo form_input($phone);?>
    </div>
    <div class="required field">
        <?php echo lang('create_user_password_label', 'password');?>
        <?php echo form_input($password);?>
    </div>
    <div class="required field">
        <?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
        <?php echo form_input($password_confirm);?>
    </div>

    <div class="field">
        <?php echo form_submit('submit', lang('create_user_submit_btn'),
            'class="ui right floated blue submit button"');?>
        <a class="ui right floated button" href="<?php echo base_url() . 'index.php/users' ?>">Back</a>
    </div>

    <?php echo form_close();?>
</div>
