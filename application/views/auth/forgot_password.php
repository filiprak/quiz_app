<?php include 'application/views/partial/header.php'; ?>

<body class="login-body">
<div class="ui middle aligned center aligned grid login">
    <div style="max-width: 450px"  class="column">
        <h2 class="ui orange header">
            <div class="content"><?php echo lang('forgot_password_heading');?></div>
        </h2>
        <div class="ui message">
            <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
        </div>
        <div style="display: <?php echo empty($message) ? 'none' : 'block'; ?>" class="ui error message">
            <ul class="list">
                <?php echo $message;?>
            </ul>
        </div>
        <form class="ui large form" action="forgot_password" method="POST">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <?php echo form_input($identity, '', 'placeholder=Email');?>
                    </div>
                </div>
                <input type="submit" class="ui fluid large orange submit button" value="<?php echo lang('forgot_password_submit_btn'); ?>">
            </div>

        </form>

        <div class="ui message">
            Go to <a href="login">login</a>
        </div>
    </div>
</div>
</body>
