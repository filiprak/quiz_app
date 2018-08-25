<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include_once 'application/views/partial/ActionWindow.php'; ?>
<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message error">
        <?php echo $message; ?>
    </div>
<?php } ?>

<?php echo form_open('questions/remove_question/' . $question['id']); ?>
<?php echo form_hidden(array('question_id' => $question['id'])); ?>

<?php $aw = new ActionWindow(array(
    'design' => 'error',
    'icon' => 'trash',
    'title' => 'Are you sure you want to delete this question ?',
    'content' => '"' . $question['question'] . '"',
    'buttons' => array(
        array('label' => 'Yes', 'design' => 'red', 'type' => 'submit'),
        array('label' => 'No', 'href' => base_url() . 'index.php/questions/index'),
    )
));
echo $aw->render();
?>

<?php echo form_close();?>
