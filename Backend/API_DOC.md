Middleware: UserVerification
Functionality:
Extracts the token from the cookie.
Validates the token using JWTToken::VerifyToken.
Dynamically sets all verified user data into request headers.
Example Data Set in Headers:
After token verification, the following dynamic headers may be set (based on token content):

email: User's email address.
id: User's unique ID.
role: User's role (e.g., admin, user).
Failure Cases:
Missing Token: Redirects to /user-login with an error data.
Invalid Token: Redirects to /user-login with an unauthorized error.

<<POST Routes

## 1. User Registration

Endpoint:
<POST /user-registration
Description:
Allows a new user to register in the system.

Request Body:

json
{
"name":"string",
"email":"string",
"phone":"string",
"address":"string",
"password":"string"
}

response()->json([
'status' => 'success',
'data' => 'User Registration Successful',
], 201)

**If Error**

response()->json([
'status' => 'error',
'data' => User Registration Failed,
], 400)

## 2. User Login

Endpoint:
<POST /user-login
Description:
Authenticates a user and issues a token.

Request Body:

json{
"email": "string",
"password": "string"
}

response()->json([
'status' => 'success',
'data' => 'User Login Successful',
], 200)

**If Error**

response()->json([
'status' => 'error',
'data' => 'User Login Failed',
], 401)

## 3. Send OTP Code

Endpoint:
<POST /send-otp
Description:
Sends a One-Time Password (OTP) to the user's email.

Request Body:

json
{
"email": "string"
}
response()->json([
'status' => 'success',
'data' => 'OTP Send Successfully',
], 200)

**If Error**

return response()->json([
'status' => 'error',
'data' => 'Email Not Valid',
], 404)

## 4. Verify OTP Code

Endpoint:
<POST /verify-otp
Description:
Validates the OTP sent to the user.

Request Body:

json
{
"email": "string",
"otp": "string"
}
response()->json([
'status' => 'success',
'data' => 'OTP Verify Successfully'
], 200)

**If Error**

response()->json([
'status' => 'error',
'data' => 'OTP Verify Failed',
], 400)

## 5. Reset Password

Endpoint:
<POST /reset-password
Middleware:
UserVerification - Ensures the token is valid and the user is authenticated.
Description:
Resets the user's password after verifying their identity.

Request Body:

json
{
"email": "string"<From Header>,
"password": "string"
}
response()->json([
'status'=> 'success',
'data'=> 'Password Reset Successfully'
],200)
**If Error**

response()->json([
'status'=> 'error',
'data'=> 'Password Reset Failed'
],403)

## 6. User Profile Update

Endpoint:
<POST /user-profile-update
Middleware:
UserVerification - Ensures the token is valid and the user is authenticated.
Description:
Updates the user's profile information.

Request Body:

json
 {
"name":"string",
"email":"string",
"phone":"string",
"address":"string",
"password":"string"
}

response()->json([
'status'=> 'success',
'data'=> 'User Information Updated'
],200)

**If Error**

response()->json([
'status'=> 'error',
'data'=> 'User Information Not Updated'
],500)

**_ Subscription Related Post Rout _**

## 7. Create Subscription

Endpoint:
<POST /user-subscription-create
Middleware:
UserVerification - Ensures the token is valid and the user is authenticated.
Description:
Creates a new subscription for the authenticated user.

Request Body:

json{
"name": "string",
"type": "string",
"fee": "number",
"due_date": "date",
"status": "string",
"payment_date": "date"
}
response()->json([
'status'=> 'success',
'data'=> 'Subscription Created'
],201)

**If Error**

response()->json([
'status'=> 'error',
'data'=> 'Subscription Not Created'
],500)

## 8. Update Subscription

Endpoint:
<POST /user-subscription-update
Middleware:
UserVerification - Ensures the token is valid and the user is authenticated.
Description:
Updates an existing subscription for the authenticated user.

Request Body:

json{
"id": "integer",
"name": "string",
"type": "string",
"fee": "number",
"due_date": "date",
"status": "string",
"payment_date": "date"+
}

response()->json([
'status'=> 'success',
'data'=> 'User Information Updated'
],201)

**If Error**

response()->json([
'status'=> 'error',
'data'=> 'Subscription Not Updated'
],500)

## 9. Delete Subscription

