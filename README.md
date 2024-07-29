# Ride-Share Project

## Project Overview

The Ride-Share project is a web application designed to facilitate shared rides between drivers and passengers. The application allows users to register as either a driver or a passenger and create, accept, start, and complete trips. The project uses Laravel for the backend and Vue.js for the frontend.

## Features

### User Management

- **Registration and Login**: Users can register and log in using their phone numbers.
- **Authentication**: Secure authentication using Laravel Sanctum.
- **User Profiles**: Users can update their profile information.

### Driver Management

- **Driver Profiles**: Drivers can create and update their profiles, including details about their vehicle.
- **Driver Trips**: Drivers can view and manage their trips.

### Trip Management

- **Create Trip**: Passengers can create a new trip by specifying start and end locations and the destination name.
- **Accept Trip**: Drivers can accept available trips.
- **Start Trip**: Drivers can mark a trip as started.
- **End Trip**: Drivers can mark a trip as completed.
- **Update Location**: Drivers can update their current location during a trip.

### Notifications

- **Real-time Updates**: Passengers and drivers receive real-time updates about the trip status and location using events and notifications.

## API Endpoints

### Authentication

- `POST /login`: User login.
- `POST /login/verify`: Verify login code.

### Driver Endpoints

- `GET /driver`: Get the logged-in driver's profile.
- `POST /driver`: Update the logged-in driver's profile.

### Trip Endpoints

- `GET /trip/{trip}`: Get details of a specific trip.
- `POST /trip`: Create a new trip.
- `POST /trip/{trip}/accept`: Accept a trip.
- `POST /trip/{trip}/start`: Start a trip.
- `POST /trip/{trip}/end`: End a trip.
- `POST /trip/{trip}/location`: Update the driver's location for a trip.

### User Endpoint

- `GET /user`: Get the logged-in user's profile.

## Database Schema

### Users Table

- `id`: Primary key.
- `name`: User's name.
- `phone`: User's phone number (unique).
- `login_code`: Code for login verification.
- `remember_token`: Token for session management.
- `created_at`: Timestamp when the user was created.
- `updated_at`: Timestamp when the user was last updated.

### Drivers Table

- `id`: Primary key.
- `user_id`: Foreign key to the users table.
- `year`: Vehicle year.
- `make`: Vehicle make.
- `model`: Vehicle model.
- `color`: Vehicle color.
- `license_plate`: Vehicle license plate.
- `created_at`: Timestamp when the driver profile was created.
- `updated_at`: Timestamp when the driver profile was last updated.

### Trips Table

- `id`: Primary key.
- `user_id`: Foreign key to the users table (passenger).
- `driver_id`: Foreign key to the drivers table.
- `is_started`: Boolean indicating if the trip has started.
- `is_completed`: Boolean indicating if the trip has completed.
- `start_location`: JSON containing the starting location.
- `end_location`: JSON containing the ending location.
- `destination_name`: Name of the destination.
- `driver_location`: JSON containing the driver's current location.
- `created_at`: Timestamp when the trip was created.
- `updated_at`: Timestamp when the trip was last updated.

## Installation and Setup

1. **Clone the repository**:
    ```bash
    git clone <repository-url>
    cd ride-share
    ```

2. **Install dependencies**:
    ```bash
    composer install
    npm install
    ```

3. **Configure environment variables**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Run migrations**:
    ```bash
    php artisan migrate
    ```

5. **Start the development server**:
    ```bash
    php artisan serve
    npm run dev
    ```
