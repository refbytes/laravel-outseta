<?php

namespace RefBytes\Outseta\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccountDeletedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(public $activity) {}
}
