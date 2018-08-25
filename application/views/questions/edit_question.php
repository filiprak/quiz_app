<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message error">
        <?php echo $message; ?>
    </div>
<?php } ?>


<div class="ui clearing segment">
    <?php echo form_open(uri_string(), array('class' => 'ui form')); ?>

    <h4 class="ui dividing header">Edit User Information</h4>

    <div class="required field">
        <label>Name</label>
        <div class="two fields">
            <div class="field">
                <?php echo form_input($first_name, '', 'placeholder="First Name"'); ?>
            </div>
            <div class="field">
                <?php echo form_input($last_name, '', 'placeholder="Last Name"'); ?>
            </div>
        </div>
    </div>

    <div class="field">
        <?php echo lang('create_user_company_label', 'company'); ?>
        <?php echo form_input($company); ?>
    </div>
    <div class="field">
        <?php echo lang('create_user_phone_label', 'phone'); ?>
        <?php echo form_input($phone); ?>
    </div>
    <div class="field">
        <?php echo lang('create_user_password_label', 'password'); ?>
        <?php echo form_input($password); ?>
    </div>
    <div class="field">
        <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?>
        <?php echo form_input($password_confirm); ?>
    </div>

    <?php if ($this->ion_auth->is_admin()): ?>

    <h4 class="ui dividing header"><?php echo lang('edit_user_groups_heading'); ?></h4>
    <div class="grouped fields">
        <?php foreach ($groups as $group): ?>
        <div class="field">
            <div class="ui checkbox <?php echo $user->id == 1 ? 'disabled' : ''; ?>">
                <?php
                $gID = $group['id'];
                $checked = null;
                $item = null;
                foreach ($currentGroups as $grp) {
                    if ($gID == $grp->id) {
                        $checked = ' checked="checked"';
                        break;
                    }
                }
                ?>
                <input <?php echo $user->id == 1 ? 'disabled' : ''; ?> type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                <label><?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?></label>
            </div>
        </div>
        <?php endforeach ?>
    </div>

    <?php endif ?>

    <?php echo form_hidden('id', $user->id); ?>
    <?php echo form_hidden($csrf); ?>

    <div class="field">
        <?php echo form_submit('submit', lang('edit_user_submit_btn'),
            'class="ui right floated blue submit button"'); ?>
        <a class="ui right floated button" href="<?php echo base_url() . 'index.php/users' ?>">Back</a>
    </div>

    <?php echo form_close(); ?>
</div>
