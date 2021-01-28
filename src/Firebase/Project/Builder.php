<?php

declare(strict_types=1);

namespace Kreait\Firebase\Project;

use Kreait\Firebase\Contract\Project;

interface Builder
{
    public function buildProject(Config $config): Project;
}
