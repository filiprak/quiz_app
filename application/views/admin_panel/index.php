<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'partial/header.php'; ?>

<div class="ui icon message info">
    <i class="question icon"></i>
    <div class="content">
        <div class="header">
            Total number of questions in database: <?php echo number_format($total_questions, 0); ?>
        </div>
    </div>
</div>
<div class="ui icon message info">
    <i class="clone icon"></i>
    <div class="content">
        <div class="header">
            Total number of question groups: <?php echo number_format($total_q_groups, 0); ?>
        </div>
    </div>
</div>
<div class="ui icon message info">
    <i class="trophy icon"></i>
    <div class="content">
        <div class="header">
            Total number of scores in database: <?php echo number_format($total_scores, 0); ?>
        </div>
    </div>
</div>
<div class="ui icon message info">
    <i class="user icon"></i>
    <div class="content">
        <div class="header">
            Total number of admin panel users: <?php echo number_format($total_users, 0); ?>
        </div>
    </div>
</div>

<?php include 'partial/footer.php'; ?>
