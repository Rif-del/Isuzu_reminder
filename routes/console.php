<?php

use Illuminate\Support\Facades\Schedule;

// Tambahkan schedule di sini
Schedule::command('pengingat:kirim')->everyMinute();