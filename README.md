# Symfony Test Project
This project is a simple testing system built with the Symfony framework that supports questions with fuzzy logic and multiple choice answers. The application allows users to answer a series of questions where multiple answers may be correct, and the system evaluates the correctness based on predefined combinations
## Prerequisites

- Docker
- Docker Compose
- Git
- Composer

## Installation and Setup

1. **Clone the repository**:

   ```bash
   git clone https://github.com/hovsk/test_system.git
   cd test_system
   ```

2. **Setup**:

   ```bash
   make setup 
   ```

    Command will 
   - create and start Docker containers,
   - update the `DATABASE_URL` in `.env` file,
   - run db migrations and start symfony server.

> Update your database credentials and edit the `.env` file if necessary.

## Testing

Run unit tests using PHPUnit:

```bash
php bin/phpunit
```
