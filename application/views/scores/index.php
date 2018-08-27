<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include_once 'application/views/admin_panel/partial/datatable.php'; ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message warning">
        <?php echo $message; ?>
    </div>
<?php } ?>

<?php $scoresdt = new DataTable($scores, array(
    'design' => 'red fixed',
    'header' => array(
        'data' => array(
            'id' => array('title' => 'ID', 'width' => '60px'),
            'name' => array(
                'title' => 'Name',
                'type' => 'utf-8',
                'width' => '30%'),
            'timestamp' => array(
                'title' => 'Created at',
                'type' => 'datetime',
                'width' => '30%'),
            'total_score_A' => array(
                'title' => 'Score A',
                'type' => 'number',
                'wrap_label' => true,
                'label_design' => 'red circular',
                'width' => '15%'),
            'total_score_I' => array(
                'title' => 'Score I',
                'type' => 'number',
                'wrap_label' => true,
                'label_design' => 'red circular',
                'width' => '15%'),
            'total_score_C' => array(
                'title' => 'Score C',
                'type' => 'number',
                'wrap_label' => true,
                'label_design' => 'red circular',
                'width' => '15%'),
            'total_score_P' => array(
                'title' => 'Score P',
                'type' => 'number',
                'wrap_label' => true,
                'label_design' => 'red circular',
                'width' => '15%'),
        ),
        'btn_col_width' => '100px'
    ),
    'row' => array(
        'buttons' => array(
            array('icon' => 'edit', 'design' => 'small icon',
                'href' => base_url() . 'index.php/scores/edit_score',
                'href_append' => array('id')),
            array('icon' => 'trash', 'design' => 'small icon',
                'href' => base_url() . 'index.php/scores/remove_score',
                'href_append' => array('id')),
        )
    ),
    'footer' => array(
        'buttons' => array(
            array('icon' => 'plus', 'design' => 'small green', 'label' => 'Create score', 'href' => base_url() . 'index.php/scores/create_score')
        )
    ),
    'pagination' => $pagination,
    'search' => $search_score,
    'JS_sortable' => true,
));
echo $scoresdt->render(); ?>

<?php include 'application/views/admin_panel/partial/footer.php'; ?>
