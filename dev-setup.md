**Development Setup**

Install Laravel<br />
`laravel new eBis`<br />

Move to installed directory<br />
`cd eBis`<br />

Create and move to directory milestone<br />
`mkdir milestone` `cd milestone`<br />

Clone eBis from github<br />
`git clone https://github.com/MilestoneInnovativeTechnologies/ebis.git` <br />

Back to root directory<br />
`cd ..`<br /><br />

Add an entry<br />
`"Milestone\\eBis\\": "milestone/ebis/src"`<br />
to autoload -> psr-4 in composer.json

Add an entry<br />
`Milestone\eBis\eBisServiceProvider::class,`<br />
to config -> app -> providers

Import required composer packages<br />
`composer require staudenmeir/eloquent-json-relations`

Add a key `DOMAIN` in env file with domain as its value<br />
`DOMAIN=ebis`

Comment every route in web.php<br />
Comment database host,database,username & password params in .env file<br />

Publish config & assets<br />
`php artisan vendor:publish`<br />
_(eBisServiceProvider)_

Copy development required files and folders from package folder. Run in CMD
```.\milestone\ebis\init```

**Development Prerequisite**<br />
**Quasar** in required for development.<br /><br />
Check for quasar existence<br />
`quasar --version`<br />
If installed, the current version will be displayed, If it hasn't installed, install using<br />
`npm install -g @quasar/cli`

Add a line to .env file for developing `DEV=1`<br />
once in production, remove line or make `DEV=0`<br />

`npm install`

`npm run dev` for development process<br />
`npm run build` for building<br />

**Notes**
1. The compiled assets are automatically copied to package assets folder as ready to deploy..

**Start Using**<br />
The main site just displays a home page only ```http://ebis/``` <br />
Each client should have a subdomain. Ex: ```http://client1.ebis``` <br />
Just need to create subdomains which points to same code base.<br />
Upon visiting to such subdomain, setup screen will be displayed, where client code need to given.<br />
_Client Code_ is the code which can be get from milestoneit.net > eBis.<br />
Each client who required eBis feature should be registered there and must have a valid subscription added.<br />
Upon giving client code and clicking on _Fetch Details_ every subscription will be loaded from milestoneit.net..<br />
Select the subscription from dropdown, then fill every fields, then click Register.<br />
Every setup will be done automatically.. <br />
For having any user to test interface, create a user in users table of client1.ebis database having password field filled with<br />
`$2y$10$WTF3.Qf3LMAVx.pEpwHpFe1OHuWdc4byGC0d2fKSbuwnoybVCYZ/e` which is encoded string of _123456_<br />

Login using the email provided here and password: 123456 to test interface.. No any widgets displays initially as no any data will be there in database.. Pump some data to have widgets to be displayed..
