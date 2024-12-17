<?php

/**
 * JWTToken Helper Class
 *
 * Summary of Methods:
 * 1. `CreateToken($userEmail, $userId, $userRoll)`: Generates a JWT token with user details.
 * 2. `VerifyToken($token)`: Decodes and verifies the provided JWT token.
 */

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class JWTToken
{
    /**
     * Generate a JWT Token
     *
     * This method generates a JWT token using the provided user details and an expiration time.
     *
     * $userEmail The email of the user.
     * $userId The unique ID of the user.
     * $userRoll The role of the user.
     * The encoded JWT token.
     */
    public static function CreateToken($userEmail, $userId, $userRole): string
    {
        try {
            $key = env('JWT_KEY'); // Retrieve the secret key from environment variables.
            $payload = [
                "iss" => "LaravelJWT", // Issuer of the token
                "iat" => time(),       // Token issued at time
                "exp" => time() + 5 * 60 * 60, // Token expiration time (5 hours from now)
                "userEmail" => $userEmail,
                "userId" => $userId,
                "userRole" => $userRole
            ];

            // Encode and return the token
            return JWT::encode($payload, $key, 'HS256');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Verify a JWT Token
     *
     * This method decodes and verifies the provided JWT token. If the token is valid, it returns the decoded payload.
     * If the token is invalid or unauthorized, it returns a string message.
     *
     */
    public static function VerifyToken($token): string|object
    {
        try {
            if ($token == null) {
                // Return unauthorized if token is null
                return 'unauthorized';
            } else {
                $key = env('JWT_KEY'); // Retrieve the secret key from environment variables.
                $decode = JWT::decode($token, new Key($key, 'HS256'));
                return $decode; // Return the decoded payload
            }
        } catch (Exception $e) {
            // Return unauthorized if decoding fails
            return 'unauthorized' . $e->getMessage();
        }
    }

    /**
     * Generate a JWT Token After Verify The OTP
     *
     * This method generates a JWT token using the provided user details and an expiration time.
     * $userEmail The email of the user.
     * The encoded JWT token.
     */

    public static function CreateTokenForSetPassword($userEmail): string
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 20,
            'userEmail' => $userEmail,
            'userID' => '0'
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

}
