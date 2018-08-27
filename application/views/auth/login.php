<?php include 'application/views/partial/header.php'; ?>

<body class="login-body">
<div class="ui middle aligned center aligned grid login">
    <div style="max-width: 450px"  class="column">
        <h2 class="ui orange header">
            <div class="content"><?php echo lang('login_heading');?></div>
        </h2>
        <div style="display: <?php echo empty($message) ? 'none' : 'block'; ?>" class="ui error message">
            <ul class="list">
                <?php echo $message;?>
            </ul>
        </div>
        <form class="ui large form" action="login" method="POST">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <?php echo form_input($identity, '', 'placeholder=Email');?>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <?php echo form_input($password, '', 'placeholder=Password');?>
                    </div>
                </div>
                <div style="text-align: left" class="field left aligned">
                    <div class="ui checkbox">
                        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember" class="ui checkbox"');?>
                        <?php echo lang('login_remember_label', 'remember');?>
                    </div>
                </div>
                <input type="submit" class="ui fluid large orange submit button" value="<?php echo lang('login_submit_btn'); ?>">
            </div>

        </form>

        <div class="ui message">
            <?php echo lang('login_forgot_password');?> <a href="forgot_password">click here</a>
        </div>
    </div>
</div>
</body>
