<?php

namespace RefBytes\Outseta\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PersonCreatedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(public $activity) {}
}
