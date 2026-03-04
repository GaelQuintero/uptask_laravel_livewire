<?php

namespace App;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case ON_HOLD = 'onHold';
    case IN_PROGRESS = 'inProgress';
    case UNDER_REVIEW = 'underReview';
    case COMPLETE = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pendiente',
            self::ON_HOLD => 'En espera',
            self::IN_PROGRESS => 'En progreso',
            self::UNDER_REVIEW => 'En revisión',
            self::COMPLETE => 'Completado',
        };
    }
}
