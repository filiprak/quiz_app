<?php

class DataTable
{
    function __construct($data = array(), $options = array())
    {
        // default options
        $options['header'] = is_array($options['header']) ? $options['header'] : array(
            'data' => array('empty' => 'Empty Header'),

        );
        $options['row'] = is_array($options['row']) ? $options['row'] : array(
            'buttons' => array(
                array('icon' => 'edit', 'design' => 'small blue icon'),
                array('icon' => 'trash', 'design' => 'small red icon'),
            )
        );
        $options['footer'] = is_array($options['footer']) ? $options['footer'] : array(
            'buttons' => array(
                array('icon' => 'plus', 'design' => 'small green icon'),
            )
        );
        $options['design'] = isset($options['design']) ? $options['design'] : 'basic';

        $this->options = $options;
        $this->header = $options['header'];
        $this->row = $options['row'];
        $this->pagination = $options['pagination'];
        $this->row_has_buttons = is_array($options['row']['buttons']);
        $this->footer = $options['footer'];
        $this->data = $data;
        $this->data_length = count($data);
        $this->data_width = count($options['header']['data']);
        $this->search = is_array($options['search']) ? $options['search'] : false;

        $this->colspan = is_numeric($options['colspan']) ? $options['colspan'] : $this->data_width;
        if ($this->row_has_buttons) $this->colspan += 1;
    }

    private function render_row($data = array(), $options = array())
    {
        $html_output = '<tr>';

        $data = is_array($data) || is_object($data) ? $data : array();
        foreach ($this->header['data'] as $key => $opts) {
            $cell_data = (is_object($data) ? $data->$key : $data[$key]);
            $cell_data = isset($cell_data) ? $cell_data : '';
            $type = isset($opts['type']) ? $opts['type'] : false;
            if ($type == 'utf-8') {
                $cell_data = htmlspecialchars($cell_data, ENT_QUOTES, 'UTF-8');
            } else if ($type == 'date' || $type == 'datetime') {
                $format = is_string($opts['format']) ? $opts['format'] : ($type == 'date' ? 'd-m-Y' : 'd-m-Y H:i:s');
                if (is_string($cell_data)) $cell_data = date($format, strtotime($cell_data));
                else if (is_numeric($cell_data)) $cell_data = date($format, $cell_data);
                else $cell_data = '';
            } else if ($type == 'number') {
                $format = is_array($opts['format']) ? $opts['format'] : array();
                $decimals = is_numeric($format['decimals']) ? $format['decimals'] : 0;
                $cell_data = number_format($cell_data, $decimals);
            } else if ($type == 'boolean') {
                $format = is_array($opts['format']) ? $opts['format'] : array();
                $icons = is_array($format['icons']) ? $format['icons'] : false;
                $strings = is_array($format['strings']) ? $format['strings'] : false;
                if ($icons) {
                    $cell_data = $cell_data ? '<i class="icon ' . $icons[0] . '">' .
                        htmlspecialchars($strings[0], ENT_QUOTES, 'UTF-8') . '</i></div>' :
                        '<i class="icon ' . $icons[1] . '">' . htmlspecialchars($strings[1], ENT_QUOTES, 'UTF-8') . '</i>';
                } else {
                    $cell_data = htmlspecialchars($cell_data ? $strings[0] : $strings[1], ENT_QUOTES, 'UTF-8');
                }
            }
            if ($opts['wrap_label'] === true) {
                $html_output .= '<td><div class="ui ' . $opts['label_design'] . ' label" >' . $cell_data . '</div></td>';
            } else {
                $html_output .= '<td>' . $cell_data . '</td>';
            }
        }

        if (is_array($options['buttons'])) {
            $html_btns = '';
            foreach ($options['buttons'] as $btn) {
                if (is_array($btn['href_append'])) {
                    $append = array();
                    foreach ($btn['href_append'] as $key) {
                        $append_val = is_array($data) ? $data[$key] : $data->$key;
                        if (isset($append_val)) array_push($append, $append_val);
                    }
                    $btn['href'] .= '/' . implode('/', $append);
                }
                $html_btns .= '<a href="' . $btn['href'] . '" class="ui ' . $btn['design'] . ' button">'
                    . ($btn['icon'] ? '<i class="' . $btn['icon'] . ' icon"></i>' : '')
                    . '<span>' . $btn['label'] . '</span></a>';
            }
            $html_output .= '<td class="right aligned"><div class="ui small buttons">
                ' . $html_btns . '
            </div></td>';
        }

        return $html_output . '</tr>';
    }

