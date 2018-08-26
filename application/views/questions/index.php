<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include_once 'application/views/admin_panel/partial/datatable.php'; ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message warning">
        <?php echo $message; ?>
    </div>
<?php } ?>

<?php $questionsdt = new DataTable($questions, array(
    'design' => 'blue fixed',
    'header' => array(
        'data' => array(
            'id' => array('title' => 'ID', 'width' => '60px'),
            'question' => array(
                'title' => 'Question',
                'type' => 'utf-8'),
            'group_id' => array(
                'title' => 'Group',
                'type' => 'utf-8',
                'wrap_label' => true,
                'label_design' => 'orange circular',
                'width' => '15%'),
        ),
        'btn_col_width' => '100px'
    ),
    'row' => array(
        'buttons' => array(
            array('icon' => 'edit', 'design' => 'small icon',
                'href' => base_url() . 'index.php/questions/edit_question',
                'href_append' => array('id')),
            array('icon' => 'trash', 'design' => 'small icon',
                'href' => base_url() . 'index.php/questions/remove_question',
                'href_append' => array('id')),
        )
    ),
    'footer' => array(
        'buttons' => array(
            array('icon' => 'plus', 'design' => 'small green', 'label' => 'Create Question', 'href' => base_url() . 'index.php/questions/create_question')
        )
    ),
    'pagination' => $pagination,
    'search' => $search_question,
    'JS_sortable' => true,
));
echo $questionsdt->render(); ?>

<?php include 'application/views/admin_panel/partial/footer.php'; ?>
