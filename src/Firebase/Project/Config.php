<?php

declare(strict_types=1);

namespace Kreait\Firebase\Project;

use Kreait\Firebase\ServiceAccount;

interface Config
{
    public function defaultDatabaseUrl(): ?string;

    public function serviceAccount(): ?string;
}
