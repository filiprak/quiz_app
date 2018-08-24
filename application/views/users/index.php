<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include_once 'application/views/admin_panel/partial/datatable.php'; ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message info">
        <ul><?php echo $message; ?></ul>
    </div>
<?php } ?>

<?php $usersdt = new DataTable($users, array(
    'header' => array(
        'data' => array(
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'email' => 'E-mail'
        )
    ),
    'row' => array(
        'buttons' => array(
            array('icon' => 'edit', 'design' => 'small blue icon', 'href' => 'users/edit_user'),
            array('icon' => 'trash', 'design' => 'small red icon', 'href' => 'users/remove_user'),
        )
    ),
    'footer' => array(
        'buttons' => array(
            array('icon' => 'plus', 'design' => 'small green', 'label' => 'Create User', 'href' => 'users/create_user')
        )
    )
));
echo $usersdt->render(); ?>

<?php include 'application/views/admin_panel/partial/footer.php'; ?>