<POST /user-subscription-delete/{sub_id}
Description:
Deletes the user's subscription by ID.

Request Parameters:
    sub_id: Subscription ID to delete.

Request Body:

json{
"id": "integer"
}

response()->json([
'status'=> 'success',
'data'=> 'Subscription Deleted'
],200)

**If Error**

response()->json([
'status'=> 'error',
'data'=> 'Subscription Not Deleted'
],500)

<<GET Routes.

**_ User Auth Related Get Rout _**

## 1. User Logout

Endpoint:
<GET /user-logout
Description:
Logs out the authenticated user by invalidating the session or token.

Response:

return redirect('/') .

**_ User Profile Related Get Rout _**

## 2. Get User Profile

Endpoint:
<GET /user-profile-info
Middleware:
UserVerification - Ensures the token is valid and the user is authenticated.
Description:
Fetches the profile information of the authenticated user.

Responses:
**IF Success**
{
"status": "success",
"data": {
"name": "string",
"email": "string",
"phone": "string",
"address": "string"
}
}
**If Failed**
{
"status": "error",
"data": "Profile Information Not Found"
}

**_ Subscription Related Get Rout _**

## 3. Get All Subscriptions

Endpoint:
<GET /subscription-list
Middleware:
UserVerification - Ensures the token is valid and the user is authenticated.
Description:
Retrieves all subscriptions for the authenticated user.

Responses:

**If Success**
{
"status": "success",
"data": [
{
"id": "string",
"name": "string",
"type": "string",
"fee": "string",
"due_date": "string",
"user_id": "string",
"status": "string"
"payment_date": "string",
"created_at": "string",
"updated_at": "string",
"user": {
"id": "string",
"name": "string",
"email": "string",
"phone": "string",
"address": "string"
}
}
]
}

**If Failed**

{
"status":"error",
"data":"Profile Information Not Found"
}

## 3.Get Subscriptions By User or ID
Endpoint:
<GET /user-subscription-list
Middleware:
UserVerification - Ensures the token is valid and the user is authenticated.
Description:
Retrieves subscriptions for the user based on user ID or specific subscription ID.

Responses:

**If Success**

{
"status": "success",
"data": [
{
"id": "string",
"name": "string",
"type": "string",
"fee": "string",
"due_date": "string",
"user_id": "string",
"status": "string"
"payment_date": "string",
"created_at": "string",
"updated_at": "string",
"user": {
"id": "string",
"name": "string",
"email": "string",
}
}
]
}

**If Failed**

{
"status":"error",
"data":"Subscription Not Found"
}


<<DELETE Routes

**_ User Related Delete Rout _**

## 1. Delete User
Endpoint:
<DELETE /user-delete
Middleware:
UserVerification - Ensures the token is valid and the user is authenticated.
Description:
Deletes the authenticated user's account.

Request Body:
None

Responses:

**If Success**

{
  "status": "success",
  "data": "User Deleted"
}

**If Failed**

{
  "status": "error",
  "data": "User Not Found / User Not Deleted"
}

Endpoint:
<GET /api/v1/subscription-list-by-id/3
Description:
Get Single Subscriptions Get by id.

Response: Individual Subscription Data Only.

## Dashboard Routes

- **URI:** `/upcoming-subscription-list`
- **HTTP Method:** `GET`
- **Controller Method:** `DashboardController@UpcomingSubscriptionList`
- **Description:**
    Retrieves a list of upcoming subscriptions for the authenticated user.
- **Middleware Applied:** `user_verify`
- **Response:**
    A JSON object or view containing details of upcoming subscriptions.

---

- **URI:** `/Payment-missed`
- **HTTP Method:** `GET`
- **Controller Method:** `DashboardController@PaymentMissed`
- **Description:**
    Provides a list of missed payments for the authenticated user.
- **Middleware Applied:** `user_verify`
- **Response:**
    A JSON object or view detailing the payments that were missed, including reasons if applicable.

---

- **URI:** `/Month-wise-Count`
- **HTTP Method:** `GET`
- **Controller Method:** `DashboardController@MonthWiseCount`
- **Description:**
    Fetches a month-wise count of a specific resource (e.g., subscriptions, payments, or other relevant data).
- **Middleware Applied:** `user_verify`
- **Response:**
    A JSON object containing month-wise counts of data, typically in the format:
