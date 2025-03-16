# Laravel API Documentation

## User Registration
**Endpoint:** `POST /api/register`

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
## Create Token (Login)
**Endpoint:** `POST /api/create-token`

**Request Parameters:**
```json
{
    "email": "mkl@gmail.com",
    "password": "Salman@123"
}
```

---
## Product Management
### Create Product
**Endpoint:** `POST /api/products`

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

### Get Single Product
**Endpoint:** `GET /api/products/{id}`

### Delete Product
**Endpoint:** `DELETE /api/products/{id}`

### Update Product
**Endpoint:** `PUT /api/products/{id}`

**Request Parameters:** (example)
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

### Get Single Order
**Endpoint:** `GET /api/purchase/{uuid}`

### Update Order Status
**Endpoint:** `PUT /api/purchase/status/{uuid}`

**Request Parameters:**
```json
{
    "status": "delivered"
}
```

