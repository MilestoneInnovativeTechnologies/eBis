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

Refresh composer autoload<br />
`composer dump-autoload`

Add database params in .env file<br />
Add mail details in .env (ex: mailtrap.io)<br />

Migrate databases<br />
`php artisan migrate`

Publish config & assets<br />
`php artisan vendor:publish`<br />
_(eBisServiceProvider)_

**Development Prerequisite**<br />
**Quasar** in required for development.<br /><br />
Check for quasar existence<br />
`quasar --version`<br />
If installed, the current version will be displayed, If it hasn't installed, install using<br />
`npm install -g @quasar/cli`

Add a line to .env file for developing
`DEV=1`<br />
once in production, remove line or make `DEV=0`<br />

`npm install`

`npm run watch` for development process<br />
`npm run build` for building<br />

**Notes**
1. The compiled assets are automatically copied to package assets folder as ready to deploy..
2. While in development, the latest assets are always copied to public folder for real time experience..

