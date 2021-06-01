<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Barryvdh\DomPDF\Facade as PDF;


class PeopleController extends Controller
{
    public function report(Person $person)
    {
        $people = $person->with(['addresses.type_address', 'addresses.city', 'addresses.state'])->get();

        return PDF::loadView('tenants.reports.people.report', compact('people'))
            ->setPaper('a4')
            ->stream('people.pdf');

    }
}
