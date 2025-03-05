# Bobnance

This is a digital wallet designed and built for high security transfers and online payments.

# Key Features
Account Creation: user can create his own account using either his email or his phone number .
Profile Management: user can edit his personal details after creating his account .
Identity Verification: user can verify his identity in order to be able to make payments .
Internal Transfers: user can make instant peer-to-peer payments.
Transaction History & Statements: user can track transactions made towards or from his cards.
Live Chat & Ticketing:user have 24/7 live support . 
Account Limits:user have limits on daily transactions to prevent unauthorized users from moving huge amount of funds,the goal behind this application is only to make small/medium payments not moving huge assets.

For admin:
Analytics Dashboard:admins will have access to important analytics such as popular card types and top locations.

# Installation

1.Install XAMPP
2.Go to XAMPP/htdocs
3.clone the project
4.run XAMPP control panel
5.launch apache and mysql
# Usage
launch the project by going to localhost/wallet/

# ER Diagram
![My Image](/ER.PNG)


# API documentation

user APIs are routed to :
`localhost/wallet/user/api?action=$`
admin APIs are routed to :
`localhost/wallet/admin/api?action=$`

## User APIs

### 1-Register
**Endpoint**: `localhost/wallet/user/api?action=register`

**Method**: `POST`

**Description**: Creates a new row in users table

**Request**:
{
    "first_name" :"john",
    "last_name" :"doe",
    "username" : "john123",
    "email" = "johndoe@gmail.com",
    "phone_number" :"1234",
    "pass" :"password",
    "currency" :"dollar"
}
**Response**:
- **Status**: `200 OK`
- **Body**: message:`Account created successfully`

### 2-login
**Endpoint**: `localhost/wallet/user/api?action=login`

**Method**: `POST`

**Description**: Sends credentials and returns session_id.

**Request**:
{
    "email" = "johndoe@gmail.com",
    OR
    "phone_number" :"1234",
    "pass" :"password",
}
**Response**:
- **Status**: `200 OK`
- **Body**: {data:{message:`Account created successfully`,data:{session_id:3456}}}


### 3-checkVerified
**Endpoint**: `localhost/wallet/user/api?action=checkVerified`

**Method**: `POST`

**Description**: checks wether the user if verified or not. Return 0 for unverified, 1  for verified and 2 for pending verification .
**Request**:
{
    "session_id" = "23432",
    
}
**Response**:
- **Status**: `200 OK`
- **Body**: {data:{is_verified:"1"}}

### 4-getCards
**Endpoint**: `localhost/wallet/user/api?action=getCards`

**Method**: `POST`

**Description**: returns a list of all cards owned by the user .
**Request**:
{
    "session_id" = "23432",
    
}
**Response**:
- **Status**: `200 OK`
- **Body**: {
    data:{
        message:"user id found",
        data:{
            id:242,
            balance:3000,
            wallet_id:456,
            brand:master,
            created at:2025-03-05 12:53:01
        }
}}
### 5-getTransactions
<!-- **Endpoint**: `localhost/wallet/user/api?action=getTransactions`

**Method**: `POST`

**Description**: returns a list of all transactions made by the user .
**Request**:
{
    "session_id" = "23432",
    
}
**Response**:
- **Status**: `200 OK`
- **Body**: {
    data:{
        message:"user id found",
        data:{
            id:242,
            balance:3000,
            wallet_id:456,
            brand:master,
            created at:2025-03-05 12:53:01
        }
}} -->
### 6-getUserInfo
**Endpoint**: `localhost/wallet/user/api?action=getUserInfo`

**Method**: `POST`

**Description**: returns user informations .
**Request**:
{
    "session_id" = "23432",
}
**Response**:
- **Status**: `200 OK`
- **Body**: {
    data:{
        message:"user found",
        data:{
            first_name:john,
            last_name:Doe,
            wallet_id:456,
            address_id:66343,
            created at:2025-03-05 12:53:01,
            type:client,
            phone_number:123412,
            email:johndoe@gmail.com,
        }
}}
### 7-updateUserInfo
**Endpoint**: `localhost/wallet/user/api?action=updateUserInfo`

**Method**: `POST`

**Description**: updates user details .
**Request**:
{
            id:234,
            first_name:john,
            last_name:Doe,
            wallet_id:456,
            address_id:66343,
            created at:2025-03-05 12:53:01,
            type:client,
            phone_number:123412,
            email:johndoe@gmail.com,
}
**Response**:
- **Status**: `200 OK`
- **Body**: {
    data:{
        message:"updated successfully",
        
}}
### 8-transfer
**Endpoint**: `localhost/wallet/user/api?action=transfer`

**Method**: `POST`

**Description**: Makes peer to peer transfers .
**Request**:
{
           sender_id:34,
           receiver_id:346,
           amount:500
}
**Response**:
- **Status**: `200 OK`
- **Body**: {
    data:{
        message:"transaction added successfully",
        
}}

## Admin APIs
### 1-getCards
**Endpoint**: `localhost/wallet/admin/api?action=getCards`

**Method**: `GET`

**Description**: makes aggregation for each card type and the amount of row of that type .
**Request**:
{
           
}
**Response**:
- **Status**: `200 OK`
- **Body**: {
    data:{
        debit:5,
        credit:9
        
}}
### 2-getLocations
**Endpoint**: `localhost/wallet/admin/api?action=getLocations`

**Method**: `GET`

**Description**: makes aggregation for each country and the amount of row of that country .
**Request**:
{
           
}
**Response**:
- **Status**: `200 OK`
- **Body**: {
    data:{
        Lebanon:5,
        Canada:9
        
}}





