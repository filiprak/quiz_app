<?php

$menu = array(
    'admin_panel' => array('href' => 'index.php/admin_panel', 'label' => 'Panel'),
    'users' => array('href' => 'index.php/users', 'label' => 'Users'),
    'questions' => array('href' => 'index.php/questions', 'label' => 'Questions'),
    'answers' => array('href' => 'index.php/answers', 'label' => 'Answers'),
    'suggestions' => array('href' => 'index.php/suggestions', 'label' => 'Suggestions'),
    'tags' => array('href' => 'index.php/tags', 'label' => 'Tags'),
    'scores' => array('href' => 'index.php/scores', 'label' => 'Scores'),
);

?>


<div class="ui visible left sidebar vertical inverted black main menu">
    <div class="item">
        <a href="<?php echo base_url() . 'index.php/admin_panel/index'; ?>" class="ui logo icon image ">
            <img src="<?php echo base_url() . 'assets/img/logo.png'; ?>">
        </a>
        <span><b>Quiz App</b></span>
    </div>

    <div class="item borderless">
        <a class="float-right" href="<?php echo base_url() . 'index.php/users/edit_user/' . $_SESSION['user_id']; ?>"><i class="icon user"></i></a>
        <b><?php echo htmlspecialchars($_SESSION['fullname']); ?></b>
    </div>

    <div class="item"></div>

    <?php foreach ($menu as $key => $opts) {
        echo '<a class="item" href="' . base_url() . $opts['href'] . '">' . $opts['label'] . '</a>';
    } ?>

    <div class="item borderless"></div>

    <a class="item borderless" href="<?php echo base_url() . 'index.php/auth/logout'; ?>"><i
                class="icon sign-out"></i><b>Logout</b></a>

</div>
