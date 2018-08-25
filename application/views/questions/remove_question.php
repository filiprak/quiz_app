<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include_once 'application/views/partial/ActionWindow.php'; ?>
<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message error">
        <?php echo $message; ?>
    </div>
<?php } ?>

<?php echo form_open('users/remove_user/' . $user->id); ?>
<?php echo form_hidden(array('user_id' => $user->id)); ?>

<?php $aw = new ActionWindow(array(
    'design' => 'error',
    'icon' => 'trash',
    'title' => 'Are you sure you want to delete this user account ?',
    'content' => $user->email,
    'buttons' => array(
        array('label' => 'Yes', 'design' => 'red', 'type' => 'submit'),
        array('label' => 'No', 'href' => base_url() . 'index.php/users/index'),
    )
));
echo $aw->render();
?>

<?php echo form_close();?>
