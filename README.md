# Laravel API Documentation

## Authentication  
All API requests (except registration and login) require a Bearer token for authentication.  
Include the following header in your requests:  
```
Authorization: Bearer your_generated_bearer_token
```

---

## User Registration (No Token Required)  
**Endpoint:** `POST /api/register`  
**Request Headers:**  
- `Content-Type: application/json`  

**Request Parameters:**  
```json
{
    "name": "Mohtadin",
    "email": "mkl@gmail.com",
    "password": "Salman@123",
    "password_confirmation": "Salman@123"
}
```

---

## Create Token (Login) (No Token Required)  
**Endpoint:** `POST /api/create-token`  
**Request Headers:**  
- `Content-Type: application/json`  

**Request Parameters:**  
```json
{
    "email": "mkl@gmail.com",
    "password": "Salman@123"
}
```

**Response:**  
```json
{
    "token": "your_generated_bearer_token"
}
```

---

## Product Management  
### Create Product  
**Endpoint:** `POST /api/products`  
**Request Headers:**  
- `Authorization: Bearer your_generated_bearer_token`  
- `Content-Type: application/json`  

**Request Parameters:**  
```json
{
    "name": "Product A",
    "description": "This is a product description.",
    "price": 100,
    "stock_quantity": 50,
    "category": "Electronics",
    "image_url": "https://example.com/image.jpg"
}
```

### Get All Products (Paginated)  
**Endpoint:** `GET /api/products`  
**Request Headers:**  
- `Authorization: Bearer your_generated_bearer_token`

### Get Single Product  
**Endpoint:** `GET /api/products/{id}`  
**Request Headers:**  
- `Authorization: Bearer your_generated_bearer_token`

### Delete Product  
**Endpoint:** `DELETE /api/products/{id}`  
**Request Headers:**  
- `Authorization: Bearer your_generated_bearer_token`

### Update Product  
**Endpoint:** `PUT /api/products/{id}`  
**Request Headers:**  
- `Authorization: Bearer your_generated_bearer_token`  
- `Content-Type: application/json`  

**Request Parameters:**  
```json
{
    "name": "Updated Product Name",
    "description": "Updated description.",
    "price": 120,
    "stock_quantity": 40,
    "category": "Updated Category",
    "image_url": "https://example.com/updated-image.jpg"
}
```

---

## Order Management  
### Create Order  
**Endpoint:** `POST /api/purchase`  
**Request Headers:**  
- `Authorization: Bearer your_generated_bearer_token`  
- `Content-Type: application/json`  

**Request Parameters:**  
```json
{
    "name": "John Doe2",
    "email": "johndoe2@example.com",
    "shipping_address": "123 Main St, Springfield, IL 62701",
    "product_id": 2,
    "payments": 200,
    "payment_status": "completed",
    "payment_mode": "credit_card",
    "quantity": 2,
    "status": "pending"
}
```

### Get All Orders  
**Endpoint:** `GET /api/purchase/all`  
**Request Headers:**  
- `Authorization: Bearer your_generated_bearer_token`

### Get Single Order  
**Endpoint:** `GET /api/purchase/{uuid}`  
**Request Headers:**  
- `Authorization: Bearer your_generated_bearer_token`

### Update Order Status  
**Endpoint:** `PUT /api/purchase/status/{uuid}`  
**Request Headers:**  
- `Authorization: Bearer your_generated_bearer_token`  
- `Content-Type: application/json`  

**Request Parameters:**  
```json
{
    "status": "delivered"
}
```

---

This documentation ensures that all API endpoints (except registration and login) require a valid Bearer token for authentication.  
Replace `your_generated_bearer_token` with the actual token received upon login.
