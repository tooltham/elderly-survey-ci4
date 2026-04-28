# Project Blueprint: Elderly Survey

## 1. Metadata
- **Project Name:** Elderly Survey
- **Slug:** `elderly-survey`
- **Category:** Web / Research
- **Status:** Active (Maintenance/Refactoring)
- **Port Assignment:** 3001
- **Domain:** `elderly-survey-app.orb.local` (OrbStack) / `elderly-survey.test` (Proxy)

## 2. Tech Stack
- **Framework:** CodeIgniter 4.x (PHP 8.1+)
- **Runtime:** PHP 8.3 Apache (Pulsar Optimized)
- **Database:** MariaDB 11
- **Frontend:** HTML/CSS (Bootstrap/Vanilla)

## 3. Infrastructure (Pulsar Standard)
- **Network:** `production-network` (external)
- **Deployment:** Docker Compose
- **Monitoring:** (Future) Integration with Global InfluxDB

## 4. Port Mapping
| Host Port | Container Port | Service |
| :--- | :--- | :--- |
| 3001 | 80 | Web Server (Apache) |
| 3307 | 3306 | MariaDB (Project Local) |

## 5. Environment Variables (.env)
- `database.default.hostname`: `db`
- `database.default.database`: `elderly_survey`
- `app.baseURL`: `http://elderly-survey-app.orb.local/`
