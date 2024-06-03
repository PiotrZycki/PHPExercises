<?php

namespace Acceptance;

use Model\User;
use Tests\Support\AcceptanceTester;

class Test18_PostsCest
{
    // tests
    public function test(AcceptanceTester $I): void
    {
        $I->recreateObjectTable();

        $I->wantTo('login and add a post');

        $user = new User(12);
        $user->name = "Derry";
        $user->surname = "Dell";
        $user->email = "dede@example.com";
        $user->password = password_hash("lrlreedd", PASSWORD_DEFAULT);
        $user->confirmed = true;
        $user->token = null;

        $id = $I->haveInDatabase("objects", [
            "key" => $user->key(),
            "data" => serialize($user)
        ]);

        $I->amOnPage("/auth/login");
        $I->fillField("email", $user->email);
        $I->fillField("password", "lrlreedd");
        $I->click("Enter");

        $I->seeCurrentUrlEquals("/");
        $I->click("Feed");
        $I->seeCurrentUrlEquals("/feed");
        $I->see("News", "h1");
        $I->click("Add new post");


        $I->wantTo('Add new post');
        $title = "Duck walks into pub, drinks pint, fights dog, loses. Maintains bow tie.";
        $text = "Britain's booziest duck that became a celebrity for downing pints in his local pub has been seriously injured - in a brawl with a DOG.
        
        The bird - called Star - is well known for waddling around his favourite inns wearing a bow tie and swigging ale from a glass.
        T
        he booze-loving duck and his handler Barrie Hayman are a regular sight in their local taverns - some of which even give Star his own stool.
        
        But Star's drinking days could be over after an altercation with a dog after returning from his favourite watering-hole The Old Courthouse Inn.
        
        Star came to blows and lost out to pooch Meggie - which also belongs to Star's owner Barrie.";

        $I->fillField("postTitle", $title);
        $I->fillField("postText", $text);
        $I->dontSeeInDatabase("objects", ["key" => "model_post_1"]);
        $I->click('Publish');
        $I->seeInDatabase("objects", ["key" => "model_post_1"]);

        $I->seeCurrentUrlEquals("/feed");
        $I->see("News", "h1");
        $I->see("Add new post", "a");
        $I->click('Load posts');
        $I->see($title, "h3");

        $I->wantTo('Add second post');
        $title2 = "Family raises 'dog' for 2 years, then realizes it's a bear.";
        $text2 = "A family in a remote part of China adopted what it thought was a puppy, only to discover two years later that it was actually a bear.

        Su Yun, who lives in a village outside the city of Kunming in Yunnan Province, bought what she was led to believe was a Tibetan mastiff puppy while on vacation back in 2016, according to reports.

        Tibetan mastiffs are huge dogs with a thick black-and-brown coat. Males can weigh as much as 150 pounds.   

        The owner said she was immediately struck by her pooch’s insatiable appetite, which had him wolfing down a box of fruits and two buckets of noodles daily.
        
        Two years on, Su’s pet was tipping the scales at 250 pounds and getting ever bigger.

        When the woman noticed the animal’s unusual knack for walking on two legs, her bewilderment escalated to alarm.";

        $I->click("Add new post");
        $I->fillField("postTitle", $title2);
        $I->fillField("postText", $text2);
        $I->dontSeeInDatabase("objects", ["key" => "model_post_2"]);
        $I->click('Publish');
        $I->seeInDatabase("objects", ["key" => "model_post_2"]);

        $I->seeCurrentUrlEquals("/feed");
        $I->see("News", "h1");
        $I->click("Add new post");

        $title3 = "Checking out the ssscenery? Shocked Bondi woman finds a huge reptile slithering on her balcony - and has no idea how it got there.";
        $text3 = "A Sydneysider living in the city's urbanised eastern suburbs has been left shocked after discovering a snake on her balcony.  

        The woman shared a photo on social media of the unlikely visitor basking on her outdoor furniture on Wednesday. 

        The juvenile python appeared to have been nestled behind the lounge's back cushions before emerging to slither across one of the arms. ";

        $I->click("Add new post");
        $I->fillField("postTitle", $title3);
        $I->fillField("postText", $text3);
        $I->dontSeeInDatabase("objects", ["key" => "model_post_3"]);
        $I->click('Publish');
        $I->seeInDatabase("objects", ["key" => "model_post_3"]);

        $I->seeCurrentUrlEquals("/feed");
        $I->see("News", "h1");
        $I->click('Load posts');
        $I->see($title, "h3");
        $I->see($title2, "h3");
        $I->see($title3, "h3");

        $I->wantTo('not see posting form after logout');
        $I->seeLink("Logout", "/auth/logout");
        $I->click("Logout");
        $I->seeCurrentUrlEquals("/");
        $I->click("Feed");
        $I->seeCurrentUrlEquals("/feed");
        $I->see("News", "h1");
        //$I->click("Add new post");
        //$I->dontSee("Enter text here...", "textarea");
        $I->dontSee("Add new post", "a");

        $I->wantTo('see full post');
        $I->click('Load posts');
        $I->seeLink("Read more", "/feed/1");
        $I->click("Read more");
        $I->see("Duck walks into pub, drinks pint, fights dog, loses. Maintains bow tie.", "h3");
        $I->click("Load posts");
        $I->seeLink("Read more", "/feed/2");
        $I->seeLink("Read more", "/feed/3");
    }
}
