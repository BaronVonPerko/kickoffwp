@component('mail::message')
# Happy New Year!

Thank you for waiting patiently for the development of
KickoffWP.  We are now live!  Be sure to check out the
<a href="http://kickoffwp.com/howto">how to</a> page
to learn more about how to use KickoffWP.

We are super excited for your feedback.  If you would like
to contribute or report an issue, check out our
<a href="http://github.com/baronvonperko/kickoffwp">GitHub</a>
page.

@component('mail::button', ['url' => 'http://kickoffwp.com/register'])
Register for Free
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
