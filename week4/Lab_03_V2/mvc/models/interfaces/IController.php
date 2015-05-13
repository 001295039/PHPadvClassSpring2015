<?php

/**
 *
 * @author GForti
 */

namespace App\models\interfaces;

use App\models\services\Scope;

interface IController {
    public function execute(Scope $scope);
}
