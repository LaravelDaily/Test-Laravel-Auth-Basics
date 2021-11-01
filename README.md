## Test Your Laravel Auth Skills

This repository is a test for you: perform a set of tasks listed below, and fix the PHPUnit tests, which are currently intentionally failing.

To test if all the functions work correctly, there are PHPUnit tests in `tests/Feature/AuthenticationTest.php` file.

In the very beginning, if you run `php artisan test`, or `vendor/bin/phpunit`, all tests fail.
Your task is to make those tests pass.


## How to Submit Your Solution

If you want to submit your solution, you should make a Pull Request to the `main` branch.
It will automatically run the tests via Github Actions and will show you/me if the test pass.

If you don't know how to make a Pull Request, [here's my video with instructions](https://www.youtube.com/watch?v=vEcT6JIFji0).

This task is mostly self-served, so I'm not planning review or merge the Pull Requests. This test is for yourselves to assess your skills, the automated tests will be your answer if you passed the test :)


## Questions / Problems?

If you're struggling with some of the tasks, or you have suggestions how to improve the task, create a Github Issue.

Good luck!

---

## Task 1. Routes Protected by Auth.

File `routes/web.php`: profile functionality URLs should be available only for logged-in users.

Test method `test_profile_routes_are_protected_from_public()`.

---

## Task 2. Link Visible to Logged-in Users.

File `resources/views/layouts/navigation.blade.php`: the "Profile" link should be visible only to logged-in users.

Test method `test_profile_link_is_invisible_in_public()`.

---

## Task 3. Profile Fields.

File `resources/views/auth/profile.blade.php`: replace "???" values for name/email with logged-in user's name/email.

Test method `test_profile_fields_are_visible()`.

---

## Task 4. Profile Update.

File `app/Http/Controllers/ProfileController.php`: fill in the method `update()` with the code to update the user's name and email.
If the password is filled in, also update that.

Test methods: `test_profile_name_email_update_successful()` and `test_profile_password_update_successful()`.

---

## Task 5. Email Verification.

Make the URL `/secretpage` available only to those who verified their email.
You need to make changes to two files.

In file `routes/web.php` add a Middleware to `/secretpage` URL.
And enable email verification in the `app/Models/User.php` file.

Test method: `test_email_can_be_verified()`.

---

## Task 6. Password Confirmation.

Make the URL `/verysecretpage` redirect to a page to re-enter their password once again.
In file `routes/web.php` add a Middleware to that URL.

Test method: `test_password_confirmation_page()`.

---

## Task 7. Password with Letters.

By default, registration form requires password with at least 8 characters.
Add a validation rule so that password must have at least one letter, no matter uppercase or lowercase.

So password `12345678` is invalid, but password `a12345678` is valid.

Hint: you need to modify file `app/Http/Controllers/Auth/RegisteredUserController.php`, which is almost default from Laravel Breeze.

Test method: `test_password_at_least_one_uppercase_lowercase_letter()`.

