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

## Installation

1.Install XAMPP
2.Go to XAMPP/htdocs
3.clone the project
4.run XAMPP control panel
5.launch apache and mysql
## Usage
launch the project by going to localhost/wallet/

## API documentation

user APIs are routed to :
`localhost/wallet/user/api?action=$`
admin APIs are routed to :
`localhost/wallet/admin/api?action=$`

## User APIs

## 1-Register
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

## 2-login
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
- **Body**: {message:`Account created successfully`,data:{session_id:3456}}

## 3-login
**Endpoint**: `localhost/wallet/user/api?action=checkVerified`

**Method**: `POST`

**Description**: Sends credentials and returns 0 for unverified 1 for verified and 2 for pending.

**Request**:
{
    "email" = "johndoe@gmail.com",
    OR
    "phone_number" :"1234",
    "pass" :"password",
}
**Response**:
- **Status**: `200 OK`
- **Body**: {message:`Account created successfully`,data:{session_id:3456}}





