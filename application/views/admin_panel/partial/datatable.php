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
                        <div class="ui left floated">' . $html_btns . '</div>
                    </th>
                </tr></tfoot>';
    }

    private function render_pagination($options=array())
    {

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

