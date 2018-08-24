<?php include 'application/views/partial/header.php'; ?>

<body class="login-body">
<div class="ui middle aligned center aligned grid login">
    <div style="max-width: 450px"  class="column">
        <h2 class="ui teal header">
            <div class="content"><?php echo lang('reset_password_heading');?></div>
        </h2>
        <div class="ui message">
            <?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?>
        </div>
        <div style="display: <?php echo empty($message) ? 'none' : 'block'; ?>" class="ui error message">
            <ul class="list">
                <?php echo $message;?>
            </ul>
        </div>
        <form class="ui large form" action="<?php echo 'reset_password/' . $code; ?>" method="POST">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <?php echo form_input($new_password, '', 'placeholder=Password');?>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <?php echo form_input($new_password_confirm, '', 'placeholder="Confirm Password"');?>
                    </div>
                </div>
                <input type="submit" class="ui fluid large teal submit button" value="<?php echo lang('reset_password_submit_btn'); ?>">
            </div>

            <?php echo form_input($user_id);?>
            <?php echo form_hidden($csrf); ?>

        </form>
    </div>
</div>
</body>

