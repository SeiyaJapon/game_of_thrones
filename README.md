# GOTCasting

GOTCasting is a PHP (Laravel) application that manages the casting of characters and actors for a fiction series. The project follows **DDD (Domain-Driven Design)** and **CQRS (Command Query Responsibility Segregation)** principles to maintain a clean, scalable, and decoupled architecture.

## Architecture

- **DDD:** The domain is carefully modeled, separating entities, value objects, domain services, and repositories.
- **CQRS:** Commands and queries are decoupled, allowing each part to be optimized and scaled independently.
- **Domain Events:** Relevant changes in the domain generate events that are propagated to other systems.

## Technologies

- **PHP (Laravel):** Main framework for the application.
- **PostgreSQL:** Relational database for primary storage.
- **Elasticsearch:** Search engine for fast and advanced queries.
- **RabbitMQ:** Messaging broker for asynchronous communication between services.

## Synchronization with Elasticsearch

Whenever a relevant change occurs in the domain (for example, linking a character to an actor), an event is published through **RabbitMQ**. A consumer processes these events and updates the indices in **Elasticsearch** to keep the information synchronized and available for efficient searches.

## Installation

1. Clone the repository.
2. Install dependencies with Composer and npm.
3. Configure environment variables for PostgreSQL, Elasticsearch, and RabbitMQ.
4. Run migrations and seeders.

## Useful scripts

- `php artisan migrate`
- `php artisan db:seed`
- `npm install && npm run dev`

## Contributing

Contributions are welcome. Please follow the architecture and best practices established in the project.

## License

MIT