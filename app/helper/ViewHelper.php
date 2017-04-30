<?php

namespace app\helper;

/**
 * Description of ViewHelper
 *
 * @author rkorolovs
 */
class ViewHelper
{
    /**
     * @param $view
     * @param array $data
     * @return mixed
     */
    public function view($view, $data = [])
    {
        extract($data);
        
        return include_once 'app/views/' . $view;
    }
}
