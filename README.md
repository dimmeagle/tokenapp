# TokenApp

The TokenApp introduces the following functions for the test app:

## Console
- Getting auth token for user via `get_token` command
The command requests username and password for authentication.
The auth token is returned.
Run command:
```
php artisan get_token
```

## Frontend
- Adding new records via `data` form link
The link is available for requests with Authorization header containing the auth token from console command.
The form contains one field with JSON validation.
The submit button stores the data and returns the user to the `data` form with message containing additional information on the process: record ID, time and memory usage. 

## Backend
- Getting the list of records via `records` link
The page contains the table-style list of records from the database with actions "Edit" and "Delete" available.

----
# Important notes
The app utilizes Vite pre-processing capabilities, so it is advised to run
```
npm run dev 
```
from the project directory.

