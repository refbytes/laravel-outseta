# Changelog

All notable changes to `laravel-outseta` will be documented in this file.

## v0.8.1 - 2025-03-24

Persists the access token longer than a single redirect by storing it in the session rather than flashing it.

This was required to get Outseta authentication working with Filament.

## v0.8.0 - 2025-02-25

Upgraded dependencies for Laravel 12 compatibility

## v0.7.2 - 2025-02-25

* Removed unnecessary parameter in custom activity tracking job

## v0.7.1 - 2025-02-25

* Added the ability to track custom activities by creating a job that sends activity via the API

## v0.7.0 - 2025-02-19

* Added Add-on Uid to Account and updated instructions in the wiki for sending the Uid for usage-based Add-ons.

## v0.6.0 - 2025-02-14

### What's Changed

- The ability to report add-on usage via a job was added.
- You can now view plans and associated add-on names and Uids by running the outseta:plans command.

## v0.5.1 - 2025-01-27

* Updated login to pass access token to quick start script rather than appending it to the URL

## v0.5.0 - 2025-01-25

* Updated embed scripts and added quick start component to load script globally

## v0.4.1 - 2025-01-23

* Renamed Profile route to match Breeze convention.

## v0.4.0 - 2025-01-23

+ A default App and Guest Layouts if neither exist in the app. This is to accelerate using the Outseta integration, but most developers will want to create a local customized App and Guest Layout.

* Added additional customization options to config file for specifying Models and Layouts.

## v0.3.0 - 2025-01-20

Refactored some areas to make the package more customizable and added additional tests.

## v0.2.0 - 2025-01-17

Fixed event mapping, added plan method to account, renamed the middleware and added optional parameter

## v0.1.0 - 2025-01-07

Added Registration, Authentication, Subscription Checking Middleware, and Webhooks with Events
