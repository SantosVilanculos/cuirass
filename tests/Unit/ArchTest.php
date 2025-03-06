<?php

declare(strict_types=1);

arch()->preset()->php();
arch()->preset()->security();
arch()->preset()->laravel();

arch()->expect('App')->toUseStrictTypes();
arch()->expect('Database\Factories')->toUseStrictTypes();
arch()->expect('Database\Seeders')->toUseStrictTypes();

arch()->expect('App')->classes()->not->toBeFinal();
arch()->expect('Database\Factories')->classes()->not->toBeFinal();
arch()->expect('Database\Seeders')->classes()->not->toBeFinal();

arch()->expect('App\Http\Controllers')->toExtendNothing();
