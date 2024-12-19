# User Schema for Credit Repair Site

## User

| Field Name             | Data Type | Description                             |
| ---------------------- | --------- | --------------------------------------- |
| id                     | UUID      | Unique identifier for the user          |
| first_name             | String    | User's first name                       |
| last_name              | String    | User's last name                        |
| email                  | String    | User's email address                    |
| password               | String    | User's password (hashed)                |
| phone_number           | String    | User's phone number                     |
| address                | String    | User's physical address                 |
| date_of_birth          | Date      | User's date of birth                    |
| created_at             | DateTime  | Timestamp of user creation              |
| updated_at             | DateTime  | Timestamp of last update                |
| credit_score           | Integer   | User's current credit score             |
| status                 | String    | User's account status (active/inactive) |
| square_subscription_id | UUID      | User's Square subscription ID           |
| array_user_id          | UUID      | User's Array ID                         |
| array_user_token       | String    | User's Array token                      |

### Example

```json
{
    "id": "123e4567-e89b-12d3-a456-426614174000",
    "first_name": "John",
    "last_name": "Doe",
    "email": "john.doe@example.com",
    "password": "hashed_password",
    "phone_number": "+1234567890",
    "address": "123 Main St, Anytown, USA",
    "date_of_birth": "1980-01-01",
    "created_at": "2023-01-01T12:00:00Z",
    "updated_at": "2023-01-01T12:00:00Z",
    "credit_score": 700,
    "status": "active"
}
```

## Blog (articles)

| Field Name | Data Type | Description                            |
| ---------- | --------- | -------------------------------------- |
| id         | UUID      | Unique identifier for the blog article |
| title      | String    | Title of the blog article              |
| content    | Text      | Content of the blog article            |
| author_id  | UUID      | Unique identifier for the author       |
| created_at | DateTime  | Timestamp of article creation          |
| updated_at | DateTime  | Timestamp of last update               |
| status     | String    | Publication status (published/draft)   |

```json
{
    "id": "123e4567-e89b-12d3-a456-426614174000",
    "title": "How to Improve Your Credit Score",
    "content": "Lorem ipsum dolor sit amet, consectetur adipiscing elit...",
    "author_id": "123e4567-e89b-12d3-a456-426614174001",
    "created_at": "2023-01-01T12:00:00Z",
    "updated_at": "2023-01-01T12:00:00Z",
    "status": "published"
}
```

## Comment

| Field Name | Data Type | Description                            |
| ---------- | --------- | -------------------------------------- |
| id         | UUID      | Unique identifier for the comment      |
| user_id    | UUID      | Unique identifier for the user         |
| article_id | UUID      | Unique identifier for the blog article |
| content    | Text      | Content of the comment                 |
| created_at | DateTime  | Timestamp of comment creation          |
| updated_at | DateTime  | Timestamp of last update               |

```json
{
    "id": "123e4567-e89b-12d3-a456-426614174000",
    "user_id": "123e4567-e89b-12d3-a456-426614174001",
    "article_id": "123e4567-e89b-12d3-a456-426614174002",
    "content": "Great article! Thanks for sharing.",
    "created_at": "2023-01-01T12:00:00Z",
    "updated_at": "2023-01-01T12:00:00Z"
}
```

## Subscription

| Field Name | Data Type | Description                                 |
| ---------- | --------- | ------------------------------------------- |
| id         | UUID      | Unique identifier for the subscription      |
| user_id    | UUID      | Unique identifier for the user              |
| plan_id    | UUID      | Unique identifier for the subscription plan |
| status     | String    | Subscription status (active/inactive)       |
| created_at | DateTime  | Timestamp of subscription creation          |
| updated_at | DateTime  | Timestamp of last update                    |

```json
{
    "id": "123e4567-e89b-12d3-a456-426614174000",
    "user_id": "123e4567-e89b-12d3-a456-426614174001",
    "plan_id": "123e4567-e89b-12d3-a456-426614174002",
    "status": "active",
    "created_at": "2023-01-01T12:00:00Z",
    "updated_at": "2023-01-01T12:00:00Z"
}
```

## Subscription Plan

| Field Name | Data Type | Description                            |
| ---------- | --------- | -------------------------------------- |
| id         | UUID      | Unique identifier for the subscription |
| name       | String    | Name of the subscription plan          |
| price      | Decimal   | Price of the subscription plan         |
| interval   | String    | Billing interval (month/year)          |
| created_at | DateTime  | Timestamp of plan creation             |
| updated_at | DateTime  | Timestamp of last update               |

```json
{
    "id": "123e4567-e89b-12d3-a456-426614174000",
    "name": "Basic Plan",
    "price": 19.99,
    "interval": "month",
    "created_at": "2023-01-01T12:00:00Z",
    "updated_at": "2023-01-01T12:00:00Z"
}
```

## User Subscription

| Field Name      | Data Type | Description                             |
| --------------- | --------- | --------------------------------------- |
| id              | UUID      | Unique identifier for the user          |
| user_id         | UUID      | Unique identifier for the user          |
| subscription_id | UUID      | Unique identifier for the subscription  |
| status          | String    | Subscription status (active/inactive)   |
| created_at      | DateTime  | Timestamp of user subscription creation |
| updated_at      | DateTime  | Timestamp of last update                |

```json
{
    "id": "123e4567-e89b-12d3-a456-426614174000",
    "user_id": "123e4567-e89b-12d3-a456-426614174001",
    "subscription_id": "123e4567-e89b-12d3-a456-426614174002",
    "status": "active",
    "created_at": "2023-01-01T12:00:00Z",
    "updated_at": "2023-01-01T12:00:00Z"
}
```

