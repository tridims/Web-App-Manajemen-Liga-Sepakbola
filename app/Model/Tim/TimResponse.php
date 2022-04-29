<?php

namespace Tridi\ManajemenLiga\Model\Tim;

use Tridi\ManajemenLiga\Domain\TimSepakBola;

class TimResponse {
    public TimSepakBola $tim;

    public function __construct(TimSepakBola $tim)
    {
        $this->tim = $tim;
    }

}
