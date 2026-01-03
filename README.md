# Laravel Professional Blog API

A comprehensive RESTful API for a professional blog built with Laravel 12, featuring advanced functionality including user authentication, content management, commenting system, and admin panel.

## Features

### Core Functionality
- **User Authentication**: Laravel Sanctum token-based authentication
- **Role-Based Access Control**: Admin, Editor, Author roles with permissions
- **Post Management**: Full CRUD operations with draft/publish status
- **Category System**: Organize posts with multiple categories
- **Comment System**: Nested replies with moderation
- **Search Functionality**: Full-text search across posts
- **File Uploads**: Featured images for posts
- **API Versioning**: v1 API with proper versioning

### Advanced Features
- **Pagination**: Efficient data pagination on all endpoints
- **Rate Limiting**: API rate limiting for security
- **SEO-Friendly**: Slugs, meta fields, published dates
- **Content Moderation**: Admin approval for comments
- **Statistics Dashboard**: Admin panel with blog statistics

## API Endpoints

### Authentication
```
POST   /api/v1/register  - User registration
POST   /api/v1/login     - User login
POST   /api/v1/logout    - User logout (requires auth)
GET    /api/v1/user      - Get authenticated user (requires auth)
```

### Posts
```
GET    /api/v1/posts                     - List published posts
GET    /api/v1/posts/{id}                - Get single post
GET    /api/v1/posts/search/{query}      - Search posts
POST   /api/v1/posts                     - Create post (requires auth)
PUT    /api/v1/posts/{id}                - Update post (requires auth, owner only)
DELETE /api/v1/posts/{id}                - Delete post (requires auth, owner only)
```

### Categories
```
GET    /api/v1/categories                - List all categories
GET    /api/v1/categories/{id}           - Get category with posts
POST   /api/v1/categories                - Create category (requires auth)
PUT    /api/v1/categories/{id}           - Update category (requires auth)
DELETE /api/v1/categories/{id}           - Delete category (requires auth)
```

### Comments
```
GET    /api/v1/posts/{post}/comments     - Get post comments
GET    /api/v1/comments/{comment}/replies - Get comment replies
POST   /api/v1/comments                  - Create comment (requires auth)
PUT    /api/v1/comments/{id}             - Update comment (requires auth, owner only)
DELETE /api/v1/comments/{id}             - Delete comment (requires auth, owner only)
```

### Admin Panel
```
GET    /api/v1/admin/stats                          - Get blog statistics
POST   /api/v1/admin/posts/{id}/publish             - Publish post
POST   /api/v1/admin/posts/{id}/unpublish           - Unpublish post
POST   /api/v1/admin/comments/{id}/approve          - Approve comment
DELETE /api/v1/admin/comments/{id}                  - Delete comment (admin)
```

## Installation

1. **Clone the repository**
```bash
git clone <repository-url>
cd blog-api
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database configuration**
```bash
# Configure your database in .env file
php artisan migrate
php artisan db:seed
```

5. **Storage link for file uploads**
```bash
php artisan storage:link
```

6. **Start the development server**
```bash
php artisan serve
```

## Database Seeding

The application includes comprehensive seeders that create:
- Admin, Editor, and Author roles with appropriate permissions
- Sample categories (Technology, Web Development, etc.)
- Sample posts with random content and category assignments
- Test user accounts

Run seeders with:
```bash
php artisan db:seed
```

## Authentication

### Token-Based Authentication
- Register/Login to receive an API token
- Include the token in Authorization header: `Bearer {token}`
- Use Sanctum middleware for protected routes

### Admin Access
- Admin email: `admin@example.com` (created by seeders)
- Login as admin to access admin-only endpoints

## Frontend Integration

### Recommended Tech Stack
- **React/Vue.js SPA**: For dynamic blog interface
- **Next.js**: For SEO-optimized blog pages
- **Mobile Apps**: Direct API consumption

### Example API Usage

```javascript
// Login
const response = await fetch('/api/v1/login', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    email: 'user@example.com',
    password: 'password'
  })
});

const { token } = await response.json();

// Use token for authenticated requests
const posts = await fetch('/api/v1/posts', {
  headers: {
    'Authorization': `Bearer ${token}`,
    'Accept': 'application/json'
  }
});
```

## Security Features

- **Rate Limiting**: Prevents API abuse
- **Input Validation**: Comprehensive validation on all endpoints
- **Authorization**: Role-based permissions
- **CORS Protection**: Configured for API safety
- **Token Expiration**: Secure token management

## Development

### Code Quality
- PSR-12 coding standards
- Comprehensive test coverage recommended
- API documentation with OpenAPI/Swagger

### Testing
```bash
php artisan test
```

### API Documentation
Consider using Laravel API Resource for consistent responses or tools like:
- Scribe (Laravel package for API documentation)
- Postman collections for testing

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License.
