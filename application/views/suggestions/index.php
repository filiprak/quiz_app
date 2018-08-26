<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include_once 'application/views/admin_panel/partial/datatable.php'; ?>

<?php include 'application/views/admin_panel/partial/header.php'; ?>

<?php if (!empty($message)) { ?>
    <div class="ui message warning">
        <?php echo $message; ?>
    </div>
<?php } ?>

<?php $suggestionsdt = new DataTable($suggestions, array(
    'design' => 'purple fixed',
    'header' => array(
        'data' => array(
            'id' => array('title' => 'ID', 'width' => '60px'),
            'name' => array(
                'title' => 'Name',
                'type' => 'utf-8',
                'width' => '30%'),
            'description' => array(
                'title' => 'Desciption',
                'type' => 'utf-8',
                'width' => '30%'),
            'score_A' => array(
                'title' => 'Score A',
                'type' => 'number',
                'wrap_label' => true,
                'label_design' => 'purple circular',
                'width' => '15%'),
            'score_I' => array(
                'title' => 'Score I',
                'type' => 'number',
                'wrap_label' => true,
                'label_design' => 'purple circular',
                'width' => '15%'),
            'score_C' => array(
                'title' => 'Score C',
                'type' => 'number',
                'wrap_label' => true,
                'label_design' => 'purple circular',
                'width' => '15%'),
            'score_P' => array(
                'title' => 'Score P',
                'type' => 'number',
                'wrap_label' => true,
                'label_design' => 'purple circular',
                'width' => '15%'),
        ),
        'btn_col_width' => '100px'
    ),
    'row' => array(
        'buttons' => array(
            array('icon' => 'edit', 'design' => 'small icon',
                'href' => base_url() . 'index.php/suggestions/edit_suggestion',
                'href_append' => array('id')),
            array('icon' => 'trash', 'design' => 'small icon',
                'href' => base_url() . 'index.php/suggestions/remove_suggestion',
                'href_append' => array('id')),
        )
    ),
    'footer' => array(
        'buttons' => array(
            array('icon' => 'plus', 'design' => 'small green', 'label' => 'Create Suggestion', 'href' => base_url() . 'index.php/suggestions/create_suggestion')
        )
    ),
    'pagination' => $pagination,
    'search' => $search_suggestion,
    'JS_sortable' => true,
));
echo $suggestionsdt->render(); ?>

<?php include 'application/views/admin_panel/partial/footer.php'; ?>
