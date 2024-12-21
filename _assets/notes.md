Using statamic

# sign up (register)

we could use this to register a user 
https://statamic.dev/tags/user-register_form


we want to point to a controller that will handle the registration process

1. create a controller
1.1 
    it needs to be able to create a user
    




square
- square_id
- subscription_id

array.com
- array_id
- array_token

ghl
- add user to go high level with email and name, text





# Task Breakdown

| **Task Name**                                      | **Description**                                                                                 | **Help Notes**                                                                                      |
| -------------------------------------------------- | ----------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- |
| **Set up Square API integration for user sign-up** | Implement logic in the sign-up controller to create a Square user and store their ID and token. | Use the Square API to create a customer upon successful registration. Validate and store securely.  |
| **Set up Array.com user on sign-up**               | Integrate Array.com API to create a user during sign-up and store their ID and token.           | Ensure API credentials and responses are managed securely. Use Laravel's HTTP client for requests.  |
| **Set up Go High Level user on sign-up**           | Add integration to create a user in Go High Level after a successful sign-up.                   | Refer to Go High Level's API docs for user creation. Plan for error handling and token storage.     |
| **Deploy Laravel Statamic app on Forge server**    | Complete deployment of the Statamic app to the Forge server and confirm functionality.          | Ensure `.env` is configured for production. Use `php artisan config:cache` for optimal performance. |
| **Point domain to the Forge server**               | Update DNS records for `goal850.com` to point to your new server IP.                            | Use your domain registrar’s DNS settings to add an A record pointing to the Forge server's IP.      |
| **Prepare for potential database migrations**      | Ensure database migrations can be run or adapted within the Statamic structure.                 | Plan migrations to handle new user data for Square, Array.com, and Go High Level integrations.      |

---
 