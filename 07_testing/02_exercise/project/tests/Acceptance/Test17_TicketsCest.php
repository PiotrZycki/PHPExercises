<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class Test17_TicketsCest
{
    // tests
    public function test(AcceptanceTester $I): void
    {
        $I->amOnPage("/");

        $I->amGoingTo("open the tickets page");
        $I->click("Tickets");
        $I->seeCurrentUrlEquals("/tickets");
        $I->seeInTitle("Tickets");
        $I->see("Tickets", "h1");

        $I->amGoingTo("fill in the ticket form");
        $name = "John";
        $surname = "Nintendo";
        $email = "johnnin@example.com";

        $I->fillField("name", $name);
        $I->fillField("surname", $surname);
        $I->fillField("email", $email);
        $I->see("Select number of tickets", "h3");
        $I->selectOption('normal', '3');
        $I->selectOption('discounted', '1');

        $I->dontSeeInDatabase("objects", ["key" => "model_ticket_1"]);
        $I->click('Book');

        $I->wantTo('check if ticket got added to the database');
        $I->seeInDatabase("objects", ["key" => "model_ticket_1"]);

        $I->amGoingTo('add another ticket');
        $I->click("Tickets");
        $I->seeCurrentUrlEquals("/tickets");
        $I->seeInTitle("Tickets");
        $I->see("Tickets", "h1");

        $name = "George";
        $surname = "Yamaha";
        $email = "georgya@example.com";
        $I->fillField("name", $name);
        $I->fillField("surname", $surname);
        $I->fillField("email", $email);
        $I->see("Select number of tickets", "h3");
        $I->selectOption('normal', '0');
        $I->selectOption('discounted', '3');

        $I->dontSeeInDatabase("objects", ["key" => "model_ticket_2"]);
        $I->click('Book');
        $I->seeInDatabase("objects", ["key" => "model_ticket_2"]);
    }
}
