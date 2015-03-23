DonateTo: Easy Stripe Payment Page System
=========================================

`DonateTo` is an easy-to-configure basic system for collecting payments using [Stripe](http://www.stripe.com/)

Licence
-------

Simply stated:

* You may use DonateTo to collect your own personal/small-business payments without owing any royalty to Quinn Ebert.
* You may NOT use DonateTo (or derivatives) in a large business or enterprise setting without arranging a licence agreement with Quinn Ebert.
* You may NOT misrepresent DonateTo as being your own code, fork the repository to a private repository, or otherwise conceal DonateTo or works derived therefrom from the general public without arranging a licence agreement with Quinn Ebert.

Setup
-----

1. Upload to your webserver
2. Put Stripe keys in `config.php`
3. Edit `$details` atop `index.php`
4. Link to `index.php`
5. Profit(???)

Tips and Tricks
---------------

**Just one for now:** when configuring `$details` atop `index.php` you can set the value for `amount` to either a number of cents/pence/whatever or to the word `select` -- if you use `select` the user can enter their own payment amount (great for *real* donation drives!)

Future Plans
------------

* **Primarily:** allow the system to (officially, anyway) support payments for more than one thing.
