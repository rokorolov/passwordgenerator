<?php

namespace app\base;

use app\helper\ViewHelper;

/**
 * Description of BaseController
 *
 * @author rkorolovs
 */
class BaseController
{
    protected $view;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->view = new ViewHelper();
    }
}
