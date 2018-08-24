<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include_once 'application/views/admin_panel/partial/datatable.php'; ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message warning">
        <?php echo $message; ?>
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
            array('icon' => 'edit', 'design' => 'small blue icon',
                'href' => base_url() . 'index.php/users/edit_user',
                'href_append' => array('id')),
            array('icon' => 'trash', 'design' => 'small red icon',
                'href' => base_url() . 'index.php/users/remove_user',
                'href_append' => array('id')),
        )
    ),
    'footer' => array(
        'buttons' => array(
            array('icon' => 'plus', 'design' => 'small green', 'label' => 'Create User', 'href' => base_url() . 'index.php/users/create_user')
        )
    ),
    'pagination' => $pagination
));
echo $usersdt->render(); ?>

<?php include 'application/views/admin_panel/partial/footer.php'; ?>
