<?php

declare(strict_types=1);

namespace Kreait\Firebase\Project;

use Kreait\Firebase\Contract\Project;

final class FactoryBasedProjectBuilder implements Builder
{
    public function buildProject(Config $config): Project
    {
        return new FactoryBasedProject($config);
    }
}
