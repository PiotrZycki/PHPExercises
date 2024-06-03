<?php

namespace Controller;

use Controller\Controller;
use Model\Ids;
use Model\Ticket;
use Model\TicketIds;
use Model\User;

class TicketsController extends Controller
{
    public function index(): Result
    {
        return view('tickets.index')->withTitle('Tickets');
    }
    public function store(): Result
    {
        $tIds = $this->ticketIds();

        $ticket = new Ticket($tIds->nextTicketId++);

        $ticket->name = $_POST["name"];
        $ticket->surname = $_POST["surname"];
        $ticket->email = $_POST["email"];
        $ticket->normal = $_POST["normal"];
        $ticket->discounted = $_POST["discounted"];

        $this->storage()->store($ticket);
        $this->storage()->store($tIds);

        return redirect("/");
    }

    private function TicketIds(): TIcketIds
    {
        $tIds = new TicketIds();
        $distinguishableArray = $this->storage()->load($tIds->key());
        if (count($distinguishableArray) && $distinguishableArray[0] instanceof TicketIds) {
            return $distinguishableArray[0];
        }
        $this->storage()->store($tIds);
        return $tIds;
    }
}
