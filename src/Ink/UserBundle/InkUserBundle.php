<?php

namespace Ink\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class InkUserBundle extends Bundle
{

    public function getParent() {
        return 'FOSUserBundle';
    }
}
