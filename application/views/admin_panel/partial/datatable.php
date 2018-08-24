<?php

class DataTable
{
    function __construct($data=array(), $options=array())
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

        $this->colspan = is_numeric($options['colspan']) ? $options['colspan'] : $this->data_width;
        if ($this->row_has_buttons) $this->colspan += 1;
    }

    private function render_row($data=array(), $options=array())
    {
        $html_output = '<tr>';

        $data = is_array($data) || is_object($data) ? $data : array();
        foreach ($this->header['data'] as $key => $val) {
            $cell_data = isset($data->$key) ? $data->$key : '';
            $html_output .= '<td>' . $cell_data . '</td>';
        }

        if (is_array($options['buttons'])) {
            $html_btns = '';
            foreach ($options['buttons'] as $btn) {
                if (is_array($btn['href_append'])) {
                    $append = array();
                    foreach ($btn['href_append'] as $key) {
                        if (isset($data->$key)) array_push($append, $data->$key);
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

    private function render_header($options=array())
    {
        $html_output = '<thead><tr>';

        $data = is_array($options['data']) ? $options['data'] : array();
        foreach ($data as $key => $val) {
            $html_output .= '<th>' . $val . '</th>';
        }

        if ($this->row_has_buttons) {
            $html_output .= '<th class="right aligned">' . $options['buttonsHeader'] . '</th>';
        }

        return $html_output . '</tr></thead>';
    }

    private function render_footer($options=array())
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
                        
                        '. $this->render_pagination($this->pagination) .'
                        <div class="ui left floated">' . $html_btns . '</div>
                    </th>
                </tr></tfoot>';
    }

    private function render_pagination($options=array())
    {
        $href_base = (string) $options['href_base'];
        $total = (int) $options['total'];
        $page = (int) $options['page'];
        $perpage = is_numeric($options['perpage']) ? (int) $options['perpage'] : 10;

        $total_pages = (int) ($total / $perpage) + (((int) ($total / $perpage)) != ($total / $perpage) ? 1 : 0);

        if (is_array($options) && count($options) > 0) {
            $islast = $page >= $total_pages;
            $isfirst = $page == 1;
            $item1 = $page - 2 > 0 ? '<a href="' . $href_base . ($page - 2) . '" class="item">'.($page - 2).'</a>' : '';
            $item2 = $page - 1 > 0 ? '<a href="' . $href_base . ($page - 1) . '" class="item">'.($page - 1).'</a>' : '';
            $item3 = '<a class="item active">'.$page.'</a>';
            $item4 = $page + 1 <= $total_pages ? '<a href="' . $href_base . ($page + 1) . '" class="item">'.($page + 1).'</a>' : '';
            $item5 = $page + 2 <= $total_pages ? '<a href="' . $href_base . ($page + 2) . '" class="item">'.($page + 2).'</a>' : '';
            return '<div class="">
                        
                        <div class="ui right floated small pagination menu">
                            <a href="' . $href_base . 1 . '" class="icon item '. ($isfirst ? 'disabled' : '') .'">
                                <i class="left chevron icon"></i>
                            </a>
                            '.$item1.$item2.$item3.$item4.$item5.'
                            <a href="' . $href_base . $total_pages . '" class="icon item '. ($islast ? 'disabled' : '') .'">
                                <i class="right chevron icon"></i>
                            </a>
                        </div>
                    </div>';
        }
        return '';
    }

    function render()
    {
        $design = $this->options['design'];
        $html_output = '<table class="ui '.$design.' table">';

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

