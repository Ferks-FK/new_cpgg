<?php

use App\Tasks\ChargeUsers;
use Illuminate\Support\Facades\Schedule;

Schedule::call(new ChargeUsers())->hourly();
