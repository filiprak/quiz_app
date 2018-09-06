<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo(isset($page_title) ? $page_title : 'Quiz App - Start'); ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() . 'assets/favicon.png'; ?>"/>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() . 'assets/favicon.png'; ?>"/>

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/libs/semantic-ui-2.3.3/semantic.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/welcome.css'; ?>">

    <script type="text/javascript" src="<?php echo base_url() . 'assets/libs/jquery-2.2.4.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/utils.js'; ?>"></script>
    <script type="text/javascript"
            src="<?php echo base_url() . 'assets/libs/semantic-ui-2.3.3/semantic.min.js'; ?>"></script>
    <script type="text/javascript"
            src="<?php echo base_url() . 'assets/libs/semantic-ui-2.3.3/components/state.min.js'; ?>"></script>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700" rel="stylesheet">

</head>
<body>

<div class="ui text container">
    <h1 style="font-size: 80px">Your result</h1>

    <?php if (!empty($message)) { ?>
        <div class="ui message error">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <?php //pp($suggestions); ?>

    <div class="ui grid stackable large labels final-scores">
        <div class="four wide column">
            <div class="ui label orange fluid">Score A: <div class="detail"><?php echo $final_score['score_A'] ?></div>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui label orange fluid">Score I: <div class="detail"><?php echo $final_score['score_I'] ?></div>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui label orange fluid">Score C: <div class="detail"><?php echo $final_score['score_C'] ?></div>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui label orange fluid">Score P: <div class="detail"><?php echo $final_score['score_P'] ?></div>
            </div>
        </div>
    </div>

    <div style="margin-top: 50px" class="suggestions">
        <div class="ui three doubling stackable cards">
            <?php foreach ($suggestions as $suggestion) {?>
                <div class="ui card">
                    <?php if (is_string($suggestion['image']) && strlen($suggestion['image']) > 0) { ?>
                        <div style="padding: 15px" class="image">
                            <img src="<?php echo base_url() . 'uploads/suggestions/' . $suggestion['image'] ?>" alt="Image not found">
                        </div>
                    <?php } ?>
                    <div class="content">
                        <div class="header"><?php echo htmlspecialchars($suggestion['name']) ?></div>
                        <div class="description">
                            <?php echo htmlspecialchars($suggestion['description']) ?>
                        </div>
                        <a data-value="<?php echo $suggestion['id'] ?>" class="floating ui green label circular like" title="Like" onclick="click_like($(this), 1)"><i class="thumbs up icon"></i></a>
                        <a data-value="<?php echo $suggestion['id'] ?>" class="floating ui red label circular dislike" title="Dislike" onclick="click_like($(this), 0)"><i class="thumbs down icon"></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>


<script>

    function click_like(self, like) {
        const labels = self.parent().find('.ui.floating.label');
        const suggestion_id = self.attr('data-value');
        labels.transition({
            animation: 'drop',
            onComplete: function () {
                labels.parent().append('<div class="floating ui orange label circular"><i class="checkmark icon"></i></div>');
                labels.remove();
            }
        });

        $.get({
            url: "<?php echo base_url() . 'index.php/welcome/rate_suggestion/' ?>" + suggestion_id + '?rating=' + like
        });

    }

</script>
</body>
</html>