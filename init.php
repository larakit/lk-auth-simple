<?php
\Larakit\Boot::register_boot(__DIR__ . '/boot');
\Larakit\Boot::register_provider(\Larakit\Auth\LkAuthSimpleServiceProvider::class);