    private function render_header($options = array())
    {
        $html_output = '<thead><tr>';

        $data = is_array($options['data']) ? $options['data'] : array();
        foreach ($data as $key => $val) {
            if (is_array($val)) {
                $html_output .= '<th>' . htmlspecialchars($val['title'], ENT_QUOTES, 'UTF-8') . '</th>';
            } elseif (is_string($val)) {
                $html_output .= '<th>' . htmlspecialchars($val, ENT_QUOTES, 'UTF-8') . '</th>';
            } else {
                $html_output .= '<th></th>';
            }
        }

        if ($this->row_has_buttons) {
            $html_output .= '<th class="right aligned">' . $options['buttonsHeader'] . '</th>';
        }

        return $html_output . '</tr></thead>';
    }

    private function render_footer($options = array())
    {
        $buttons = $options['buttons'];

        $html_btns = '';
        if (is_array($buttons)) {
            foreach ($options['buttons'] as $btn) {
                $html_btns .= '<a href="' . $btn['href'] . '" class="ui ' . $btn['design'] . ' button">'
                    . ($btn['icon'] ? '<i class="' . $btn['icon'] . ' icon"></i>' : '')
                    . $btn['label'] . '</a>';
            }
        }

        return '<tfoot>
                <tr><th colspan="' . $this->colspan . '">
                <div class="ui equal width column stackable vertically divided grid">
                        ' . ($this->search ? '<div class="left floated column">
                                        <form class="left aligned" action="" method="GET">
                                            <div class="ui action input">
                                                <input name="' . $this->search['param_name'] . '" type="text" placeholder="Search..." value="' . $this->search['value'] . '">
                                                <button type="submit" class="ui button icon"><i class="search icon"></i></button>
                                            </div>
                                        </form>
                                        <script>console.log(document)</script>
                                        </div>' : '') . '
                        <div class="right floated column">' . $this->render_pagination($this->pagination) . '</div>
                </div>
                <div class="ui divider"></div>
                <div class="ui equal width column stackable vertically divided grid">
                        <div class="left floated column">' . $html_btns . '</div>
                </div>
                </th>
            </tr></tfoot>';
    }

    private function render_pagination($options = array())
    {
        $href_base = (string)$options['href_base'];
        $total = (int)$options['total'];
        $page = (int)$options['page'];
        $perpage = is_numeric($options['perpage']) ? (int)$options['perpage'] : 10;

        $total_pages = (int)($total / $perpage) + (((int)($total / $perpage)) != ($total / $perpage) ? 1 : 0);

        if (is_array($options) && count($options) > 0) {
            $islast = $page >= $total_pages;
            $isfirst = $page == 1;

            $query_str = ($this->search['value'] ? '&' . $this->search['param_name'] . '=' . $this->search['value'] : '');

            $item1 = $page - 2 > 0 ? '<a href="' . $href_base . ($page - 2) . $query_str . '" class="item">' . ($page - 2) . '</a>' : '';
            $item2 = $page - 1 > 0 ? '<a href="' . $href_base . ($page - 1) . $query_str . '" class="item">' . ($page - 1) . '</a>' : '';
            $item3 = '<a class="item active">' . $page . '</a>';
            $item4 = $page + 1 <= $total_pages ? '<a href="' . $href_base . ($page + 1) . $query_str . '" class="item">' . ($page + 1) . '</a>' : '';
            $item5 = $page + 2 <= $total_pages ? '<a href="' . $href_base . ($page + 2) . $query_str . '" class="item">' . ($page + 2) . '</a>' : '';

            return '<div class="ui right floated small pagination menu">
                        <a ' . ($isfirst ? '' : 'href="' . $href_base . 1 . $query_str . '"') . ' class="icon item ' . ($isfirst ? 'disabled' : '') . '">
                            <i class="left chevron icon"></i>
                        </a>
                        ' . $item1 . $item2 . $item3 . $item4 . $item5 . '
                        <a ' . ($islast ? '' : 'href="' . $href_base . $total_pages . $query_str . '"') . ' class="icon item ' . ($islast ? 'disabled' : '') . '">
                            <i class="right chevron icon"></i>
                        </a>
                        <div class="item">total rows: ' . number_format($total, 0) . '</div>
                    </div>';
        }
        return '';
    }

    function render()
    {
        $design = $this->options['design'];
        $html_output = '<table class="ui ' . $design . ' table">';

        $html_output .= $this->render_header($this->header);
        $html_output .= '<tbody>';
        foreach ($this->data as $data_row) {
            $html_output .= $this->render_row($data_row, $this->row);
        }
        if (count($this->data) < 1) {
            $html_output .= '<tr><td colspan="' . $this->colspan . '">
                        <div class="ui center aligned tiny warning message">No items found</div>
                        </td></tr>';
        }
        $html_output .= '</tbody>';
        $html_output .= $this->render_footer($this->footer);

        return $html_output . '</table>';
    }
}

