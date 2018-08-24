<?php

class ActionWindow
{
    public function __construct($options = array())
    {
        $this->options = $options;
        $this->design = $options['design'] ? $options['design'] : '';
        $this->buttons = is_array($options['buttons']) ? $options['buttons'] : array();
        $this->title = $options['title'] ? $options['title'] : false;
        $this->content = $options['content'] ? $options['content'] : false;
        $this->icon = $options['icon'] ? $options['icon'] : false;
    }

    public function render()
    {
        $html_output = '<div class="ui ' . ($this->icon ? 'icon' : '') . ' message ' . $this->design . '">';
        if ($this->icon) {
            $html_output .= '<i class="' . $this->icon . ' icon"></i>';
        }
        $html_output .= '<div class="content">';
        if ($this->title) {
            $html_output .= '<div class="header">' . $this->title . '</div>';
        }
        if ($this->content) {
            $html_output .= '<p>' . $this->content . '</p>';
        } else $html_output .= '<p></p>';
        if (count($this->buttons) > 0) {
            $html_output .= '<div class="footer">';
            foreach ($this->buttons as $btn) {
                $btn['size'] = isset($btn['size']) ? $btn['size'] : 'tiny';
                if ($btn['type'] == 'submit') {
                    $html_output .= '<input type="submit" class="ui ' . $btn['size'] . ' ' . $btn['design'] . ' button" value="' . $btn['label'] . '">';
                } else {
                    $html_output .= '<a href="' . $btn['href'] . '" class="ui ' . $btn['size'] . ' ' . $btn['design'] . ' button">'
                        . ($btn['icon'] ? '<i class="' . $btn['icon'] . ' icon"></i>' : '')
                        . $btn['label'] . '</a>';
                }
            }
            $html_output .= '</div>';
        }
        return $html_output . '</div></div>';
    }

}