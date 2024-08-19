<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

trait LogHelper {
    public function logInfo($message, $context = []) {
        Log::info($message, $context);
    }

    public function logError($message, $context = []) {
        Log::error($message, $context);
    }
}
