<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'partial/header.php'; ?>

<div class="ui icon message">
    <i class="inbox icon"></i>
    <div class="content">
        <div class="header">
            Have you heard about our mailing list?
        </div>
        <p>Get the best news in your e-mail every day.</p>
    </div>
</div>

<table class="ui basic table">
    <thead>
    <tr>
        <th>Header</th>
        <th>Header</th>
        <th class="right aligned">Edit/Delete</th>
    </tr></thead>
    <tbody>
    <tr>
        <td>Cell</td>
        <td>Cell</td>
        <td class="right aligned"><div class="ui small blue icon buttons">
                <button class="ui button"><i class="edit icon"></i></button>
                <button class="ui button"><i class="trash alternate icon"></i></button>
            </div></td>
    </tr>
    <tr>
        <td>Cell</td>
        <td>Cell</td>
        <td class="right aligned"><div class="ui small blue icon buttons">
                <button class="ui button"><i class="edit icon"></i></button>
                <button class="ui button"><i class="trash alternate icon"></i></button>
            </div></td>
    </tr>
    <tr>
        <td>Cell</td>
        <td>Cell</td>
        <td class="right aligned"><div class="ui small blue icon buttons">
                <button class="ui button"><i class="edit icon"></i></button>
                <button class="ui button"><i class="trash alternate icon"></i></button>
            </div></td>
    </tr>
    </tbody>

    <tfoot>
    <tr><th colspan="3">
            <div class="ui right floated small pagination menu">
                <a class="icon item">
                    <i class="left chevron icon"></i>
                </a>
                <a class="item">1</a>
                <a class="item">2</a>
                <a class="item active">3</a>
                <a class="item">4</a>
                <a class="icon item">
                    <i class="right chevron icon"></i>
                </a>
            </div>
            <div class="ui left floated">
                <button class="ui small green button"><i class="add icon"></i>new</button>
            </div>
        </th>
    </tr></tfoot>
</table>


<?php include 'partial/footer.php'; ?>
