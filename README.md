# GO WITH ME(Unfinished)

## Project Overview

The Go with me project is a web application designed to facilitate shared rides between drivers and passengers. The application allows users to register as either a driver or a passenger and create, accept, start, and complete trips. The project uses Laravel for the backend and Vue.js for the frontend.

## ⚠️ Warning

**This project is currently unfinished and may contain bugs or incomplete features. Use at your own risk.**

## Features

### User Management

- **Registration and Login**: Users can register and log in using their phone numbers.
- **Authentication**: Secure authentication using Laravel Sanctum.
- **User Profiles**: Users can update their profile information.
- **Two-Factor Authentication**: Users receive a login code via SMS using Twilio for additional security.

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
- **SMS Notifications**: Important notifications, including login codes, are sent via SMS using Twilio.

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

## Installation and Setup

1. **Clone the repository**:
    ```bash
    git clone https://github.com/thanasaksrisuwan/ride-share.git
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
  ** Passport  
    ```bash
    php artisan install:api --passport
    php artisan passport:keys
    php artisan vendor:publish --tag=passport-config
    php artisan passport:client
    php artisan passport:client --public
    php artisan passport:client --client
    php artisan passport:client --personal
    ```

4. **Set up Twilio**:
    - Sign up for a Twilio account and get your Twilio credentials (Account SID, Auth Token, and Phone Number).
    - Add your Twilio credentials to the `.env` file:
        ```
        TWILIO_SID=your_twilio_sid
        TWILIO_AUTH_TOKEN=your_twilio_auth_token
        TWILIO_PHONE_NUMBER=your_twilio_phone_number
        ```

5. **Run migrations**:
    ```bash
    php artisan migrate
    ```

6. **Start the development server**:
    ```bash
    php artisan serve
    npm run dev
    ```
