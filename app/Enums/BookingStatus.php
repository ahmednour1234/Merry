<?php

namespace App\Enums;

enum BookingStatus: string
{
	case PENDING  = 'pending';
	case ACCEPTED = 'accepted';
	case REJECTED = 'rejected';
	case CANCELLED = 'cancelled';

	public static function activeStatuses(): array
	{
		return [self::PENDING->value, self::ACCEPTED->value];
	}
}


