<?php
abstract class AdminBaseController
{
    protected function renderTemplate($template, $args=array())
    {
        extract($args);
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
