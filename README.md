## How To Install

- clone this repo
- create an empty database.
- Create `.env` and change the database connection configuration.
- Run `composer install` to install dependencies.
- Run `php artisan migrate:fresh --seed`


## Functionalities and how to use API Endpoints

- For a given Special Offer and an expiration date generate for each Recipient a Voucher Code.

  Sample **POST** API for testing this functionality. 

    `http://voucherpool.test/api/codes/generate?offer_name=<offer-name>&discount=<discount>&expiry=<expiry>`

- Provide an endpoint, reachable via HTTP, which receives a Voucher Code and Email and validates
  the Voucher Code. In Case it is valid, return the Percentage Discount and set the date of usage.
  
  Sample **POST** API for testing this functionality. 

    `http://voucherpool.test/api/codes/activate/?email=<email>&code=<code>`
    
 - Extra: For a given Email, return all his valid Voucher Codes with the Name of the Special Offer.
    
   Sample **GET** API for testing this functionality. 
    
      `http://voucherpool.test/api/codes/<email>`
      
  
