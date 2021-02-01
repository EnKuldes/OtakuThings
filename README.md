Stack - Clean Responsive Bootstrap 4 Admin Dashboard Template Slicing to Laravel 7.

Requirements:
<ul>
	<li>PHP ^7.2.5</li>
    <li>Composer</li>
</ul>

Installation:
<ol>
	<li>Download and Extract/Clone this repository</li>
	<li>Open your terminal and go to the location of extracted/clone repository folder. Then run following commands without quotes:
		<ul>
			<li>"composer install". Its used to install package such as Laravel 7 and othe packages that included in here</li>
			<li>"cp .env.example .env". Its to copy the current enviroment default value (.env.example) to new enviroment (.env) which will be used for this app</li>
			<li>"php artisan key:generate". its used to generate key app</li>
			<li>"php artisan migrate:refresh --seed", its used to generate default tables to be used on this app with default seeder. Its also can run later after you create another migrations/models.</li>
		</ul>
	</li>
	<li>Open .env file that created from before and edit it with the current enviroment you want to use</li>
	<li>To run this app you can run "php artisan serve" which will make Laravel create own apache server on port 8000 (defaultly) or you can assign it using VHost.</li>
</ol>

Included Package:
<ul>
	<li>guzzlehttp/guzzle</li>
	<li>maatwebsite/excel</li>
	<li>yajra/laravel-datatables-oracle</li>
</ul>

Enviroment App Helper:
<ul>
	<li>
		APP_NAVBAR_COLOR; To change the colour scheme on Navbar. Current Existing value like: 
		<ul>
			<li>bg-blue-grey</li>
			<li>bg-primary</li>
			<li>bg-danger</li>
			<li>bg-success</li>
			<li>bg-blue</li>
			<li>bg-cyan</li>
			<li>bg-pink</li>
			<li>bg-gradient-x-blue-grey</li>
			<li>bg-gradient-x-primary</li>
			<li>bg-gradient-x-danger</li>
			<li>bg-gradient-x-success</li>
			<li>bg-gradient-x-blue</li>
			<li>bg-gradient-x-cyan</li>
			<li>bg-gradient-x-pink</li>
		</ul>
	</li>
	<li>
		APP_NAVBAR_THEME; To change the Theme Colour on Navbar. Current Existing value like: 
		<ul>
			<li>navbar-semi-light</li>
			<li>navbar-semi-dark</li>
			<li>navbar-dark</li>
			<li>navbar-light</li>
		</ul>
	</li>
	<li>
		APP_NAVIGATION_LAYOUT; To change the Layout Templates on Navigation. Current Existing value like: 
		<ul>
			<li>menu-native-scroll</li>
			<li>menu-icon-right</li>
			<li>menu-bordered</li>
		</ul>
	</li>
	<li>
		MENU_COLOR; To change the Color of Menu. Current Existing value like: 
		<ul>
			<li>menu-light</li>
			<li>menu-dark</li>
		</ul>
	</li>
</ul>

Future Implementation:
<ul>
	<li>Vertical RTL</li>
	<li>Horizontal Menu/Navbar</li>
</ul>
