<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Incident;
use App\Models\IncidentEvent;
use App\Models\IncidentFollowUp;
use Carbon\Carbon;

class IncidentDemoSeeder extends Seeder
{
    public function run(): void
    {
        $started = Carbon::now()->subMinutes(45);

        $incident = Incident::create([
            'key'              => 'IC-2471',
            'title'            => 'Checkout failures for credit card payments',
            'severity'         => 'SEV1',
            'status'           => 'investigating',
            'system'           => 'Payments',
            'impacted_regions' => ['US-East', 'US-West'],
            'impacted_users'   => '~32 percent of active sessions',
            'owner'            => 'On call payments',
            'summary'          => 'Elevated failure rate on credit card charges. PayPal and ACH remain healthy.',
            'tags'             => ['payments', 'checkout', 'stripe-gateway', 'revenue-impact'],
            'started_at'       => $started,
            'last_updated_at'  => Carbon::now()->subMinutes(5),
        ]);

        IncidentEvent::create([
            'incident_id' => $incident->id,
            'occurred_at' => $started,
            'type'        => 'detected',
            'actor'       => 'Alert: payments_error_rate',
            'label'       => 'Alert fired for spike in 5xx from payment service',
            'detail'      => 'Error rate went from 0.3 percent to 7.8 percent over 5 minutes.',
        ]);

        IncidentFollowUp::create([
            'incident_id' => $incident->id,
            'owner'       => 'Payments team',
            'label'       => 'Add synthetic monitoring for credit card only path',
            'status'      => 'open',
        ]);
    }
}
