<?php

class AdminController extends BaseController
{
    /**
     * Admin index
     * @return Response
     */
    public function getIndex()
    {
        return View::make('admin.index');
    }


}
