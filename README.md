# 🛡️ Game of Thrones - RESTful Casting API

## ✏️ A Backend Challenge Where You Win or You Die (Deploying)

---

## 📖 Introduction
This project is part of a backend recruitment test. The goal was to implement a RESTful API for managing actors and characters from the Game of Thrones universe, based on a provided JSON dataset.

But here’s the twist: no lazy magic, no out-of-the-box frameworks doing the job with annotations and dragons 🐉 — just honest code, events, queues, and databases. Like the Old Gods intended.

---

## 🛠️ Stack Used

- ✅ **Laravel** (Because PHP deserves redemption)
- 🏛️ **Domain-Driven Design (DDD)**
- 🪓 **CQRS** (Command Query Responsibility Segregation, not a random acronym from Valyria)
- 📡 **RabbitMQ** (for messaging between the Realms)
- 🔍 **Elasticsearch** (for fast searches, because Ravens are slow)
- 🐘 **PostgreSQL** (our persistent Maester library)
- 🐳 **Docker + Docker Compose** (All the kingdoms in one config)

---

## 🧩 Architecture

- All **writes** (Create, Update, Delete) go to **PostgreSQL**.
- All **reads** (Search, List, Get by ID) go to **Elasticsearch**.
- Events like `CharacterCreated`, `ActorUpdated`, etc., are emitted via **RabbitMQ**, and consumers handle Elasticsearch sync.

---

## ❗ Note about CQRS consistency
To keep it simple (and humanly testable), the system doesn't wait for Elasticsearch confirmation before allowing reads.
In a more robust setup, you’d emit a "sync-complete" event after Elasticsearch updates and wait for it before reading.
But hey, this is a test, not a siege of Winterfell.

---

## 🧪 Testing

Unit tests cover the application and domain logic.

Integration tests check the full flow: DB ↔ Queue ↔ Search.

Use:
```bash
make test
```
to unleash the tests. May your assertions pass and your mocks behave.

---

## 🚀 Setup Instructions

### 📦 Step 1: Unpack the Realm
Unzip the project folder you’ve received. Inside lies the fate of Westeros.

### 🐳 Step 2: Build the Seven Kingdoms
```bash
make create-network
make up
```

### 🏗️ Step 3: Setup the Citadel
To run migrations:
```bash
make migrate
```
If you want to seed the database with the Game of Thrones characters:
```bash
make fresh-seed
```

### 🔔 Step 4: Call the Ravens (start the consumers)
```bash
make consumer
```
They will listen to changes and update Elasticsearch faster than Varys’ little birds.

### 🧪 Step 5: Testing the Realm
```bash
make test
```
All your services must pass... or be sent to the Wall.

---

## 📡 API Endpoints Summary

### 🎭 Actors
- `POST /actors` – Add actor
- `GET /actors/{id}` – Get actor by ID
- `PUT /actors/{id}` – Update actor
- `DELETE /actors/{id}` – Delete actor
- `GET /actors` – List all
- `GET /actors/search?q=tyrion` – Search by query

### 🧝 Characters
- `POST /characters` – Add character
- `GET /characters/{id}` – Get character by ID
- `PUT /characters/{id}` – Update character
- `DELETE /characters/{id}` – Delete character
- `GET /characters` – List all
- `GET /characters/search?q=stark` – Search by query

### ⛓️ Linking
- `POST /characters/{characterId}/link-to-actor/{actorId}` – Assign an actor to a character (No magic, just plain drama)

---

## 💡 Notes & Easter Eggs

- All IDs are UUIDs. We don't trust sequential numbers — they might be White Walkers in disguise.
- The code is structured in Bounded Contexts (like Houses in Westeros). Check `GOTCastingContext`.
- Queries and Commands are handled separately, as prophesied by the CQRS Lord Commander.
- Events are dispatched manually — no unsullied frameworks doing it for us.

---

## 📜 Final Thoughts
This test isn't just about delivering a working API. It's about showing how you'd handle real-world challenges like sync, architecture, and not turning your app into a Red Wedding.

Hope you enjoy reviewing this project as much as I enjoyed building it. If anything breaks, just remember: The night is dark and full of bugs.

---

## 🧙 Credits
Developed by **SeiyaJapon** — who definitely doesn't want to rule the Iron Throne, just push good code to production.