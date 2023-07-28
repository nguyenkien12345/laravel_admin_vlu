const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

// BUILD SASS AUTHENTICATION
mix.sass('resources/scss/Authentication/register.scss', 'public/css/Authentication/register.css');
mix.sass('resources/scss/Authentication/login.scss', 'public/css/Authentication/login.css');
mix.sass('resources/scss/Authentication/notification_register.scss', 'public/css/Authentication/notification_register.css');
mix.sass('resources/scss/Authentication/send_otp.scss', 'public/css/Authentication/send_otp.css');
mix.sass('resources/scss/Authentication/forgot_password.scss', 'public/css/Authentication/forgot_password.css');
mix.sass('resources/scss/Authentication/reset_password.scss', 'public/css/Authentication/reset_password.css');
// BUILD JS AUTHENTICATION
// mix.sass('resources/js/Authentication/register.js', 'public/js/Authentication/register.js');
// mix.sass('resources/js/Authentication/login.js', 'public/js/Authentication/login.js');
// mix.sass('resources/js/Authentication/notification_register.js', 'public/js/Authentication/notification_register.js');
// mix.sass('resources/js/Authentication/send_otp.js', 'public/js/Authentication/send_otp.js');
// mix.sass('resources/js/Authentication/forgot_password.js', 'public/js/Authentication/forgot_password.js');
// mix.sass('resources/js/Authentication/reset_password.js', 'public/js/Authentication/reset_password.js');

// BUILD SASS FAQ
mix.sass('resources/scss/Faq/faq.scss', 'public/css/Faq/faq.css');

// BUILD SASS SEARCH PROFILES
mix.sass('resources/scss/SearchProfiles/search_profiles.scss', 'public/css/SearchProfiles/search_profiles.css');
mix.sass('resources/scss/SearchProfiles/preview_info_register.scss', 'public/css/SearchProfiles/preview_info_register.css');

// BUILD SASS REGISTRATION ADMISSION ACADEMIC TRANSCRIPTS
mix.sass('resources/scss/RegistrationAdmissionAcademicTranscripts/index.scss', 'public/css/RegistrationAdmissionAcademicTranscripts/index.css');
mix.sass('resources/scss/RegistrationAdmissionAcademicTranscripts/preview_info_register_academic_transcripts.scss', 'public/css/RegistrationAdmissionAcademicTranscripts/preview_info_register_academic_transcripts.css');

// BUILD SASS REGISTRATION LOADER
mix.sass('resources/scss/Loader/index.scss', 'public/css/Loader/index.css');

// BUILD SASS REGISTER ADMISSIONS
mix.sass('resources/scss/RegisterAdmissions/upload_image.scss', 'public/css/RegisterAdmissions/upload_image.css');
