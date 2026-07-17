# Security Policy

## Supported Versions

The following versions of Socialite Slim are currently being supported with security updates:

| Version | Supported          |
| ------- | ------------------ |
| 1.x.x   | :white_check_mark: |
| < 1.0   | :x:                |

## Reporting a Vulnerability

If you discover a security vulnerability within Socialite Slim, please send an email to saeed.es91@gmail.com. All security vulnerabilities will be promptly addressed.

Please do not publicly disclose the issue until it has been addressed by the team.

## Security Best Practices

When using Socialite Slim, we recommend following these security best practices:

1. Keep your OAuth client secrets secure and never commit them to version control
2. Use environment variables for storing sensitive OAuth configuration
3. Regularly rotate your OAuth client secrets
4. Implement proper session management in your application
5. Validate and sanitize all user input
6. Use HTTPS in production environments
7. Keep your Laravel and Socialite Slim versions up to date

## Security Considerations

Socialite Slim handles OAuth tokens and user data. It's important to:

1. Store OAuth tokens securely
2. Implement token refresh mechanisms when available
3. Handle token expiration gracefully
4. Protect against OAuth-related attacks such as CSRF
5. Follow OAuth 2.0 best practices for token storage and usage

For more information on OAuth 2.0 security best practices, please refer to the [OAuth 2.0 Threat Model and Security Considerations](https://tools.ietf.org/html/rfc6819).