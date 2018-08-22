<div class="ui visible left sidebar vertical inverted main menu">
    <div class="ui container">
        <div class="item">
            <a href="<?php echo base_url() . 'index.php/adminPanel/index'; ?>" class="ui logo icon image ">
                <img src="<?php echo base_url() . 'assets/img/logo.png'; ?>">
            </a>
            <span><b>Admin Panel</b></span>
        </div>

        <a class="item" href="<?php echo base_url() . 'index.php/adminPanel/users'; ?>">Users</a>
        <a class="item" href="<?php echo base_url() . 'index.php/adminPanel/questions'; ?>">Questions</a>
        <a class="item" href="<?php echo base_url() . 'index.php/adminPanel/users'; ?>">Answers</a>
        <a class="item" href="<?php echo base_url() . 'index.php/adminPanel/suggestions'; ?>">Suggestions</a>
        <a class="item" href="<?php echo base_url() . 'index.php/adminPanel/tags'; ?>">Tags</a>
        <a class="item" href="<?php echo base_url() . 'index.php/adminPanel/scores'; ?>">Scores</a>
        <a class="item"><i class="icon sign-out"></i><b>Logout</b></a>

    </div>
</div>
