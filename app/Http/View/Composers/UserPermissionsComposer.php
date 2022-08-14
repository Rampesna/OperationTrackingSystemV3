<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class UserPermissionsComposer
{
    /**
     * @var mixed $userPermissions
     */
    protected $userPermissions;

    public function __construct()
    {
        $this->userPermissions = auth()->guard('user_web')->check() ? auth()->user()->userPermissions()->pluck('id')->toArray() : [];
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('userPermissions', $this->userPermissions);
    }
}
