<?php

namespace RefBytes\Outseta\Enums;

enum AccountStage: int
{
    case Trialing = 2;
    case Subscribing = 3;
    case Canceling = 4;
    case Expired = 5;
    case TrialExpired = 6;
    case PastDue = 7;
    case CancellingTrial = 8;
}
