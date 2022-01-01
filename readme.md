## Installation

1. Install laravel `laravel new eBis`
2. cd project `cd eBis`
3. Install eis `composer require milestone/ebis`
4. Add a key `DOMAIN` in env file with domain as its value `DOMAIN=ebis`
5. Comment database details like Host, User, Password in env file
6. Comment every route in base router 
7. php artisan `vendor:publish`

## Start Using
The main site just displays a home page only ```http://ebis/``` <br />
Each client should have a subdomain. Ex: ```http://client1.ebis``` <br />
Initially need to create subdomain which points to same code base.<br />
Upon visiting to such subdomain, setup screen will be displayed, where client code need to br given.<br />
_Client Code_ is the code which can get from milestoneit.net > eBis.<br />
Each client who required eBis feature should be registered in milestoneit.net and must have a valid subscription added.<br />
Upon giving client code and clicking on _Fetch Details_ every subscription will be loaded from milestoneit.net.<br />
Select the subscription from dropdown, then fill every field, then click Register.<br />
Every setup will be done automatically. <br />
