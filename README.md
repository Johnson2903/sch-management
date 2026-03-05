# Project Overview
This project is a student management system that allows educational institutions to manage student records efficiently and effectively.

## Installation Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/Johnson2903/sch-management.git
   ```
2. Navigate to the project directory:
   ```bash
   cd sch-management
   ```
3. Install the required dependencies:
   ```bash
   npm install
   ```

## Tech Stack
- **Frontend:** React.js
- **Backend:** Node.js with Express
- **Database:** MongoDB
- **Others:** JWT for authentication, Axios for API calls

## File Structure
```
├── client               # Frontend code
│   ├── src
│   └── public
├── server               # Backend code
│   ├── controllers
│   └── models
├── package.json         # Project metadata
└── README.md            # Documentation
```

## Deployment Guide
To deploy this project:
1. Ensure that you have Docker installed.
2. Build the Docker image:
   ```bash
   docker build -t sch-management .
   ```
3. Run the Docker container:
   ```bash
   docker run -p 3000:3000 sch-management
   ```

## Troubleshooting
- **Issue:** Server not starting
  - **Solution:** Check if the database service is running.

- **Issue:** API calls are failing
  - **Solution:** Ensure that the backend is running and the correct API URL is being used.

## Development Guidelines
- Follow the coding standards outlined in the project.
- Write clear commit messages.
- When adding new features, ensure to include tests.
- Document your code adequately.

## License
This project is licensed under the MIT License. 
