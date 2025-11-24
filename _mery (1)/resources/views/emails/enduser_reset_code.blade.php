<!DOCTYPE html>
<html lang="en">
<body>
    <p>Hello,</p>
    <p>Your end-user password reset code is:</p>
    <h2 style="letter-spacing:4px">{{ $code }}</h2>
    <p>This code will expire in {{ $expiresMinutes }} minutes.</p>
    <p>If you did not request this code, you can safely ignore this email.</p>
</body>
</html>


